@extends('layouts.master')

@section('content')
    <div class="container-fluid mt-5">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Pages</li>
            </ol>
        </nav>
        <h5>Add Page</h5>
        <form action="{{ route('admin.pages.store') }}" method="POST"
              class="mt-1 mb-3">
            @csrf
            <div class="container-fluid border my-2 py-3">
                <a href="{{route ("admin.pages.index")}}" class="btn btn-primary"><- Back</a>
                <div class="row">
                    <div class="col-12 col-md-8 mx-auto">
                        <div class="card p-2">
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{old ("title")}}" required>
                                @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="content" class="form-label">Content</label>
                                <textarea class="form-control @error('content') is-invalid @enderror" id="content"
                                          name="content" rows="3"
                                          placeholder="Enter page content">{{ old('content') }}</textarea>
                                @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
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
                            <button type="submit" class="btn btn-primary">Create Page</button>
                        </div>

                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@section("scripts")
    <script src="https://cdn.tiny.cloud/1/rf8c9vd0hbcj6ki31dx8rjngpd0dfag96p1qyaymeifshg95/tinymce/5/tinymce.min.js"
            referrerpolicy="origin"></script>
    <script>
        // Initialize TinyMCE editor
        tinymce.init({
            selector: '#content',
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
