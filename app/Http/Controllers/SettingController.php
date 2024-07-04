<?php

    namespace App\Http\Controllers;

    use App\Models\Setting;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Storage;

    class SettingController extends Controller {
        /**
         * Display a listing of the resource.
         */
        public function index () {
            $setting = Setting::first ();
            return view ("admin.settings.index", compact ("setting"));
        }

        /**
         * Store a newly created resource in storage.
         */
        public function store (Request $request, $id = 1) {
            $request->validate ([
                "title"    => "required",
                "slogan"   => "required",
                "email"    => "required|email",
                'phone'    => "required",
                "address"  => "required",
                "logo"     => "nullable",
                "old_logo" => "nullable"
            ]);
            $logo = "null";
            if ($request->has ("old_logo")) {
                $logo = $request->old_logo;
            }
            if ($request->hasFile ('logo')) {
                $filePath = $request->file ("logo");
                $logo = Storage::disk ("public")->put ("logo", $filePath);
            }
            $checkSetting = Setting::first ();
            if ($checkSetting) {
                $checkSetting->title = $request->title;
                $checkSetting->email = $request->email;
                $checkSetting->slogan = $request->slogan;
                $checkSetting->phone = $request->phone;
                $checkSetting->address = $request->address;
                $checkSetting->logo = $logo;
                $checkSetting->save ();

            } else {
                $setting = Setting::create ([
                    "title"   => $request->title,
                    "email"   => $request->email,
                    "slogan"  => $request->slogan,
                    "phone"   => $request->phone,
                    "address" => $request->address,
                    "logo"    => $logo
                ]);
            }

            flash ('setting Updated');
            return redirect ()->back ();
        }

    }
