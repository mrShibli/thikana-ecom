@extends('layouts.master')

@section('styles')
    <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" rel="stylesheet">
@endsection

@section('content')
    <div class="container-fluid mt-5">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Orders</li>
            </ol>
        </nav>
        <h5>All Orders</h5>
        <hr>
        <div class="col-2 py-3">
            <form method="GET" action="{{ route('asigned.orders') }}">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-select" onchange="this.form.submit()">
                    <option value="">Select Status</option>
                    <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="processing" {{ request('status') === 'processing' ? 'selected' : '' }}>Processing
                    </option>
                    <option value="delivered" {{ request('status') === 'delivered' ? 'selected' : '' }}>Delivered
                    </option>
                    <option value="on_hold" {{ request('status') === 'on_hold' ? 'selected' : '' }}>On Hold</option>
                    <option value="shipped" {{ request('status') === 'shipped' ? 'selected' : '' }}>Shipped</option>
                    <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Cancelled
                    </option>
                </select>
            </form>

        </div>
        <table class="table table-striped" id="Products">
            <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>phone</th>
                <th>Product Id</th>
                <th>Product name</th>
                <th>address</th>
                <th>Total Price</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td> {{ $order->name }}</td>
                    <td> {{ $order->phone }}</td>
                    <td> @foreach($order->products as $product)
                            {{ $product->id }}@if($loop->index < 2)
                                ,
                            @endif
                        @endforeach</td>
                    <td> @foreach($order->products as $product)
                            {{ $product->title }}@if($loop->index <2)
                                <br>
                            @endif
                        @endforeach</td>
                    <td> {{ $order->upazila }},{{$order->city}},{{$order->address}}</td>
                    <td> {{ $order->total }}</td>
                    <td>
                        @php
                            $statusClass = 'danger'; // Default class
                            if ($order->status === 'pending') {
                                $statusClass = 'warning';
                            } elseif ($order->status === 'processing') {
                                $statusClass = 'primary';
                            } elseif ($order->status === 'delivered') {
                                $statusClass = 'success';
                            } elseif ($order->status === 'on_hold') {
                                $statusClass = 'secondary';
                            } elseif ($order->status === 'shipped') {
                                $statusClass = 'info';
                            }
                        @endphp
                        <span class="btn btn-{{ $statusClass }} btn-sm">
                            {{ $order->status }}
                        </span>
                    </td>
                    <td>
                        <a href="{{route ("admin.orders.edit",$order->id)}}">
                            <img src="{{ asset('edit.svg') }}" alt="" width="26">
                        </a>
                        <form action="" method="POST" class="d-inline">

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
        $(document).ready(function () {
            $('#Products').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'pdf', 'csv', 'excel', 'print'
                ]
            });
        });
    </script>
@endsection
