<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ProductControler extends Controller
{
    public function index($id, $slug) : View {
        $product = Product::where('status', 1)->where('id',$id)->first();
    
        // Validate slug (optional)
        // $expectedSlug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $product->title)));
    
        // if ($slug !== $expectedSlug) {
        //     abort(404);
        // }
    
        return view('clientside.singelProduct', compact('product'));
    
    }
}
