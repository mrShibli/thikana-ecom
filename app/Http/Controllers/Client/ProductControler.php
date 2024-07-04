<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Contracts\View\View;

class ProductControler extends Controller
{
    public function index($id, $slug) : View {
        $product = Product::where('status', 1)->where('id',$id)->first();
        $related_products = Product::where ('status', 1)->where ("category_id", $product->category_id)
            ->take (8)
            ->inRandomOrder ()
            ->get ();
        return view('clientside.singelProduct', compact('product','related_products'));
    
    }
}
