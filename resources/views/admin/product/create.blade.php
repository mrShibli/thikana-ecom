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
        <!-- Tab content -->
        <div class="tab-content mt-3" id="productFormTabsContent">
            <!-- Basic Information Tab -->
            <div class="tab-pane fade show active" id="basic-info" role="tabpanel" aria-labelledby="basic-info-tab">
                <form>
                    <div class="mb-3">
                        <label for="productName" class="form-label">Product Name</label>
                        <input type="text" class="form-control" id="productName" placeholder="Enter product name"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="productDescription" class="form-label">Product Description</label>
                        <textarea class="form-control" id="productDescription" rows="3" placeholder="Enter product description"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="productThumbnail" class="form-label">Thumbnail Image</label>
                        <input type="file" class="form-control" id="productThumbnail" accept="image/*" required>
                    </div>
                    <div class="mb-3">
                        <label for="productGallery" class="form-label">Gallery Images</label>
                        <input type="file" class="form-control" id="productGallery" accept="image/*" multiple>
                    </div>
                    <button class="btn btn-primary" type="button" data-bs-toggle="tab" data-bs-target="#details">Next:
                        Details</button>
                </form>
            </div>
            <!-- Details Tab -->
            <div class="tab-pane fade" id="details" role="tabpanel" aria-labelledby="details-tab">
                <form>
                    <div class="mb-3">
                        <label for="productBrand" class="form-label">Brand</label>
                        <input type="text" class="form-control" id="productBrand" placeholder="Enter product brand">
                    </div>
                    <div class="mb-3">
                        <label for="productCategory" class="form-label">Category</label>
                        <input type="text" class="form-control" id="productCategory"
                            placeholder="Enter product category">
                    </div>
                    <div class="mb-3">
                        <label for="productTags" class="form-label">Tags</label>
                        <input type="text" class="form-control" id="productTags" placeholder="Enter product tags">
                    </div>
                    <div class="mb-3">
                        <label for="productSKU" class="form-label">SKU</label>
                        <input type="text" class="form-control" id="productSKU" placeholder="Enter product SKU">
                    </div>
                    <button class="btn btn-secondary" type="button" data-bs-toggle="tab"
                        data-bs-target="#basic-info">Back:
                        Basic Information</button>
                    <button class="btn btn-primary" type="button" data-bs-toggle="tab" data-bs-target="#pricing">Next:
                        Pricing & Inventory</button>
                </form>
            </div>
            <!-- Pricing & Inventory Tab -->
            <div class="tab-pane fade" id="pricing" role="tabpanel" aria-labelledby="pricing-tab">
                <form>
                    <div class="mb-3">
                        <label for="productPrice" class="form-label">Price</label>
                        <input type="number" class="form-control" id="productPrice" placeholder="Enter product price"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="productQuantity" class="form-label">Quantity</label>
                        <input type="number" class="form-control" id="productQuantity"
                            placeholder="Enter product quantity" required>
                    </div>
                    <div class="mb-3">
                        <label for="productStatus" class="form-label">Status</label>
                        <select class="form-select" id="productStatus" required>
                            <option value="">Select product status</option>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                    <button class="btn btn-secondary" type="button" data-bs-toggle="tab"
                        data-bs-target="#details">Back: Details</button>
                    <button class="btn btn-success" type="submit">Create Product</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.tiny.cloud/1/lopjhs08vcypia5sw6jqd0kbmi4683hw5e2tkqzm3b8s4ikp/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
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
    </script>
@endsection
