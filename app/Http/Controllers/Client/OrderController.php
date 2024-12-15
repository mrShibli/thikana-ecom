<?php

namespace App\Http\Controllers\Client;

use App\Models\Cart;
use App\Models\User;
use App\Models\order;
use App\Models\Product;
use App\Models\order_item;
use Illuminate\Support\Str;
use App\Services\SMSService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }


    protected $smsService;

    public function __construct(SMSService $smsService)
    {
        $this->smsService = $smsService;
    }

    public function asignedorders(request $request)
    {
        // Retrieve status filter from the request
        $status = $request->get('status');

        // Fetch orders assigned to the authenticated user with optional status filtering
        $orders = Order::where('assign', Auth::id())
            ->when($status, function ($query, $status) {
                return $query->where([
                    ['status', '=', $status],
                    ['assign', '=', Auth::id()]
                ]);
            })
            ->with('products') // Eager load related products
            ->orderBy('updated_at', 'desc')
            ->get();

        // Return the orders view with the retrieved orders
        return view('admin.orders.assign', compact('orders'));
    }


    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'name'           => 'required|string',
            'address'        => 'required|string',
            'phone'          => 'required|string',
            'upazila'        => 'required|string',
            'city'           => 'required|string',
            'message'        => 'nullable|string',
            'payment_method' => 'required|string',
        ]);

        $total = 0;

        try {
            // Authenticate or create a guest user
            if (Auth::check()) {
                $userId = Auth::id();
                $carts = Cart::where("user_id", $userId)->get();
                $user = Auth::user();
            } else {
                $password = bcrypt('password');
                $user = User::create([
                    'name'     => $request->name,
                    'email'    => $this->generateUniqueEmail(),
                    'password' => $password,
                    'phone'    => $request->phone,
                    'upazila'    => $request->upazila,
                    'address' => $request->address,
                    'city'    => $request->city,
                ]);

                $userId = $user->id;
                $guestId = $request->cookie('guest_id');
                $carts = Cart::where("guest_id", $guestId)->get();

                Auth::login($user);
            }

            if ($carts->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Cart is empty. Cannot place an order.',
                ], 422);
            }

            foreach ($carts as $cart) {
                $total += $cart->price * $cart->qunt;
            }

            // Handling payment method
            if (!$user->otp_verified && $request->payment_method === 'cod') {
                $otp = rand(1000, 9999);

                // Update OTP and expiration in the database
                $userUpdated = $user->update([
                    'otp_code'       => $otp,
                    'otp_expires_at' => now()->addMinutes(10),
                ]);

                if ($userUpdated) {
                    // Prepare order details for later use
                    $orderDetails = [
                        'name'           => $request->name,
                        'address'        => $request->address,
                        'phone'          => $request->phone,
                        'upazila'        => $request->upazila,
                        'city'           => $request->city,
                        'message'        => $request->message,
                        'shipping'       => $request->shipping ?? 120,
                        'total'          => $total + ($request->shipping ?? 120),
                        'payment_method' => $request->payment_method,
                        'user_id'        => $userId,
                        'carts'          => $carts
                    ];

                    // Store order details in session for later use
                    session(['pending_order' => $orderDetails]);

                    return response()->json([
                        'status'  => 'otp_sent',
                        'message' => 'OTP sent to your phone for verification.',
                    ]);
                } else {
                    return response()->json([
                        'status'  => 'error',
                        'message' => 'Failed to update OTP.',
                    ]);
                }
            }

            // Create the order for non-COD methods
            $order = Order::create([
                'name'           => $request->name,
                'address'        => $request->address,
                'phone'          => $request->phone,
                'upazila'        => $request->upazila,
                'city'           => $request->city,
                'message'        => $request->message,
                'shipping'       => $request->shipping ?? 120,
                'total'          => $total + ($request->shipping ?? 120),
                'payment_method' => $request->payment_method,
                'user_id'        => $userId,
            ]);

            if ($order) {
                foreach ($carts as $cart) {
                    order_item::create([
                        'order_id'   => $order->id,
                        'product_id' => $cart->product_id,
                        'option_id'  => $cart->option_id,
                        'quantity'   => $cart->qunt,
                        'price'      => $cart->price,
                        'sub_total'  => $cart->price * $cart->qunt,
                    ]);
                }

                // Mark OTP as verified for future orders
                if (!$user->otp_verified) {
                    $user->update(['otp_verified' => true]);
                }

                // Clear the cart
                Cart::where('user_id', $userId)->orWhere('guest_id', $guestId ?? null)->delete();
            }


            return response()->json([
                'success' => true,
                'message' => 'Order placed successfully!',
                'order_id' => $order->id,
            ]);
        } catch (\Exception $e) {
            // Log the exception
            \Log::error("Order placement failed: " . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while processing your order. Please try again.',
            ], 500);
        }
    }

    // New method for OTP verification
    public function verifyOtp(Request $request)
    {
        try {
            $user = Auth::user();

            // Validate OTP
            if ($user->otp_code !== $request->otp || $user->otp_expires_at < now()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Invalid or expired OTP.',
                ], 400);
            }

            // Retrieve pending order details from session
            $orderDetails = session('pending_order');

            if (!$orderDetails) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'No pending order found.',
                ], 400);
            }

            // Create the order
            $order = Order::create([
                'name'           => $orderDetails['name'],
                'address'        => $orderDetails['address'],
                'phone'          => $orderDetails['phone'],
                'upazila'        => $orderDetails['upazila'],
                'city'           => $orderDetails['city'],
                'message'        => $orderDetails['message'],
                'shipping'       => $orderDetails['shipping'],
                'total'          => $orderDetails['total'],
                'payment_method' => $orderDetails['payment_method'],
                'user_id'        => $orderDetails['user_id'],
            ]);

            // Create order items
            foreach ($orderDetails['carts'] as $cart) {
                order_item::create([
                    'order_id'   => $order->id,
                    'product_id' => $cart->product_id,
                    'option_id'  => $cart->option_id,
                    'quantity'   => $cart->qunt,
                    'price'      => $cart->price,
                    'sub_total'  => $cart->price * $cart->qunt,
                ]);
            }

            // Clear the cart
            Cart::where('user_id', $orderDetails['user_id'])->delete();

            // Mark OTP as verified for future orders
            $user->update(['otp_verified' => true]);

            // Clear session
            session()->forget('pending_order');

            // Clear the cart
            Cart::where('guest_id', $guestId ?? null)->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Order placed successfully!',
                'order_id' => $order->id,  // Return the order ID
            ]);
        } catch (\Exception $e) {
            \Log::error("OTP verification failed: " . $e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred during verification. Please try again.',
            ], 500);
        }
    }

    // Resend otp

    public function resendOtp(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['status' => 'error', 'message' => 'User not authenticated.'], 401);
        }

        // Check if the user has reached the maximum resend limit
        $maxResendLimit = 5;
        $resendCount = $user->otp_resend_count ?? 0;

        if ($resendCount >= $maxResendLimit) {
            return response()->json(['status' => 'error', 'message' => 'Maximum OTP resend limit reached.'], 429);
        }

        // Increment the resend count
        $user->otp_resend_count = $resendCount + 1;
        $user->otp_code = rand(1000, 9999); // Generate a new OTP
        $user->otp_expires_at = now()->addMinutes(10); // Extend the expiration time
        $user->save();

        // Send the new OTP via SMS (implement your SMS logic here)
        // $this->smsService->sendSMS($user->phone, "Your new OTP: {$user->otp_code}");

        return response()->json(['status' => 'success', 'message' => 'OTP resent successfully.']);
    }

    // Helper method to generate unique email for guest users
    private function generateUniqueEmail()
    {
        do {
            $email = 'guest_' . uniqid() . '@thikanashop.com';
        } while (User::where('email', $email)->exists());

        return $email;
    }



    public function thankYou($orderId)
    {
        // Fetch the order based on user ID and order ID
        $order = Order::where('user_id', Auth::id())
            ->where('id', $orderId)
            ->first();

        // Check if the order exists
        if (!$order) {
            return redirect()->route('home')->with('error', 'Order not found!');
        }

        // Fetch order items manually using order_id
        $orderItems = order_item::where('order_id', $order->id)->get();

        // Fetch the products for the order items
        $productIds = $orderItems->pluck('product_id')->toArray();
        $products = Product::whereIn('id', $productIds)->get();

        // Pass the order, orderItems, and products to the view
        return view('clientside.thankyou', compact('order', 'orderItems', 'products'));
    }



    public function downloadOrderPDF($orderId)
    {
        // Fetch the order based on user ID and order ID
        $order = Order::where('user_id', Auth::id())
            ->where('id', $orderId)
            ->first();

        // Check if the order exists
        if (!$order) {
            return redirect()->route('home')->with('error', 'Order not found!');
        }

        // Fetch order items manually using order_id
        $orderItems = order_item::where('order_id', $order->id)->get();

        // Fetch the products for the order items
        $productIds = $orderItems->pluck('product_id')->toArray();
        $products = Product::whereIn('id', $productIds)->get();

        // Generate the PDF with the current Blade view
        $pdf = PDF::loadView('invoice', compact('order', 'orderItems'));

        // Download the PDF
        return $pdf->download('order_' . $order->id . '.pdf');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
