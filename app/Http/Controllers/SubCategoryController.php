<?php

    namespace App\Http\Controllers;

    use App\Models\ProductCategory;
    use App\Models\SubCategory;
    use Illuminate\Http\Request;
    use Illuminate\Support\Str;

    class SubCategoryController extends Controller {
        /**
         * Display a listing of the resource.
         */
        public function index () {
            $sub_categories = SubCategory::with ("category")-> get ();
            return view ("admin.product.subCategory.index", compact ("sub_categories"));
        }

        /**
         * Store a newly created resource in storage.
         */
        public function store (Request $request) {
            $request->validate ([
                "name"        => "required|string",
                "category_id" => "required",
            ]);
            $subCategory = SubCategory::create ([
                "name"                => $request->name,
                "slug"                => Str::slug ($request->name),
                "product_category_id" => $request->category_id,
                "description"         => $request->description,
                "status"              => $request->status,
                "show_menu"           => (bool)$request->show_menu,
            ]);
            if ($subCategory) {
                flash ()->success ("subCategory create successfully.");
            } else {
                flash ()->error ("product not create");
            }
            return redirect ()->route ("admin.sub-categories.index");
        }

        /**
         * Show the form for creating a new resource.
         */
        public function create () {
            $categories = ProductCategory::select ([
                "name",
                "id"
            ])->where ("status", true)->get ();
            return view ("admin.product.subCategory.create", compact ("categories"));
        }

        /**
         * Display the specified resource.
         */
        public function show (SubCategory $subCategory) {
            //
        }

        /**
         * Show the form for editing the specified resource.
         */
        public function edit (SubCategory $subCategory) {
            $categories = ProductCategory::get ();
            return view ("admin.product.subCategory.edit", compact ("subCategory", "categories"));
        }

        /**
         * Update the specified resource in storage.
         */
        public function update (Request $request, SubCategory $subCategory) {
            $request->validate ([
                "name"        => "required|string",
                "category_id" => "required",
            ]);
            $subCategory->name = $request->name;
            $subCategory->product_category_id = $request->category_id;
            $subCategory->description = $request->description;
            $subCategory->status = $request->status;
            $subCategory->show_menu = (bool)$request->show_menu;
            $subCategory->save ();
            flash ()->success ("subCategory update successfully.");
            return redirect ()->back ();
        }

        /**
         * Remove the specified resource from storage.
         */
        public function destroy (SubCategory $subCategory) {
            if ($subCategory) {
                $subCategory->delete ();
                flash ()->success ('subCategory delete successfully.');
            }
            return redirect ()->back ();
        }
    }
