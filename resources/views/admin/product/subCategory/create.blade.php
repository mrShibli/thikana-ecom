@extends('layouts.master')

@section('content')
    <div class="container-fluid mt-5">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">SubCategory</li>
            </ol>
        </nav>
        <h5>Add SubCategory</h5>

        {{--        <!-- Display Validation Errors -->--}}
        {{--        @if ($errors->any())--}}
        {{--            <div class="alert alert-danger">--}}
        {{--                <ul>--}}
        {{--                    @foreach ($errors->all() as $error)--}}
        {{--                        <li>{{ $error }}</li>--}}
        {{--                    @endforeach--}}
        {{--                </ul>--}}
        {{--            </div>--}}
        {{--        @endif--}}

        <form action="{{ route('admin.sub-categories.store') }}" method="POST" enctype="multipart/form-data"
              class="mt-1 mb-3">
            @csrf
            <div class="container-fluid border my-2 py-3">
                <div class="row">
                    <div class="col-12 col-md-6 mx-auto">
                        <div class="card p-2">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                       value="{{ old('name') }}" placeholder="subCategory name" required>
                                @error('name')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="category_id" class="form-label">Category</label>
                                <select class="form-select" id="category_id" name="category_id" required>
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Description</label>
                                <textarea class="form-control" name="description"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select" id="status" name="status" required>
                                    <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Active
                                    </option>
                                    <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>
                                        Inactive
                                    </option>
                                </select>
                                @error('status')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" name="show_menu" type="checkbox"
                                           id="flexSwitchCheckChecked">
                                    <label class="form-check-label" for="flexSwitchCheckChecked">Show in menu</label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Create Category</button>
                        </div>

                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
