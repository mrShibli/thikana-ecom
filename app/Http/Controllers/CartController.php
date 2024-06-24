<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index() {
        $cart = Cart::where('user_id', Auth::user()->id)->get();
        return view('clientside.cart', compact('cart'));
    }

    public function store (Request $request)
    {
         // Validate the request
         $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|integer',
            'option_id' => 'required|integer',
        ]);

        // Create the cart item
        Cart::create([
            'product_id' => $request->product_id,
            'qunt' => $request->quantity ?? 1,
            'price' => $request->price,
            'option_id' => $request->option_id,
            'user_id' => Auth::user()->id,
        ]);

        return redirect()->back()->with('success', 'Item added to cart successfully');
    }
}
