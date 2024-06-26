<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller {
    public function index() {
        $cart = Cart::where('user_id', Auth::user()->id)->get();
        $sub_total = 0;
        foreach ($cart as $item) {
            $sub_total += $item->price * $item->qunt;
        }
        return view ('clientside.cart', compact ('cart', 'sub_total'));
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

        $cart = Cart::where ('user_id', Auth::user ()->id)->where ('product_id', $request->product_id)->first ();
        if ($cart) {
            $cart->update ([
                'qunt' => $cart->qunt + $request->quantity,
            ]);
        } else {
            // Create the cart item
            Cart::create ([
                'product_id' => $request->product_id,
                'qunt'       => $request->quantity ?? 1,
                'price'      => $request->price,
                'option_id'  => $request->option_id,
                'user_id'    => Auth::user ()->id,
            ]);
        }
        return redirect()->back()->with('success', 'Item added to cart successfully');
    }

    //destroy
    public function destroy ($id): RedirectResponse {
        $cart = Cart::find ($id);
        $cart->delete ();
        return redirect ()->back ()->with ('success', 'Item remove to cart successfully');
    }
    //checkout
    public function checkout () {
        $carts = Cart::with ("product")->where ('user_id', Auth::user ()->id)->get ();
        $sub_total = 0;
        foreach ($carts as $item) {
            $sub_total += $item->price * $item->qunt;
        }
        return view ('clientside.checkout', compact ('carts', 'sub_total'));
    }
}
