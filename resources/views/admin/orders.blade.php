@extends('layouts.master')

@section('styles')
    <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" rel="stylesheet">
    <style>
        /* Add hover effect to rows */
        .clickable-row:hover {
            background-color: #fa2b2b !important;
            /* Light gray background on hover */
            cursor: pointer;
            /* Change cursor to pointer */
            transition: background-color 0.3s ease;
            /* Smooth transition effect */
        }
    </style>
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
            <form method="GET" action="{{ route('admin.orders.index') }}">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-select" onchange="this.form.submit()">
                    <option value="">Select Status</option>
                    <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="phone_not_rcv" {{ request('status') === 'phone_not_rcv' ? 'selected' : '' }}>Call Not
                        Received</option>
                    <option value="follow_up" {{ request('status') === 'follow_up' ? 'selected' : '' }}>Follow up</option>
                    <option value="processing" {{ request('status') === 'processing' ? 'selected' : '' }}>Processing
                    </option>
                    <option value="ready_for_delivery" {{ request('status') === 'ready_for_delivery' ? 'selected' : '' }}>
                        Ready For Delivery
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
                    <th>SL</th>
                    <th>ID</th>
                    <th>Name</th>
                    <th>phone</th>
                    <th>Product name</th>
                    <th>Total Price</th>
                    <th>Status</th>
                    <th>Order at</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @php
                    use Illuminate\Support\Str;
                @endphp
                @foreach ($orders as $order)
                    <tr data-href="{{ route('admin.orders.edit', $order->id) }}" class="clickable-row">
                        <td>{{ $loop->iteration }}</td> <!-- Serial Number -->
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->name }}</td>
                        <td>{{ $order->phone }}</td>
                        <td>
                            @foreach ($order->products as $product)
                                {{ Str::limit($product->title, 30, '...') }}@if (!$loop->last)
                                    <br>
                                @endif
                            @endforeach
                        </td>
                        <td>{{ $order->total }}</td>
                        <td>
                            <select class="form-select status-dropdown" data-order-id="{{ $order->id }}">
                                <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending
                                </option>
                                <option value="phone_not_rcv" {{ $order->status === 'phone_not_rcv' ? 'selected' : '' }}>
                                    Call Not Received</option>
                                <option value="follow_up" {{ $order->status === 'follow_up' ? 'selected' : '' }}>Follow up
                                </option>
                                <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>
                                    Processing</option>
                                <option value="ready_for_delivery"
                                    {{ $order->status === 'ready_for_delivery' ? 'selected' : '' }}>Ready For Delivery
                                </option>
                                <option value="delivered" {{ $order->status === 'delivered' ? 'selected' : '' }}>Delivered
                                </option>
                                <option value="on_hold" {{ $order->status === 'on_hold' ? 'selected' : '' }}>On Hold
                                </option>
                                <option value="shipped" {{ $order->status === 'shipped' ? 'selected' : '' }}>Shipped
                                </option>
                                <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled
                                </option>
                            </select>
                        </td>
                        <td>{{ $order->created_at->format('Y-m-d H:i:s') }}</td>
                        <td>
                            <a href="{{ route('admin.orders.edit', $order->id) }}">
                                <img src="{{ asset('edit.svg') }}" alt="" width="26">
                            </a>
                            <a href="{{ route('admin.orders.edit', $order->id) }}">
                                <img src="{{ asset('view.svg') }}" alt="" width="26">
                            </a>
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
            // Initialize DataTable
            $('#Products').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'pdf', 'csv', 'excel', 'print'
                ],
                order: [
                    [0, 'asc']
                ] // Keep the default order
            });

            // Make rows clickable
            $('#Products tbody').on('click', '.clickable-row', function() {
                const url = $(this).data('href');
                if (url) {
                    window.location.href = url;
                }
            });

            // Prevent row click event when interacting with dropdown
            $('.status-dropdown').on('click', function(event) {
                event.stopPropagation();
            });

            // AJAX call to update status
            $('.status-dropdown').on('change', function() {
                const orderId = $(this).data('order-id');
                const newStatus = $(this).val();

                $.ajax({
                    url: '{{ route('admin.orders.updateStatus') }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        order_id: orderId,
                        status: newStatus
                    },
                    success: function(response) {
                        if (response.success) {
                            alert(response.message);

                            // Update the status in the table without reordering
                            const statusClass = {
                                'pending': 'btn-warning',
                                'processing': 'btn-primary',
                                'delivered': 'btn-success',
                                'on_hold': 'btn-secondary',
                                'shipped': 'btn-info',
                                'phone_not_rcv': 'btn-info',
                                'follow_up': 'btn-info',
                                'ready_for_delivery': 'btn-info',
                                'cancelled': 'btn-danger'
                            };

                            // Update the button class and text dynamically
                            const row = $(`[data-order-id=${orderId}]`).closest('tr');
                            row.find('.btn')
                                .removeClass()
                                .addClass(`btn ${statusClass[newStatus]} btn-sm`)
                                .text(newStatus);
                        } else {
                            alert('Error: ' + response.message);
                        }
                    },
                    error: function() {
                        alert('An error occurred while updating the status. Please try again.');
                    }
                });
            });
        });
    </script>
@endsection
