<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use App\Models\Product;
use App\Models\order;
use App\Models\order_item;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Models\ProductVariationOption;

class CartController extends Controller
{
    // Cart Page Shows
    public function index(Request $request)
    {
        if (Auth::check()) {
            // Fetch cart items for authenticated users based on user_id
            $carts = Cart::with("product")->where('user_id', Auth::id())->get();
        } else {
            // Get the guest_id from the cookie
            $guestId = $request->cookie('guest_id');

            // Fetch cart items for guests based on guest_id if it exists
            if ($guestId) {
                $carts = Cart::with("product")->where('guest_id', $guestId)->get();
            } else {
                // If no guest ID exists, initialize an empty collection
                $carts = collect();
            }
        }

        // Calculate subtotal
        $sub_total = 0;
        foreach ($carts as $item) {
            $sub_total += $item->price * $item->qunt;
        }

        return view('clientside.cart', compact('carts', 'sub_total'));
    }


    // Store Cart
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'price' => 'required',
        ]);

        if (Auth::check()) {
            // User is logged in
            $cart = Cart::where('user_id', Auth::id())->where('product_id', $request->product_id)->first();

            if ($cart) {
                $cart->update([
                    'qunt' => $cart->qunt + $request->quantity,
                ]);
            } else {
                Cart::create([
                    'product_id' => $request->product_id,
                    'qunt'       => $request->quantity ?? 1,
                    'price'      => $request->price,
                    'option_id'  => $request->option_id,
                    'user_id'    => Auth::id(),
                ]);
            }
        } else {
            // User is a guest
            $guestId = $request->cookie('guest_id') ?? Str::uuid()->toString();

            // Store the guest ID in a cookie if it's a new guest
            if (!$request->cookie('guest_id')) {
                \Cookie::queue('guest_id', $guestId, 60 * 24 * 30); // 30 days
            }

            // Check if item already exists in guest cart
            $cart = Cart::where('guest_id', $guestId)->where('product_id', $request->product_id)->first();

            if ($cart) {
                $cart->update([
                    'qunt' => $cart->qunt + $request->quantity,
                ]);
            } else {
                Cart::create([
                    'product_id' => $request->product_id,
                    'qunt'       => $request->quantity ?? 1,
                    'price'      => $request->price,
                    'option_id'  => $request->option_id,
                    'user_id'    => null,
                    'guest_id'   => $guestId,
                ]);
            }
        }

        return redirect()->back()->with('success', 'Item added to cart successfully');
    }

    /// Buy Cart
    public function buystore(Request $request)
    {
        // Validate the request
        $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'price' => 'required',
        ]);

        if ($request->option_id) {
            $sub_total = 0;
            $pqty = $request->quantity;
            $productoption = ProductVariationOption::findorfail($request->option_id);
            $option_id = $request->option_id;
            $product = Product::findorfail($productoption->product_id);
            $sub_total += $productoption->price * $pqty;
            $price = $request->price;
            return view('clientside.buynow', compact('product', 'pqty', 'price', 'sub_total', 'option_id'));
        } else {
            $sub_total = 0;
            $pqty = $request->quantity;
            $product = Product::findorfail($request->product_id);
            $price = $request->offer;
            $sub_total += $product->offer * $pqty;
            return view('clientside.buynow', compact('product', 'pqty', 'price', 'sub_total'));
        }
    }


    public function buynoworder(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'name'           => 'required|string',
            'address'        => 'required|string',
            'phone'          => 'required|string',
            'upazila'        => 'required|string',
            'city'           => 'required|string',
            'message'        => 'nullable|string',
            'product_id'     => 'required|exists:products,id',
            'option_id'      => 'nullable',
            'pqty'           => 'required|integer|min:1',
            'price'          => 'required|numeric',
            'payment_method' => 'required|string',
        ]);

        try {
            // Authenticate or create a guest user
            if (Auth::check()) {
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
                Auth::login($user);
            }

            // Check if OTP is needed (only if not verified and COD is selected)
            if (!$user->otp_verified && $request->payment_method === 'cod') {
                $otp = rand(1000, 9999);

                // Update OTP and expiration in the database
                $userUpdated = $user->update([
                    'otp_code'       => $otp,
                    'otp_expires_at' => now()->addMinutes(10),
                ]);

                if ($userUpdated) {
                    // Store order details in session
                    session([
                        'pending_buynow_order' => [
                            'name'           => $request->name,
                            'address'        => $request->address,
                            'phone'          => $request->phone,
                            'upazila'        => $request->upazila,
                            'city'           => $request->city,
                            'message'        => $request->message,
                            'shipping'       => $request->shipping ?? 70,
                            'total'          => $request->price * $request->pqty + ($request->shipping ?? 70),
                            'payment_method' => $request->payment_method,
                            'user_id'        => $user->id,
                            'product_id'     => $request->product_id,
                            'option_id'      => $request->option_id,
                            'pqty'           => $request->pqty,
                            'price'          => $request->price
                        ]
                    ]);

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

            // Proceed to place the order if OTP is already verified or not required
            $order = Order::create([
                'name'           => $request->name,
                'address'        => $request->address,
                'phone'          => $request->phone,
                'upazila'        => $request->upazila,
                'city'           => $request->city,
                'message'        => $request->message,
                'shipping'       => $request->shipping ?? 70,
                'total'          => $request->price * $request->pqty + ($request->shipping ?? 70),
                'payment_method' => $request->payment_method,
                'user_id'        => $user->id,
            ]);

            if ($order) {
                order_item::create([
                    'order_id'   => $order->id,
                    'product_id' => $request->product_id,
                    'option_id'  => $request->option_id,
                    'quantity'   => $request->pqty,
                    'price'      => $request->price,
                    'sub_total'  => $request->price * $request->pqty,
                ]);

                // Mark OTP as verified for future orders
                if (!$user->otp_verified) {
                    $user->update(['otp_verified' => true]);
                }

                // After creating the order, send the response with success, message, and the order ID
                return response()->json([
                    'success' => true,
                    'message' => 'Order placed successfully!',
                    'order_id' => $order->id,  // Return the order ID
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Failed to place the order. Please try again.',
            ], 500);
        } catch (\Exception $e) {
            // Log the exception
            \Log::error("Buy Now Order placement failed: " . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while processing your order. Please try again.',
            ], 500);
        }
    }

    // Helper method to generate unique email for guest users
    private function generateUniqueEmail()
    {
        do {
            $email = 'guest_' . uniqid() . '@thikanashop.com';
        } while (User::where('email', $email)->exists());

        return $email;
    }

    public function verifyBuynowOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:4'
        ]);

        $user = Auth::user();

        // Check if OTP is valid and not expired
        if (
            $user->otp_code == $request->otp &&
            $user->otp_expires_at &&
            now()->lessThan($user->otp_expires_at)
        ) {
            // Retrieve the pending order details from the session
            $orderDetails = session('pending_buynow_order');

            if ($orderDetails) {
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

                if ($order) {
                    // Create order item
                    order_item::create([
                        'order_id'   => $order->id,
                        'product_id' => $orderDetails['product_id'],
                        'option_id'  => $orderDetails['option_id'],
                        'quantity'   => $orderDetails['pqty'],
                        'price'      => $orderDetails['price'],
                        'sub_total'  => $orderDetails['price'] * $orderDetails['pqty'],
                    ]);

                    // Mark OTP as verified for future orders
                    $user->update(['otp_verified' => true]);

                    // Clear OTP and session
                    session()->forget('pending_buynow_order');

                    return response()->json([
                        'status'  => 'success',
                        'message' => 'Order placed successfully!',
                        'order_id' => $order->id,  // Return the order ID
                    ]);
                }
            }
        }

        return response()->json([
            'status'  => 'error',
            'message' => 'Invalid or expired OTP'
        ], 400);
    }

    //Destroy Cart
    public function destroy($id): RedirectResponse
    {
        $cart = Cart::find($id);
        $cart->delete();
        return redirect()->back()->with('success', 'Item remove to cart successfully');
    }


    // Checkout Shows
    public function checkout()
    {
        $sub_total = 0;
        $carts = collect(); // Initialize as an empty collection

        if (Auth::check()) {
            // Retrieve cart items for authenticated users
            $carts = Cart::with("product")->where('user_id', Auth::id())->get();
        } else {
            // Retrieve cart items for guests using guest_id from the cookie
            $guestId = request()->cookie('guest_id');
            if ($guestId) {
                $carts = Cart::with("product")->where('guest_id', $guestId)->get();
            }
        }

        // Calculate the subtotal
        foreach ($carts as $item) {
            $sub_total += $item->price * $item->qunt;
        }

        return view('clientside.checkout', compact('carts', 'sub_total'));
    }
}
