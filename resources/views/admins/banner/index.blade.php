@extends('layouts.master')

@section('styles')
    <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" rel="stylesheet">
@endsection

@section('content')
    <div class="container mt-5">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Products</li>
            </ol>
        </nav>
        <h5>All Banners</h5>
        <hr>
        <a href="{{route ("admin.banners.create")}}" class="btn btn-primary rounded mb-2">Add banner</a>
        <table class="table table-striped" id="Products">
            <thead>
            <tr>
                <th>#</th>
                <th>Image</th>
              <th>Status</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($banners as $banner)
                <tr>
                    <td>{{ $loop->index  +1}}</td>
                    <td>
                        <img src="{{ asset($banner->image) }}" alt="" width="120">
                    </td>
                    <td>
                        <span class="btn btn-{{$banner->status?"success":"danger"}}">
                            {{$banner->status?"Active":"Inactive"}}
                        </span>
                    </td>
                    <td>
                        <a href="{{route ("admin.banners.edit",$banner->id)}}">
                            <img src="{{ asset('edit.svg') }}" alt="" width="26">
                        </a>
                        <form action="{{route ("admin.banners.destroy",$banner->id)}}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure?')">
                                <img src="{{ asset('delete.svg') }}" alt="" width="26">
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#Products').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'pdf', 'csv', 'excel', 'print'
                ]
            });
        });
    </script>
@endsection
