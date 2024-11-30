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


    protected function generateUniqueEmail(): string
    {
        $baseEmail = 'examplemail'; // Replace with your desired base email

        $uniqueEmail = $baseEmail . Str::random(8) . '@gmail.com'; // Generate random 8-digit suffix

        // Check for uniqueness in the database using an appropriate query
        while (User::where('email', $uniqueEmail)->exists()) {
            $uniqueEmail = $baseEmail . Str::random(8) . '@gmail.com'; // Generate a new random suffix if collision occurs
        }

        return $uniqueEmail;
    }


    // Stor Order for Direct Buy Now
    public function buynoworder(Request $request)
    {

        // return $request->all();

        // Validate the request
        $request->validate([
            'name'    => 'required|string',
            'address' => 'required|string',
            'phone'   => 'required|string',
            'upazila' => 'required|string',
            'city'    => 'required|string',
            'message' => 'nullable|string',
            'product_id' => 'required',
        ]);

        if (Auth::check()) {
            $userId = Auth::id();
        } else {

            $password = bcrypt('password');
            $user = User::create([
                'name'     => $request->name,
                'email'    => $this->generateUniqueEmail(),
                'password' => $password,
            ]);

            $userId = $user->id;
            Auth::login($user);
        }

        $order = Order::create([
            'name'      => $request->name,
            'address'   => $request->address,
            'phone'     => $request->phone,
            'upazila'   => $request->upazila,
            'city'      => $request->city,
            'message'   => $request->message,
            'shipping'  => $request->shipping ?? 120,
            'total'     => $request->price * $request->pqty + ($request->shipping ?? 120),
            'user_id'   => $userId,
        ]);

        if ($order) {
            order_item::create([
                'order_id'   => $order->id,
                'product_id' => $request->product_id,
                'option_id' => $request->option_id,
                'quantity'   => $request->pqty,
                'price'      => $request->price,
                'sub_total'  => $request->price * $request->pqty,
            ]);

            // Send SMS notification
            // $this->smsService->sendSMS($request->phone, "Dear {$order->name}, Your order has been placed successfully. Order ID: {$order->id}");
        }


        return redirect()->route('index')->with('success', 'Order placed successfully');
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
