<?php

namespace App\Http\Controllers\Product;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Http\Controllers\Controller;

class ProductCategoryController extends Controller
{
    // Category page 
    public function index()
    {
        $categories = ProductCategory::get();
        return view('admin.product.category.index', compact('categories'));
    }

    // Category Create 
    public function create()
    {
        return view('admin.product.category.create');
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:product_categories',
            'description' => 'nullable',
            'meta_title' => 'nullable',
            'meta_description' => 'nullable',
            'meta_keywords' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'background_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|in:active,inactive',
        ]);

        // Handle file upload for image
        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('category_images', $imageName, 'public');
        }

        // Handle file upload for background image
        $backgroundImagePath = null;
        if ($request->hasFile('background_image')) {
            $backgroundImage = $request->file('background_image');
            $backgroundImageName = time() . '_' . uniqid() . '.' . $backgroundImage->getClientOriginalExtension();
            $backgroundImagePath = $backgroundImage->storeAs('category_background_images', $backgroundImageName, 'public');
        }

        // Create a new product category
        ProductCategory::create([
            'name' => $request->name,
            'slug' => Str::slug($request->slug),
            'description' => $request->description,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
            'image' => $imagePath,
            'background_image' => $backgroundImagePath,
            'status' => $request->status,
        ]);

        return redirect()->route('product_categories.create')->with('success', 'Product category created successfully.');
    }
}
