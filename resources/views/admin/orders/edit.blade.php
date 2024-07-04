@extends('layouts.master')
@section("content")
    <div class="container-fluid mt-5">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Orders</li>
            </ol>
        </nav>
        <h5>Update Order</h5>
        <div class="row">
            <div class="col-12 col-md-8 mx-auto">
                <div class="py-3">
                    <a href="{{route ("admin.orders.index")}}" class="btn btn-sm btn-primary"><- Back</a>
                </div>
                <div class="card">
                    <div class="card-body">
                        <form action="{{route ("admin.orders.update",$order->id)}}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" class="form-select">
                                    @if($order->status === "pending")
                                        <option value="pending" selected>Pending</option>
                                        <option value="processing">Processing</option>
                                        <option value="on_hold">On hold</option>
                                        <option value="canceled">Canceled</option>
                                    @elseif($order->status === "processing")
                                        <option value="processing" selected>Processing</option>
                                        <option value="shipped">Shipped</option>
                                        <option value="canceled">Canceled</option>
                                    @elseif($order->status==="on_hold")
                                        <option value="processing">Processing</option>
                                        <option value="on_hold" selected>On hold</option>
                                        <option value="canceled">Canceled</option>
                                    @elseif($order->status ==="shipped")
                                        <option value="shipped" selected>Shipped</option>
                                        <option value="delivered">Delivered</option>
                                    @elseif($order->status ==="delivered")
                                        <option value="delivered" selected>Delivered</option>
                                    @else
                                        <option value="canceled" selected>Canceled</option>
                                    @endif


                                </select>
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary" @if($order->status === "delivered" || $order->status ==="canceled") disabled @endif>Update</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
