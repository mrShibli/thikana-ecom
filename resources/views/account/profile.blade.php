@extends('clientside.app.app')

@section('client-content')
    <div class="container mx-auto p-8">



        <div class="bg-white shadow-md rounded-lg p-6 grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Profile Section -->
            <div class="col-span-1">
                <div class="flex items-center space-x-4">
                    <img src="http://127.0.0.1:8000/clientside/images/profile.png" alt="Profile Image"
                        class="w-16 h-16 rounded-full mr-2">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-800">{{ $user->name }}</h1>
                        <p class="text-gray-600">{{ $user->email }}</p>
                    </div>
                </div>
                <div class="mt-6 space-y-4">
                    <div>
                        <strong class="text-gray-600">Phone:</strong>
                        <p class="text-gray-800">{{ $user->phone ?? 'Not provided' }}</p>
                    </div>
                    <div>
                        <strong class="text-gray-600">Address:</strong>
                        <p class="text-gray-800">{{ $user->address ?? 'Not provided' }}</p>
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('account.edit') }}"
                            class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                            Edit Profile
                        </a>
                    </div>
                </div>
            </div>

            <!-- Order History Section -->
            <div class="col-span-2">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Your Orders</h2>
                <div class="space-y-4">

                    @foreach ($user->orders as $order)
                        <div class="bg-gray-100 p-4 rounded-lg shadow-sm mb-6">
                            <div class="flex justify-between">
                                <div>
                                    <strong class="text-gray-800">Order #{{ $order->id }}</strong><br>
                                    <span class="text-sm text-gray-500">{{ $order->created_at->format('F j, Y') }}</span>
                                </div>
                                <div class="text-right">
                                    <strong class="text-blue-600 text-lg">${{ number_format($order->total, 2) }}</strong>
                                </div>
                            </div>

                            <!-- Loop through products in the order -->
                            <div class="mt-4">
                                <strong class="text-gray-800">Products:</strong>
                                <ul class="mt-2 space-y-2">
                                    @foreach ($order->products as $product)
                                        <li class="flex justify-between text-gray-700">
                                            <span>{{ $product->title }} (x{{ $product->quantity }})</span>
                                            <span>${{ number_format($product->offer, 2) }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            <div class="mt-4 text-right">
                                <a href=""
                                    class="text-blue-600 hover:underline">View Details</a>
                            </div>
                        </div>
                    @endforeach


                </div>
            </div>

            <!-- Settings Section -->
            <div class="col-span-1">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Account Settings</h2>
                <div class="space-y-4">
                    <!-- Change Password, Email Settings, etc. -->
                    <div>
                        <a href="" class="text-blue-500">Change Password</a>
                    </div>




                    <a class="text-red-500 mt-1" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
