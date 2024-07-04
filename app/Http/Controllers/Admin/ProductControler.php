<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductVariationOption;
use App\Models\SubCategory;
use App\Models\Variation;
use App\Models\VariationOption;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductControler extends Controller
{
    public function index()
    {
        $products = Product::get(['id', 'title', 'thumb_image', 'old_price']);
        return view('admin.product.index', compact('products'));
    }
    public function productCreate()
    {
        $categories = ProductCategory::where('status', 'active')->get(['id','name']);
        $sub_categories = SubCategory::where ('status', 1)->get ([
            'id',
            'name'
        ]);
        return view ('admin.product.create', compact ('categories', 'sub_categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'thumb_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // 2MB limit
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // 2MB limit for each image
            'old_price' => 'required|numeric|min:0',
            'offer' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'status' => 'required|in:0,1',
            'variations.*.name' => 'required|string|max:255',
            'variations.*.options.*.name' => 'required|string|max:255',
            'variations.*.options.*.price' => 'required|numeric|min:0',
        ]);

        ##--Store thumbnail image
        $thumbImage = $request->file('thumb_image');
        $thumbImagePath = 'product/' . time() . '-' . $thumbImage->getClientOriginalName();
        $thumbImage->storeAs('public', $thumbImagePath);
        ##--Store gallery images
        $galleryImages = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $galleryImagePath = 'product/' . time() . '-' . $image->getClientOriginalName();
                $image->storeAs('public', $galleryImagePath);
                $galleryImages[] = $galleryImagePath;
            }
        }
        
        $product = Product::create([
            'title' => $request->input('title'),
            'slug'            => Str::slug ($request->input ('title')),
            'description' => $request->input('description'),
            'thumb_image' => $thumbImagePath,
            'images'          => json_encode ($galleryImages, JSON_THROW_ON_ERROR),
            'old_price' => $request->input('old_price'),
            'offer' => $request->input('offer'),
            'quantity' => $request->input('quantity'),
            'status' => $request->input('status'),
            'category_id' => $request->input('category_id'),
            'sub_category_id' => $request->input ('sub_category_id'),
            'tags' => $request->input('tags'),
        ]);

        foreach ($request->input('variations') as $variationData) {
            $variation = new Variation(['name' => $variationData['name']]);
            $product->variations()->save($variation);

            foreach ($variationData['options'] as $optionData) {
                $option = new VariationOption([
                    'name' => $optionData['name'],
                    'price' => $optionData['price']
                ]);
                $variation->options()->save($option);

                ProductVariationOption::create([
                    'product_id' => $product->id,
                    'variation_option_id' => $option->id,
                    'price' => $optionData['price']
                ]);
            }
        }

        return redirect ()->route ('product.index')->with ('success', 'Product created successfully.');

    }

    public function edit (Product $product) {
        $categories = ProductCategory::where ('status', 'active')->get ([
            'id',
            'name'
        ]);
        $sub_categories = SubCategory::where ('status', 1)->get ([
            'id',
            'name'
        ]);
        $variations = Variation::with ("options")->where ("product_id", $product->id)->get ();
        return view ("admin.product.edit", compact ('product', 'sub_categories', 'categories', 'variations'));
    }

    public function update (Request $request, Product $product) {
        $request->validate ([
            'title'                        => 'required|string|max:255',
            'description'                  => 'required|string',
            'old_price'                    => 'required|numeric|min:0',
            'offer'                        => 'required|numeric|min:0',
            'quantity'                     => 'required|integer|min:0',
            'status'                       => 'required|in:0,1',
            'variations.*.name'            => 'required|string|max:255',
            'variations.*.options.*.name'  => 'required|string|max:255',
            'variations.*.options.*.price' => 'required|numeric|min:0',
        ]);
        $thumbImagePath = $request->old_thumb;
        if ($request->hasFile ("thumb_image")) {
            ##--Store thumbnail image
            $thumbImage = $request->file ('thumb_image');
            $thumbImagePath = 'product/' . time () . '-' . $thumbImage->getClientOriginalName ();
            $thumbImage->storeAs ('public', $thumbImagePath);
        }
        $update = Product::where ('id', $product->id)->update ([
            'title'           => $request->input ('title'),
            'description'     => $request->input ('description'),
            'thumb_image'     => $thumbImagePath,
            'old_price'       => $request->input ('old_price'),
            'offer'           => $request->input ('offer'),
            'quantity'        => $request->input ('quantity'),
            'status'          => $request->input ('status'),
            'category_id'     => $request->input ('category_id'),
            'sub_category_id' => $request->input ('sub_category_id'),
            'tags'            => $request->input ('tags'),
        ]);
        if ($update) {
            $deleteVariation = Variation::where ("product_id", $product->id)->delete ();
            foreach ($request->input ('variations') as $variationData) {
                $variation = new Variation(['name' => $variationData['name']]);
                $product->variations ()->save ($variation);

                foreach ($variationData['options'] as $optionData) {
                    $option = new VariationOption([
                        'name'  => $optionData['name'],
                        'price' => $optionData['price']
                    ]);
                    $variation->options ()->save ($option);

                    ProductVariationOption::create ([
                        'product_id'          => $product->id,
                        'variation_option_id' => $option->id,
                        'price'               => $optionData['price']
                    ]);
                }
            }
        }
        flash ("Product Updated");
        return redirect ()->back ();

    }

    public function destroy (Product $product) {
        if ($product) {
            $product->delete ();
            flash ("Product Delete successfully.");
        } else {
            flash ("No Product Found!");
        }
        return redirect ()->back ();
    }
}
