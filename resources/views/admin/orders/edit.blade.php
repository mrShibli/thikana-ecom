@extends('layouts.master')

@section('content')
    <style>
        table.table {
            white-space: nowrap;
            border: 0.1px solid #C6C7C8;
        }
    </style>
    <div class="container-fluid mt-5">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-white p-3 shadow-sm">
                <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Orders</li>
            </ol>
        </nav>

        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Update Order</h5>
            </div>
            <div class="card-body">
                <!-- Back Button -->
                <div class="mb-4">
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                </div>

                <!-- Product Details -->
                <div class="mb-4">
                    <h4 class="mb-3">Product Details</h4>
                    @if (!empty($order->products))
                        @php $order_items = $order->order_items; @endphp
                        @foreach ($order->products as $product)
                            <div class="card mb-3 border-0 shadow-sm">
                                <div class="card-body d-flex align-items-center justify-content-between">
                                    @php
                                        $variationOption = \App\Models\VariationOption::find(
                                            $order_items[$loop->index]->option_id,
                                        );
                                    @endphp
                                    <div>
                                        <h6 class="mb-1">Package #{{ $loop->index + 1 }}</h6>
                                        <h6>{{ $product->title }}</h6>
                                        <p class="text-muted mb-0">Variation:
                                            <strong>{{ $variationOption->name ?? 'N/A' }}</strong>
                                        </p>
                                        <p class="text-muted mb-0">Quantity:
                                            <strong>{{ $order_items[$loop->index]->quantity }}</strong>
                                        </p>
                                        <p class="text-muted">Subtotal:
                                            <strong>{{ $order_items[$loop->index]->quantity * $product->old_price }}
                                                TK</strong>
                                        </p>
                                    </div>
                                    <img src="{{ asset('storage/' . $product->thumb_image) }}" width="120"
                                        alt="Product Image" class="rounded" width="100">

                                </div>
                            </div>
                        @endforeach
                    @else
                        <p class="text-muted">No products found for this order.</p>
                    @endif
                </div>

                <!-- Order Details -->
                <div class="mb-4">
                    <h4 class="mb-3">Order Details</h4>
                    <div class="row g-4">
                        <div class="col-md-6">
                            <table class="table table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th colspan="2" class="text-center">Customer Info</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>Name</th>
                                        <td>{{ $order->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Phone</th>
                                        <td>{{ $order->phone }}</td>
                                    </tr>
                                    <tr>
                                        <th>Upazila</th>
                                        <td>{{ $order->upazila }}</td>
                                    </tr>
                                    <tr>
                                        <th>City</th>
                                        <td>{{ $order->city }}</td>
                                    </tr>
                                    <tr>
                                        <th>Address</th>
                                        <td>{{ $order->address }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <div class="border p-3 rounded shadow-sm">
                                <h6 class="mb-3">Total Summary</h6>
                                <div class="d-flex justify-content-between">
                                    <span>Subtotal</span>
                                    <span class="fw-bold">{{ $order->total }} TK</span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span>Shipping Cost</span>
                                    <span class="fw-bold">{{ $order->shipping }} TK</span>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between">
                                    <span>Total</span>
                                    <span class="fw-bold">{{ $order->shipping + $order->total }} TK</span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span>Paid</span>
                                    <span class="fw-bold">0.00 TK</span>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between">
                                    <span>Total Due</span>
                                    <span class="fw-bold">{{ $order->shipping + $order->total }} TK</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Order Status Form -->
                <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="status" class="form-label">Order Status</label>
                                <select name="status" id="status" class="form-select"
                                    {{ in_array($order->status, ['delivered', 'canceled']) ? 'disabled' : '' }}>
                                    <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending
                                    </option>
                                    <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>
                                        Processing
                                    </option>
                                    <option value="phone_not_rcv" {{ $order->status === 'phone_not_rcv' ? 'selected' : '' }}>
                                        Call Not Received
                                    </option>
                                    <option value="follow_up" {{ $order->status === 'follow_up' ? 'selected' : '' }}>
                                        Follow up
                                    </option>
                                    <option value="on_hold" {{ $order->status === 'on_hold' ? 'selected' : '' }}>On Hold
                                    </option>
                                    <option value="shipped" {{ $order->status === 'shipped' ? 'selected' : '' }}>Shipped
                                    </option>
                                    <option value="ready_for_delivery" {{ $order->status === 'ready_for_delivery' ? 'selected' : '' }}>
                                        Ready For Delivery
                                    </option>
                                    <option value="delivered" {{ $order->status === 'delivered' ? 'selected' : '' }}>
                                        Delivered
                                    </option>
                                    <option value="canceled" {{ $order->status === 'canceled' ? 'selected' : '' }}>Canceled
                                    </option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label for="status" class="form-label">Assign Order for</label>
                                <select name="assign" id="assign" class="form-select">
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{$user->name}} : {{  $user->email }}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary"
                            {{ in_array($order->status, ['delivered', 'canceled']) ? 'disabled' : '' }}>Update
                            Order</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
