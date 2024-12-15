@extends('clientside.app.app')

@section('client-content')
    <div class="container mx-auto p-5 laptop:py-10 bg-white rounded shadow-lg mt-4 mb-4 max-w-2xl">
        <!-- Right Side Buttons -->
        <div class="flex justify-end mb-4">
            <!-- Print Button -->
            <button onclick="window.print()" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                Print
            </button>

            <!-- Download PDF Button -->
            <a href="{{ route('downloadOrderPDF', ['orderId' => $order->id]) }}"
                class="ml-4 bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
                Download PDF
            </a>
        </div>
        <!-- Thank You Message -->
        <div class="border-dashed border-4 border-blue-400 text-center py-6 mb-8">
            <h2 class="text-xl font-semibold text-blue-600">Thank You {{ $order->name }}. Your Order Has Been Received.</h2>
        </div>

        <!-- Order Summary Section -->
        @if (isset($order))
            <div class="flex flex-wrap justify-between gap-6 text-sm text-gray-700 mb-8">
                <div class="flex-1 text-center">
                    <p class="font-medium">Order number:</p>
                    <p class="text-gray-600">{{ $order->id }}</p>
                </div>
                <div class="flex-1 text-center">
                    <p class="font-medium">Date:</p>
                    <p class="text-gray-600">{{ date('F j, Y', strtotime($order->created_at)) }}</p>
                </div>
                <div class="flex-1 text-center">
                    <p class="font-medium">Total:</p>
                    <p class="text-gray-600">${{ number_format($order->total, 2) }}</p>
                </div>
                <div class="flex-1 text-center">
                    <p class="font-medium">Payment method:</p>
                    <p class="text-gray-600">{{ strtoupper($order->payment_method) }}</p>
                </div>
            </div>


            <!-- Payment Notes -->
            <p class="text-gray-600 text-center mb-8">Pay with cash upon delivery.</p>

            <!-- Order Details -->
            <div class="border-t pt-4">
                <h2 class="text-lg font-semibold mb-4">ORDER DETAILS</h2>
                <table class="w-full text-sm text-gray-700 border-collapse">
                    <thead>
                        <tr class="border-b">
                            <th class="py-2 px-4 text-left font-medium">PRODUCT</th>
                            <th class="py-2 px-4 text-right font-medium">TOTAL</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orderItems as $item)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-3 px-4">{{ $item->product->title }} × {{ $item->quantity }}</td>
                                <td class="py-3 px-4 text-right">${{ number_format($item->price * $item->quantity, 2) }}
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td class="py-3 px-4 font-medium">Subtotal:</td>
                            <td class="py-3 px-4 text-right">${{ number_format($order->subtotal, 2) }}</td>
                        </tr>
                        <tr>
                            <td class="py-3 px-4 font-medium">Shipping:</td>
                            <td class="py-3 px-4 text-right">
                                {{ $order->shipping_cost > 0 ? '$' . number_format($order->shipping_cost, 2) : 'Free shipping' }}
                            </td>
                        </tr>
                        <tr>
                            <td class="py-3 px-4 font-medium">Payment method:</td>
                            <td class="py-3 px-4 text-right">{{ strtoupper($order->payment_method) }}</td>
                        </tr>
                        <tr>
                            <td class="py-3 px-4 font-medium text-lg">TOTAL:</td>
                            <td class="py-3 px-4 text-right text-lg font-bold">${{ number_format($order->total, 2) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        @else
            <!-- Fallback Message -->
            <div class="text-center py-8">
                <p class="text-gray-500">No order details found.</p>
            </div>
        @endif

        <!-- Footer -->
        <div class="text-center mt-8">
            <p class="text-sm text-gray-500">
                If you have any questions, please contact us at
                <a href="mailto:support@thikana.shop" class="text-blue-600 hover:text-blue-800">support@thikana.shop</a>.
            </p>
        </div>
    </div>
@endsection
