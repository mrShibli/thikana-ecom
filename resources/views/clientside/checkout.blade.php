@extends('clientside.app.app')
@section('client-content')
    <div class="container mx-auto p-3 laptop:py-10">
        <h1 class="text-xl laptop:text-2xl text-blue text-center py-4">Checkout</h1>
        <div class="divider border mb-4 laptop:mb-8"></div>
        <form action="{{route ("order.store")}}" method="post">
            @csrf
        <div class="flex flex-wrap gap-4">

            <div class="laptop:w-1/2 border rounded p-2 laptop:p-4">
                    <h2 class="text-xl font-semibold mb-3">Billing details</h2>
                <div class="mb-3">
                    <input class="w-full p-1 pl-2 placeholder:text-xs placeholder:text-[#666666] border rounded"
                           type="text" name="name" placeholder="আপনার নাম লিখুন" id="">
                    @if($errors->get('name'))
                        <div class="font-light text-red-900 px-1">
                            @foreach ($errors->get('name') as $error)
                                <small>{{ $error }}</small>
                            @endforeach
                        </div>
                    @endif
                </div>
                <div class="mb-3">
                    <input class="w-full p-1 pl-2 placeholder:text-xs placeholder:text-[#666666] border rounded"
                           type="text" name="address"
                           placeholder="যেখানে ডেলিভারি নিবেন তা লিখুন যেমনঃ হোল্ডিং/গ্রাম/বাজার" id="">
                    @if($errors->get('address'))
                        <div class="font-light text-red-900 px-1">
                            @foreach ($errors->get('address') as $error)
                                <small>{{ $error }}</small>
                            @endforeach
                        </div>
                    @endif
                </div>
                <div class="mb-3">
                    <input class="w-full p-1 pl-2 placeholder:text-xs placeholder:text-[#666666] border rounded"
                           type="text" name="upazila" placeholder="আপনার থানা (পুলিশ স্টেশন) লিখুন" id="">
                    @if($errors->get('upazila'))
                        <div class="font-light text-red-900 px-1">
                            @foreach ($errors->get('upazila') as $error)
                                <small>{{ $error }}</small>
                            @endforeach
                        </div>
                    @endif
                </div>
                <div class="mb-3">
                    <input class="w-full p-1 pl-2 placeholder:text-xs placeholder:text-[#666666] border rounded"
                           type="text" name="city" placeholder="আপনার জেলা লিখুন" id="">
                    @if($errors->get('city'))
                        <div class="font-light text-red-900 px-1">
                            @foreach ($errors->get('city') as $error)
                                <small>{{ $error }}</small>
                            @endforeach
                        </div>
                    @endif
                </div>
                <div class="mb-3">
                    <input class="w-full p-1 pl-2  placeholder:text-xs placeholder:text-[#666666] border rounded"
                           type="tel" name="phone" placeholder="আপনার মোবাইল নাম্বার লিখুন" id="">
                    @if($errors->get('phone'))
                        <div class="font-light text-red-900 px-1">
                            @foreach ($errors->get('phone') as $error)
                                <small>{{ $error }}</small>
                            @endforeach
                        </div>
                    @endif
                </div>

                    <h5 class="text-xs laptop:text-sm my-5">প্রিয়জন কে চিরকুট দিতে আপনার Message এখানে লিখুন</h5>

                    <label class="block mb-2 text-sm text-gray-500" for="">Order notes (optional)</label>
                    <textarea
                            class="w-full p-1 pl-2 mb-2 placeholder:text-xs placeholder:text-[#666666] border rounded h-32 laptop:h-40 "
                            name="message" id="" cols="30" rows="8"></textarea>

            </div>

            <div class="laptop:w-[40%] border rounded p-4 ">

                <div id="cart-table" class="mb-4">
                    <h2 class="mb-5 text-xl font-semibold ">Your order</h2>
                    <table class="flex  justify-center">

                        <tr class="border  border-black">
                            <th class="border border-black p-2 px-4 text-sm">Product</th>
                            <th class="border border-black p-2 px-4 text-sm">Subtotal</th>
                        </tr>
                        @foreach($carts as $cart)
                            <tr>
                                @php
                                    $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $cart->product->title)));
                                @endphp
                                <td class="border border-black  p-2 px-4 text-xs" id="p-title">
                                    <a href="{{route ("product.single",['id'=>$cart->product->id,'slug'=>$slug])}}">
                                        {{$cart->product->title}} X {{$cart->qunt}}
                                    </a></td>
                                <td class="border border-black p-2 px-4 text-xs" id="p-price">
                                    {{$cart->price * $cart->qunt}}৳
                                </td>
                            </tr>
                        @endforeach

                        <tr>
                            <td class="border border-black p-2 px-4 text-xs">Subtotal</td>
                            <td class="border border-black p-2 px-4 text-xs" id="Subtotal">{{$sub_total}}৳</td>
                        </tr>
                        <tr>
                            <td class="border border-black p-2 px-4 text-xs">Shipping</td>
                            <td class="border border-black p-2 px-4 text-xs" id="flat-rate">Flat rate: 70৳</td>
                        </tr>
                        <tr>
                            <td class="border border-black p-2 px-4 text-xs"> Total</td>
                            <td class="border border-black p-2 px-4 text-xs" id="flat-rate">
                                {{$sub_total + 70}}৳
                            </td>
                        </tr>

                    </table>
                </div>

                <div class="bg-[#E9E6ED] p-3 rounded">
                    <h5 class="text-sm mb-4">Cash on delivery</h5>
                    <p class="text-sm bg-[#DCD7E3] p-3 rounded">Product হাতে পেয়ে মুল্য পরিশোধ করুন।</p>
                    <div class="divider border border-gray-300 my-4"></div>
                    <p class="text-xs">Your personal data will be used to process your order, support your experience
                        throughout this website, and for other purposes described in our privacy policy.</p>
                    <button type="submit"
                       class="block py-3 px-3 fw-bold text-white bg-[#7F54B3] hover:bg-[#7249A4] rounded text-center mt-3 text-xs">অর্ডার Confirm করুন</button>
                </div>


            </div>

        </div>

        </form>
    </div>
@endsection
