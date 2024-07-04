<?php

    namespace App\Http\Controllers\Client;

    use App\Http\Controllers\Controller;
    use App\Models\Activities;
    use App\Models\Banner;
    use App\Models\Page;
    use App\Models\Product;
    use App\Models\ProductCategory;
    use App\Models\SubCategory;
    use Illuminate\Http\Request;

    class OthersController extends Controller {
        public function index () {
            $features_products = Product::where('status', 1)->inRandomOrder()
                ->select(['id', 'title','thumb_image','old_price','offer'])
                ->take (5)->get ();
            $products = Product::where('status',1)->inRandomOrder ()
                ->select (['id', 'title','thumb_image','old_price','offer'])
                ->take (20)->get ();
            $activities = Activities::get ();
            $banners = Banner::where ("status", 1)->get ();
            $categories = ProductCategory::whereNotNull ("image")->inRandomOrder ()->take (8)->get ();
            return view ('clientside.index', compact ('products', 'features_products', 'activities', 'banners', 'categories'));
        }

        public function shop (Request $request, $category = null, $sub_category = null) {
            $categories = ProductCategory::with ("subCategory")->get ();
            $products = Product::where ("status", 1);
            $data = [];
            //apply filter
            if ($category) {
                $cat = ProductCategory::where ("slug", $category)->first ();
                if ($cat) {
                    $sub_categories = SubCategory::select ("name", "slug")->where ("product_category_id", $cat->id)->get ();
                    $data["sub_categories"] = $sub_categories;
                    $products = $products->where ("category_id", $cat->id);
                }
            }
            //apply sub category filter
            if (!empty($sub_category)) {
                $sub_cat = SubCategory::where ("slug", $sub_category)->first ();
                if ($sub_cat) {
                    $products = $products->where ("sub_category_id", $sub_cat->id);
                }
            }
            $data["price_min"] = 0;
            $data["price_max"] = 1000;
            if ($request->get ("price_min") !== '' && $request->get ("price_max") !== '' && $request->has ("price_min") && $request->has ("price_max")) {
                $data["price_min"] = $request->get ("price_min");
                $data["price_max"] = $request->get ("price_max");
                if ($request->get ("price_max") === 1000) {
                    $products = $products->whereBetween ("old_price", [
                        $request->get ("price_min"),
                        100000
                    ]);
                } else {
                    $products = $products->whereBetween ("old_price", [
                        intval ($request->get ("price_min")),
                        intval ($request->get ("price_max"))
                    ]);
                }

            }
            //sorting
            $data["sort_value"] = "";
            if ($request->has ("sort")) {
                if ($request->get ("sort") === "price_desc") {
                    $products = $products->orderBy ("old_price", "DESC");
                } elseif ($request->get ("sort") === "price_asc") {
                    $products = $products->orderBy ("old_price", "asc");
                } else {
                    $products = $products->orderBy ("updated_at", "DESC");
                }
                $data["sort_value"] = $request->get ("sort");
            }
            $products = $products->get ();
            $data["products"] = $products;
            $data["categories"] = $categories;
            $data["selected_category"] = $category;
            $data["selected_sub_category"] = $sub_category;
            return view ("clientside.shop", $data);
        }

        public function page ($slug) {
            $page = Page::where ("status", 1)->where ("slug", $slug)->first ();
            if (!$page) {
                abort (404);
            }
            return view ("clientside.refund_returns", compact ("page"));
        }
    }
