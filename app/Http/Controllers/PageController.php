<?php

    namespace App\Http\Controllers;

    use App\Models\Page;
    use Illuminate\Http\Request;
    use Illuminate\Support\Str;

    class PageController extends Controller {
        /**
         * Display a listing of the resource.
         */
        public function index () {
            $pages = Page::all ();
            return view ("admin.pages.index", compact ("pages"));
        }

        /**
         * Store a newly created resource in storage.
         */
        public function store (Request $request) {
            $request->validate ([
                "title"   => "required|string",
                "content" => "required",
            ]);
            Page::create ([
                "title"   => $request->title,
                "slug"    => Str::slug ($request->input ("title")),
                "content" => $request->input ('content'),
                "status"  => $request->input ("status"),
            ]);
            flash ("Page Create successfully.");
            return redirect ()->route ("admin.pages.index");
        }

        /**
         * Show the form for creating a new resource.
         */
        public function create () {
            return view ("admin.pages.create");
        }

        /**
         * Show the form for editing the specified resource.
         */
        public function edit (Page $page) {
            return view ("admin.pages.edit", compact ("page"));
        }

        /**
         * Update the specified resource in storage.
         */
        public function update (Request $request, Page $page) {
            $request->validate ([
                "title"   => "required|string",
                "content" => "required",
            ]);
            $page->title = $request->title;
            $page->status = $request->status;
            $page->content = $request->input ("content");
            $page->save ();
            flash ('Page Update successfully.');
            return redirect ()->back ();
        }

        /**
         * Remove the specified resource from storage.
         */
        public function destroy (Page $page) {
            $page->delete ();
            flash ("Page deleted.");
            return redirect ()->back ();
        }
    }
