<?php

    namespace App\Http\Controllers;

    use App\Models\Banner;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\File;
    use Illuminate\Support\Facades\Storage;

    class BannerController extends Controller {
        /**
         * Display a listing of the resource.
         */
        public function index () {
            $banners = Banner::orderBy ("updated_at", "desc")->get ();
            return view ("admins.banner.index", compact ("banners"));
        }

        /**
         * Store a newly created resource in storage.
         */
        public function store (Request $request) {
            $request->validate ([
                "image"  => "required",
                "status" => "required",
            ]);
            if ($request->hasFile ("image")) {
                $filePath = $request->file ("image");
                $imagePath = Storage::disk ("public")->put ("banner", $filePath);
            }

            $banner = Banner::create ([
                "image"  => $imagePath ?? "",
                "status" => $request->status,
            ]);
            if (!$banner) {
                flash ()->error ("Banner not Create.");
                return redirect ()->back ()->withInput ();
            }
            flash  ("Banner Create Successfully.");
            return redirect ()->route ("admin.banners.index");
        }

        /**
         * Show the form for creating a new resource.
         */
        public function create () {
            return view ("admins.banner.create");
        }

        /**
         * Display the specified resource.
         */
        public function show (Banner $banner) {}

        /**
         * Show the form for editing the specified resource.
         */
        public function edit (Banner $banner) {
            return view ("admins.banner.edit", compact ("banner"));
        }

        /**
         * Update the specified resource in storage.
         */
        public function update (Request $request, Banner $banner) {
            $request->validate ([
                "status" => "required",
            ]);
            $imagePath = $request->old_image;
            if ($request->hasFile ("image")) {
                if (File::exists (public_path () . "/" . $request->old_image)) {
                    unlink (public_path () . "/" . $request->old_image);
                }
                $filePath = $request->file ("image");
                $imagePath = Storage::disk ("public")->path ("banner", $filePath);
            }
            $banner->image = $imagePath;
            $banner->status = $request->status;
            $banner->save ();
            flash ("Banner Updated Successfully.");
            return redirect ()->back ();
        }

        /**
         * Remove the specified resource from storage.
         */
        public function destroy (Banner $banner) {
            if ($banner) {
                if (File::exists (public_path () . "/" . $banner->image)) {
                    unlink (public_path () . "/" . $banner->image);
                }
                $banner->delete ();
                flash ("Banner delete Successfully.");
                return redirect ()->back ();
            }
            flash ("No Banner Found.","error");
            return redirect ()->back ();
        }
    }
