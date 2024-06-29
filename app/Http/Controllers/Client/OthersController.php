<?php

    namespace App\Http\Controllers\Client;

    use App\Http\Controllers\Controller;
    use App\Models\Activities;
    use App\Models\Product;

    class OthersController extends Controller {
        public function index () {
            $features_products = Product::where('status', 1)->inRandomOrder()
                ->select(['id', 'title','thumb_image','old_price','offer'])
                ->take (5)->get ();
            $products = Product::where('status',1)->inRandomOrder ()
                ->select (['id', 'title','thumb_image','old_price','offer'])
                ->take (20)->get ();
            $activities = Activities::get ();
            return view('clientside.index', compact('products','features_products','activities'));
        }

        public function  shop () {
            return view ("clientside.shop");
        }

        public function refund () {
            return view ("clientside.refund_returns");
        }
        public function policy () {
            return view ("clientside.privacy-policy");
        }
    }
