@extends('clientside.app.app')

@section('client-content')
<div class="container mx-auto p-3 laptop:py-10">

    <!-- Thank You Message Section -->
    <div class="bg-green-100 border-t-4 border-green-500 p-5 mb-8 rounded">
        <h2 class="text-2xl font-semibold text-center text-green-800">Thank You for Your Order!</h2>
        <p class="text-center text-green-700 mt-2">Your order has been successfully placed. We will process it shortly and send you a confirmation email with further details.</p>
    </div>

    @if (isset($order) && $order->order_items->count() > 0)
        <!-- Order Summary Section -->
        <div class="bg-white shadow-lg rounded-lg p-6 mb-8">
            <h3 class="text-xl font-semibold mb-5">Order Summary</h3>
            <table class="min-w-full table-auto border-separate border-spacing-2">
                <thead>
                    <tr class="text-left text-sm font-medium text-gray-600">
                        <th class="py-2 px-4 border-b">Product</th>
                        <th class="py-2 px-4 border-b">Quantity</th>
                        <th class="py-2 px-4 border-b">Price</th>
                        <th class="py-2 px-4 border-b">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->order_items as $item)
                        <tr class="text-sm">
                            <td class="py-3 px-4 border-b">{{ $item->product->name ?? 'Unknown Product' }}</td>
                            <td class="py-3 px-4 border-b">{{ $item->quantity }}</td>
                            <td class="py-3 px-4 border-b">${{ number_format($item->product->price, 2) }}</td>
                            <td class="py-3 px-4 border-b">${{ number_format($item->product->price * $item->quantity, 2) }}</td>
                        </tr>
                    @endforeach
                    <tr class="text-sm font-semibold">
                        <td colspan="3" class="py-3 px-4 text-right">Total</td>
                        <td class="py-3 px-4">${{ number_format($order->order_items->sum(function($item) { return $item->product->price * $item->quantity; }), 2) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    @else
        <div class="bg-white p-4 rounded-md shadow-md mb-8">
            <p class="text-center text-gray-600">No items found in your order.</p>
        </div>
    @endif

    <!-- Contact or Support Section -->
    <div class="text-center">
        <p class="text-sm text-gray-600">If you have any questions or need assistance, feel free to contact us at <a href="mailto:support@yourcompany.com" class="text-blue-600 hover:text-blue-800">support@thikana.shop</a>.</p>
    </div>

</div>
@endsection
