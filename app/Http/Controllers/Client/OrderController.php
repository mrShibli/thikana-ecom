<?php

namespace App\Http\Controllers\Client;

use App\Models\Cart;
use App\Models\User;
use App\Models\order;
use App\Models\order_item;
use Illuminate\Support\Str;
use App\Services\SMSService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;


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

    // Store Order
    // public function store (Request $request) {
    //     // Validate the request
    //     $request->validate ([
    //         'name'    => 'required|string',
    //         'address' => 'required|string',
    //         'phone'   => 'required|string',
    //         'upazila' => 'required|string',
    //         'city'    => 'required|string',
    //         'message' => 'nullable|string',
    //     ]);

    //     $total = 0;
    //     // Get the cart items
    //     $carts = Cart::where ("user_id",Auth::id ())->get ();
    //     if (count ($carts) > 0) {
    //         // Calculate the total
    //         foreach ($carts as $cart) {
    //             $total += $cart->price * $cart->qunt;
    //         }
    //     }
    //     // Create the order
    //     $order = order::create ([
    //         'name'    => $request->name,
    //         'address' => $request->address,
    //         'phone'   => $request->phone,
    //         'upazila' => $request->upazila,
    //         'city'    => $request->city,
    //         'message' => $request->message,
    //         'shipping' => $request->shipping??120,
    //         'total'    => $total + ($request->shipping??120),
    //         'user_id' => Auth::user ()->id,
    //     ]);
    //     if ($order) {
    //         // Create the order items
    //         foreach ($carts as $cart) {
    //             order_item::create ([
    //                 'order_id'   => $order->id,
    //                 'product_id' => $cart->product_id,
    //                 'quantity'   => $cart->qunt,
    //                 'price'      => $cart->price,
    //                 'sub_total'  => $cart->price * $cart->qunt,
    //             ]);
    //         }
    //         // Delete the cart items
    //         Cart::where ("user_id",Auth::id ())->delete ();
    //     }
    //     return redirect ()->route ('index')->with ('success', 'Order placed successfully');
    // }

    protected $smsService;

    public function __construct(SMSService $smsService)
    {
        $this->smsService = $smsService;
    }


    // Store Order
    // public function store(Request $request)
    // {
    //     // Validate the request
    //     $request->validate([
    //         'name'    => 'required|string',
    //         'address' => 'required|string',
    //         'phone'   => 'required|string',
    //         'upazila' => 'required|string',
    //         'city'    => 'required|string',
    //         'message' => 'nullable|string',
    //         'payment_method' => 'required|string',
    //     ]);

    //     $total = 0;

    //     if (Auth::check()) {
    //         $userId = Auth::id();
    //         $carts = Cart::where("user_id", $userId)->get();
    //     } else {
    //         $password = bcrypt('password');
    //         $user = User::create([
    //             'name'     => $request->name,
    //             'email'    => $this->generateUniqueEmail(),
    //             'password' => $password,
    //         ]);

    //         $userId = $user->id;
    //         $guestId = $request->cookie('guest_id');
    //         $carts = Cart::where("guest_id", $guestId)->get();

    //         Auth::login($user);
    //     }

    //     if ($carts->isEmpty()) {
    //         return back()->withErrors('Cart is empty. Cannot place an order.');
    //     }

    //     foreach ($carts as $cart) {
    //         $total += $cart->price * $cart->qunt;
    //     }

    //     $order = Order::create([
    //         'name'      => $request->name,
    //         'address'   => $request->address,
    //         'phone'     => $request->phone,
    //         'upazila'   => $request->upazila,
    //         'city'      => $request->city,
    //         'message'   => $request->message,
    //         'shipping'  => $request->shipping ?? 120,
    //         'total'     => $total + ($request->shipping ?? 120),
    //         'payment_method' => $request->payment_method,
    //         'user_id'   => $userId,
    //     ]);


    //     if ($order) {
    //         foreach ($carts as $cart) {
    //             order_item::create([
    //                 'order_id'   => $order->id,
    //                 'product_id' => $cart->product_id,
    //                 'option_id' => $cart->option_id,
    //                 'quantity'   => $cart->qunt,
    //                 'price'      => $cart->price,
    //                 'sub_total'  => $cart->price * $cart->qunt,
    //             ]);
    //         }

    //         Cart::where('user_id', $userId)->orWhere('guest_id', $guestId ?? null)->delete();

    //         // Send SMS notification
    //        // $this->smsService->sendSMS($request->phone, "Dear {$order->name}, Your order has been placed successfully. Order ID: {$order->id}");
    //     }




    //     return redirect()->route('index')->with('success', 'Order placed successfully');
    // }


    // public function store(Request $request)
    // {
    //     // Validate the request
    //     $validated = $request->validate([
    //         'name'           => 'required|string',
    //         'address'        => 'required|string',
    //         'phone'          => 'required|string',
    //         'upazila'        => 'required|string',
    //         'city'           => 'required|string',
    //         'message'        => 'nullable|string',
    //         'payment_method' => 'required|string',
    //     ]);

    //     $total = 0;

    //     try {
    //         // Authenticate or create a guest user
    //         if (Auth::check()) {
    //             $userId = Auth::id();
    //             $carts = Cart::where("user_id", $userId)->get();
    //         } else {
    //             $password = bcrypt('password');
    //             $user = User::create([
    //                 'name'     => $request->name,
    //                 'email'    => $this->generateUniqueEmail(),
    //                 'password' => $password,
    //                 'phone'    => $request->phone,
    //             ]);

    //             $userId = $user->id;
    //             $guestId = $request->cookie('guest_id');
    //             $carts = Cart::where("guest_id", $guestId)->get();

    //             Auth::login($user);
    //         }

    //         if ($carts->isEmpty()) {
    //             return response()->json([
    //                 'success' => false,
    //                 'message' => 'Cart is empty. Cannot place an order.',
    //             ], 422);
    //         }

    //         foreach ($carts as $cart) {
    //             $total += $cart->price * $cart->qunt;
    //         }

    //         // Handling payment method
    //         if ($request->payment_method === 'cod') {
    //             if (Auth::check()) {
    //                 $otp = rand(1000, 9999);
    //                 $user = Auth::user();  // Get the authenticated user

    //                 // Update OTP and expiration in the database
    //                 $userUpdated = $user->update([
    //                     'otp_code'       => $otp,
    //                     'otp_expires_at' => now()->addMinutes(10),
    //                 ]);

    //                 if ($userUpdated) {
    //                     // Mock SMS Sending (Optional)

    //                 //    $this->smsService->sendSMS($request->phone, "Dear Customer , Your Phone OTP Verificaton code is : {$otp} Thank you from ThikanaShop");

    //                     return response()->json([
    //                         'status'  => 'otp_sent',
    //                         'message' => 'OTP sent to your phone for verification.',
    //                     ]);
    //                 } else {
    //                     return response()->json([
    //                         'status'  => 'error',
    //                         'message' => 'Failed to update OTP.',
    //                     ]);
    //                 }
    //             } else {
    //                 return response()->json([
    //                     'status'  => 'error',
    //                     'message' => 'User is not authenticated.',
    //                 ]);
    //             }
    //         }

    //         // Create the order for non-COD methods
    //         $order = Order::create([
    //             'name'           => $request->name,
    //             'address'        => $request->address,
    //             'phone'          => $request->phone,
    //             'upazila'        => $request->upazila,
    //             'city'           => $request->city,
    //             'message'        => $request->message,
    //             'shipping'       => $request->shipping ?? 120,
    //             'total'          => $total + ($request->shipping ?? 120),
    //             'payment_method' => $request->payment_method,
    //             'user_id'        => $userId,
    //         ]);

    //         if ($order) {
    //             foreach ($carts as $cart) {
    //                 order_item::create([
    //                     'order_id'   => $order->id,
    //                     'product_id' => $cart->product_id,
    //                     'option_id'  => $cart->option_id,
    //                     'quantity'   => $cart->qunt,
    //                     'price'      => $cart->price,
    //                     'sub_total'  => $cart->price * $cart->qunt,
    //                 ]);
    //             }

    //             // Clear the cart
    //             // Cart::where('user_id', $userId)->orWhere('guest_id', $guestId ?? null)->delete();

    //             // Optionally send a confirmation SMS
    //             // $this->smsService->sendSMS($request->phone, "Dear Customer , Your Phone OTP Verificaton code is : {$order->id} Thank you from ThikanaShop");
    //         }

    //         return response()->json([
    //             'success' => true,
    //             'message' => 'Order placed successfully!',
    //         ]);
    //     } catch (\Exception $e) {
    //         // Log the exception
    //         \Log::error("Order placement failed: " . $e->getMessage());

    //         return response()->json([
    //             'success' => false,
    //             'message' => 'An error occurred while processing your order. Please try again.',
    //         ], 500);
    //     }
    // }


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
            } else {
                $password = bcrypt('password');
                $user = User::create([
                    'name'     => $request->name,
                    'email'    => $this->generateUniqueEmail(),
                    'password' => $password,
                    'phone'    => $request->phone,
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
            if ($request->payment_method === 'cod') {
                if (Auth::check()) {
                    $otp = rand(1000, 9999);
                    $user = Auth::user();  // Get the authenticated user

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
                } else {
                    return response()->json([
                        'status'  => 'error',
                        'message' => 'User is not authenticated.',
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

                // Clear the cart
                Cart::where('user_id', $userId)->orWhere('guest_id', $guestId ?? null)->delete();
            }


            return response()->json([
                'success' => true,
                'message' => 'Order placed successfully!',
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

            // Clear OTP details
            $user->update([
                'otp_code' => null,
                'otp_expires_at' => null,
            ]);

            // Clear session
            session()->forget('pending_order');

            // Clear the cart
            Cart::where('guest_id', $guestId ?? null)->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Order placed successfully!',
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


    // public function verifyOtp(Request $request)
    // {
    //     // Validate the OTP
    //     $request->validate([
    //         'otp' => 'required|numeric|digits:4',  // Enforcing OTP to be exactly 4 digits
    //     ]);

    //     // Get the authenticated user
    //     $user = Auth::user();

    //     // Check if user exists
    //     if (!$user) {
    //         return response()->json(['status' => 'error', 'message' => 'User not found.'], 404);
    //     }

    //     // Check if OTP matches
    //     if ($user->otp_code !== $request->otp) {
    //         return response()->json(['status' => 'error', 'message' => 'Invalid OTP.'], 400);
    //     }

    //     // Check if OTP is expired
    //     if (Carbon::now()->isAfter($user->otp_expires_at)) {
    //         return response()->json(['status' => 'error', 'message' => 'OTP expired.'], 400);
    //     }

    //     // Clear OTP after successful verification
    //     $user->update([
    //         'otp_code' => null,
    //         'otp_expires_at' => null,
    //     ]);

    //     // Return success response
    //     return response()->json(['status' => 'success', 'message' => 'OTP verified successfully.']);
    // }




    public function thankyou()
    {
        Cart::where('user_id', Auth::id())->orWhere('guest_id', $guestId ?? null)->delete();
        return view('clientside.thankyou');
    }


    // protected function generateUniqueEmail(): string
    // {
    //     $baseEmail = 'examplemail'; // Replace with your desired base email

    //     $uniqueEmail = $baseEmail . Str::random(8) . '@gmail.com'; // Generate random 8-digit suffix

    //     // Check for uniqueness in the database using an appropriate query
    //     while (User::where('email', $uniqueEmail)->exists()) {
    //         $uniqueEmail = $baseEmail . Str::random(8) . '@gmail.com'; // Generate a new random suffix if collision occurs
    //     }

    //     return $uniqueEmail;
    // }

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
