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
        <h5>Edit Banner</h5>
        <form action="{{ route('admin.banners.update',$banner->id) }}" method="POST" enctype="multipart/form-data"
              class="mt-1 mb-3">
            @csrf
            @method('PUT')
            <div class="container-fluid border my-2 py-3">
                <a href="{{route ("admin.banners.index")}}" class="btn btn-primary"><- Back</a>
                <div class="row">
                    <div class="col-12 col-md-6 mx-auto">
                        <div class="card p-2">
                            <div class="mb-3">
                                <label for="name" class="form-label">Image</label>
                                <input type="file" class="form-control" id="image" name="image"
                                       value="{{ old('image') }}">
                                <div class="py-2">
                                    <img src="{{asset ($banner->image)}}" class="img-thumbnail" alt="">
                                    <input type="hidden" name="old_image" value="{{$banner->image}}">
                                </div>
                                @error('image')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select" id="status" name="status" required>
                                    <option value="1" {{ $banner->status == 1 ? 'selected' : '' }}>Active
                                    </option>
                                    <option value="0" {{$banner->status  == 0 ? 'selected' : '' }}>
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
