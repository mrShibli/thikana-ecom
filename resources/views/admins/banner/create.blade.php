@extends('layouts.master')

@section('content')
    <div class="container-fluid mt-5">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Banner</li>
            </ol>
        </nav>
        <h5>Add Banner</h5>
        <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data"
              class="mt-1 mb-3">
            @csrf
            <div class="container-fluid border my-2 py-3">
                <a href="{{route ("admin.banners.index")}}" class="btn btn-primary"><- Back</a>
                <div class="row">
                    <div class="col-12 col-md-6 mx-auto">
                        <div class="card p-2">
                            <div class="mb-3">
                                <label for="name" class="form-label">Image</label>
                                <input type="file" class="form-control" id="image" name="image"
                                       value="{{ old('image') }}" required>
                                @error('image')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
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
                            <button type="submit" class="btn btn-primary">Create Category</button>
                        </div>

                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
