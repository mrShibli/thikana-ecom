@extends('layouts.master')

@section('content')
    <div class="container mt-5">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Product Create</li>
            </ol>
        </nav>

        @session('success')
            <div class="alert alert-success" role="alert">
                {{ Session('success') }}
            </div>
        @endsession
        <h5 class="mb-2">Product Creation Form</h5> <hr>
        <!-- Tabs for different sections -->
        <ul class="nav nav-tabs" id="productFormTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="basic-info-tab" data-bs-toggle="tab" data-bs-target="#basic-info"
                    type="button" role="tab" aria-controls="basic-info" aria-selected="true">Basic Information</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="details-tab" data-bs-toggle="tab" data-bs-target="#details" type="button"
                    role="tab" aria-controls="details" aria-selected="false">Details</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pricing-tab" data-bs-toggle="tab" data-bs-target="#pricing" type="button"
                    role="tab" aria-controls="pricing" aria-selected="false">Pricing & Inventory</button>
            </li>
        </ul>
        <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="tab-content mt-3" id="productFormTabsContent">
                <!-- Basic Information Tab -->
                <div class="tab-pane fade show active" id="basic-info" role="tabpanel" aria-labelledby="basic-info-tab">
                    <div class="mb-3">
                        <label for="productName" class="form-label">Product Name</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="productName" placeholder="Enter product name" value="{{ old('title') }}" >
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="productDescription" class="form-label">Product Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="productDescription" name="description" rows="3" placeholder="Enter product description">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="productThumbnail" class="form-label">Thumbnail Image</label>
                        <input type="file" class="form-control @error('thumb_image') is-invalid @enderror" id="productThumbnail" name="thumb_image" >
                        @error('thumb_image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="productGallery" class="form-label">Gallery Images</label>
                        <input type="file" class="form-control @error('images') is-invalid @enderror" name="images[]" id="productGallery" accept="image/*" multiple>
                        @error('images')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button class="btn btn-primary" type="button" data-bs-toggle="tab" data-bs-target="#details">Next: Details</button>
                </div>
                <!-- Details Tab -->
                <div class="tab-pane fade" id="details" role="tabpanel" aria-labelledby="details-tab">
                    <h2>Variations</h2>
                    <div id="variations">
                        <div class="variation">
                            <label>Variation Name:</label>
                            <input type="text" class="form-control" name="variations[0][name]" value="{{ old('variations.0.name') }}"><br>
                            <div class="options">
                                <div class="option">
                                    <label>Option Name:</label>
                                    <input type="text" class="form-control" name="variations[0][options][0][name]" value="{{ old('variations.0.options.0.name') }}"><br>
                                    <label>Option Price:</label>
                                    <input type="text" class="form-control" name="variations[0][options][0][price]" value="{{ old('variations.0.options.0.price') }}"><br>
                                </div>
                            </div>
                            <button type="button" class="btn btn-primary m-3" onclick="addOption(this)">Add Option</button>
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary my-2" onclick="addVariation()">Add Variation</button><br><br>
                    <div class="mb-3">
                        <label for="productCategory" class="form-label">Category</label>
                        <select class="form-select" name="category_id" id="productCategory">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="productSubCategory" class="form-label">Sub Category</label>
                        <input type="text" class="form-control" name="sub_category_id" id="productSubCategory" placeholder="Enter sub category" value="{{ old('sub_category_id') }}">
                    </div>
                    <div class="mb-3">
                        <label for="productTags" class="form-label">Tags</label>
                        <input type="text" class="form-control" name="tags" id="productTags" placeholder="Enter product tags" value="{{ old('tags') }}">
                    </div>
                    <button class="btn btn-secondary" type="button" data-bs-toggle="tab" data-bs-target="#basic-info">Back: Basic Information</button>
                    <button class="btn btn-primary" type="button" data-bs-toggle="tab" data-bs-target="#pricing">Next: Pricing & Inventory</button>
                </div>
                <!-- Pricing & Inventory Tab -->
                <div class="tab-pane fade" id="pricing" role="tabpanel" aria-labelledby="pricing-tab">
                    <div class="mb-3">
                        <label for="productOldPrice" class="form-label">Old Price</label>
                        <input type="number" class="form-control" name="old_price" id="productOldPrice" placeholder="Enter regular product price" value="{{ old('old_price') }}" >
                    </div>
                    <div class="mb-3">
                        <label for="productOfferPrice" class="form-label">Offer Price</label>
                        <input type="number" class="form-control" name="offer" id="productOfferPrice" placeholder="Enter offer product price" value="{{ old('offer') }}" >
                    </div>
                    <div class="mb-3">
                        <label for="productQuantity" class="form-label">Quantity</label>
                        <input type="number" class="form-control" name="quantity" id="productQuantity" placeholder="Enter product quantity" value="{{ old('quantity') }}" >
                    </div>
                    <div class="mb-3">
                        <label for="productStatus" class="form-label">Status</label>
                        <select class="form-select" name="status" id="productStatus" >
                            <option value="">Select product status</option>
                            <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                    <button class="btn btn-secondary" type="button" data-bs-toggle="tab" data-bs-target="#details">Back: Details</button>
                    <button class="btn btn-success" type="submit">Create Product</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.tiny.cloud/1/rf8c9vd0hbcj6ki31dx8rjngpd0dfag96p1qyaymeifshg95/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        // Initialize TinyMCE editor
        tinymce.init({
            selector: '#productDescription',
            height: 300,
            plugins: [
                'advlist autolink lists link image charmap print preview anchor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table paste code help wordcount'
            ],
            toolbar: 'undo redo | formatselect | ' +
                'bold italic backcolor | alignleft aligncenter ' +
                'alignright alignjustify | bullist numlist outdent indent | ' +
                'removeformat | help',
            content_style: 'body { font-family: Arial, sans-serif; font-size: 14px }'
        });

        function addVariation() {
            const variationsDiv = document.getElementById('variations');
            const variationCount = variationsDiv.children.length;

            const variationDiv = document.createElement('div');
            variationDiv.classList.add('variation');

            variationDiv.innerHTML = `
                <label>Variation Name:</label>
                <input type="text" class="form-control" name="variations[${variationCount}][name]"><br>
                
                <div class="options">
                    <div class="option">
                        <label>Option Name:</label>
                        <input type="text" class="form-control" name="variations[${variationCount}][options][0][name]"><br>
                        <label>Option Price:</label>
                        <input type="text" class="form-control" name="variations[${variationCount}][options][0][price]"><br>
                    </div>
                </div>
                <button type="button" class="btn btn-primary ms-4" onclick="addOption(this)">Add Option</button>
            `;

            variationsDiv.appendChild(variationDiv);
        }

        function addOption(button) {
            const optionsDiv = button.previousElementSibling;
            const optionCount = optionsDiv.children.length;

            const optionDiv = document.createElement('div');
            optionDiv.classList.add('option');

            const variationIndex = Array.from(optionsDiv.parentElement.parentElement.children).indexOf(optionsDiv.parentElement);

            optionDiv.innerHTML = `
                <label>Option Name:</label>
                <input type="text" class="form-control" name="variations[${variationIndex}][options][${optionCount}][name]"><br>
                <label>Option Price:</label>
                <input type="text" class="form-control" name="variations[${variationIndex}][options][${optionCount}][price]"><br>
            `;

            optionsDiv.appendChild(optionDiv);
        }
    </script>
@endsection
