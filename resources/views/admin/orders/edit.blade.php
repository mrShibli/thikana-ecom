@extends('layouts.master')
@section('content')
    <div class="container-fluid mt-5">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Orders</li>
            </ol>
        </nav>
        <h5>Update Order</h5>
        <div class="row py-5">
            <div class="col-12 col-md-8 mx-auto">
                <div class="py-3">
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-primary"><- Back</a>
                </div>
                <div class="card">
                    <div class="card-body">

                        <div class="mb-3">
                            <h4 class="py-1">Product Details</h4>
                            @if (!empty($order->products))
                                @php
                                    $order_items = $order->order_items;
                                @endphp
                                @foreach ($order->products as $product)
                                    <div class="card my-1">
                                        <div class="card-body">

                                            @php
                                                // Fetch the variation details using option_id
                                                $variationOption = \App\Models\VariationOption::find(
                                                    $order_items[$loop->index]->option_id,
                                                );
                                            @endphp

                                            <div class="d-flex justify-content-between align-items-center">
                                                <h6 class="py-1">Package#{{ $loop->index + 1 }}</h6>
                                                <div><img src="{{ asset($product->thumb_image) }}" alt=""
                                                        width="90">
                                                </div>
                                                <div>
                                                    <h6>{{ $product->title }}</h6>
                                                </div>
                                                <div class="d-block">
                                                    <div class="fw-bold text-danger">
                                                        Variation: {{$variationOption->name ?? 'N/A'}}</div>
                                                    <div class="fw-bold text-danger">
                                                        Quantity: {{ $order_items[$loop->index]->quantity }}</div>
                                                    <div class="fw-bold text-danger">
                                                        Subtotal:
                                                        {{ $order_items[$loop->index]->quantity * $product->old_price }}
                                                        TK
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>

                        <div class="mb-2">
                            <h4 class="py-1">Order Details</h4>
                            <div class="row py-2">
                                <div class="col-12 col-md-6 order-2">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <td class="text-center fw-bold" colspan="2">User Info</td>
                                            </tr>
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
                                <div class="col-12 col-md-6 order-1">
                                    <h6 class="py-2">Total Summary</h6>
                                    <div class="d-flex justify-content-between px-3 py-2">
                                        <div class="fs-5">Subtotal</div>
                                        <div class="fw-bold">{{ $order->total }}TK</div>
                                    </div>
                                    <div class="d-flex justify-content-between px-3">
                                        <div class="fs-5">Shipping Cost</div>
                                        <div class="fw-bold">{{ $order->shipping }}TK</div>
                                    </div>
                                    <hr>
                                    <div class="d-flex justify-content-between px-3">
                                        <div class="fs-5">Total</div>
                                        <div class="fw-bold">{{ $order->shipping + $order->total }}TK</div>
                                    </div>
                                    <div class="d-flex justify-content-between px-3">
                                        <div class="fs-5">Paid</div>
                                        <div class="fw-bold">0.00 TK</div>
                                    </div>
                                    <hr>
                                    <div class="d-flex justify-content-between px-3">
                                        <div class="fs-5">Total Due</div>
                                        <div class="fw-bold">{{ $order->shipping + $order->total }} TK</div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <form action="{{ route('admin.orders.update', $order->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" class="form-select">
                                    @if ($order->status === 'pending')
                                        <option value="pending" selected>Pending</option>
                                        <option value="processing">Processing</option>
                                        <option value="on_hold">On hold</option>
                                        <option value="canceled">Canceled</option>
                                    @elseif($order->status === 'processing')
                                        <option value="processing" selected>Processing</option>
                                        <option value="shipped">Shipped</option>
                                        <option value="canceled">Canceled</option>
                                    @elseif($order->status === 'on_hold')
                                        <option value="processing">Processing</option>
                                        <option value="on_hold" selected>On hold</option>
                                        <option value="canceled">Canceled</option>
                                    @elseif($order->status === 'shipped')
                                        <option value="shipped" selected>Shipped</option>
                                        <option value="delivered">Delivered</option>
                                    @elseif($order->status === 'delivered')
                                        <option value="delivered" selected>Delivered</option>
                                    @else
                                        <option value="canceled" selected>Canceled</option>
                                    @endif


                                </select>
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary"
                                    @if ($order->status === 'delivered' || $order->status === 'canceled') disabled @endif>Update</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
