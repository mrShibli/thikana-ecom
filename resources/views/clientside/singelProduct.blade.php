@extends('clientside.app.app')

@section('client-content')
    <!-- -----------product-single-page--------- -->
    <div class="container mx-auto">
        @if (session('success'))
            <div class="text-center text-red py-2 bg-red text-white text-2xl">

                {{ session('success') }}
            </div>
        @endif
    </div>
    @if ($errors->any())
        <div class="alert alert-danger text-center py-2">
            <ul>
                @foreach ($errors->all() as $error)
                    <li class="text-red">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <div class=" container mx-auto my-5 flex flex-wrap gap-4 p-3 ">
        <div class="w-full laptop:w-[430px] border rounded p-2">
            <div class="laptop:hidden tablet:hidden desktop:hidden">
                <a class="text-xs text-red hover:text-blue" href="{{ route('index') }}">Home <i
                        class="fas fa-angle-right text-xs text-gray-400"></i></a>
                <a class="text-xs text-red hover:text-blue" href="">Products <i
                        class="fas fa-angle-right text-xs text-gray-400"></i></a>
                <h2 class="p-title my-2 text-base tablet:table laptop:text-[17px] leading-6">Ramadan Special Premium
                    Dawah T-Shirt । নিশ্চই কষ্টের সাথেই স্বস্তি রয়েছে</h2>
            </div>
            
            <div class="flex gap-1">
                @php
                    $productImages = json_decode($product->images, false, 512, JSON_THROW_ON_ERROR);
                @endphp
            
                <img class="{{ $productImages ? 'w-80' : 'w-100' }} object-contain" 
                     src="{{ asset('storage/' . $product->thumb_image) }}" 
                     alt="">
            
                @if($productImages)
                    <div class="image-gallery px-1">
                        @foreach ($productImages as $image)
                            <img class="w-14 h-16 laptop:w-24 laptop:h-28 object-cover mb-1 border border-red" 
                                 src="{{ asset('storage/' . $image) }}" 
                                 alt="">
                        @endforeach
                    </div>
                @endif
            </div>
            


        </div>
        <div class=" w-full laptop:w-[460px] border rounded p-3">
            <div class="hidden laptop:block">
                <a class="text-xs text-red hover:text-blue" href="{{ route('index') }}">Home <i
                        class="fas fa-angle-right text-xs text-gray-400"></i></a>
                <a class="text-xs text-red hover:text-blue" href="">Products <i
                        class="fas fa-angle-right text-xs text-gray-400"></i></a>
                <h2 class="p-title my-2 text-sm tablet:table laptop:text-[17px] leading-6">{{ $product->title }}</h2>
            </div>


            <div class="mt-4">
                @if ($product->offer)
                    <p class="px-2 py-1 bg-[#F38A0E] rounded text-xs text-white font-bold inline-block">Sale!</p>
                    <h1 class="text-base tablet:text-xl laptop:text-2xl font-bold"><span
                            class="text-red line-through">{{ $product->old_price }}৳</span>
                        <span id="updateOfferPrice">{{ $product->offer }}</span> ৳
                    </h1>
                @else
                    <span id="updateOfferPrice">{{ $product->old_price }}</span> ৳
                @endif
            </div>

            @php
                $optinId = null;
            @endphp
            @foreach ($product->variations as $variations)
                <div class="p-size mt-5">
                    <h4 class="font-semibold mb-2">{{ $variations->name }}</h4>
                    <div class="flex gap-2">
                        @foreach ($variations->options as $options)
                            @php
                                $optinId = $options->id;
                            @endphp
                            <div
                                class="black p-[2px] border border-gray-500 rounded hover:border-2 hover:border-gray-600 transition-all">
                                <button class="py-1 px-2 transition-all text-sm"
                                    onclick="optionsPrice({{ $options->price }},{{ $options->id }})">{{ $options->name }}</button>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach

            <!-- Shared quantity input -->
            <div class="flex items-center gap-2 my-5">
                <input type="number" id="sharedQuantity" value="1" min="1" style="padding: 9px 0px; text-align:center;"
                    class="border text-black rounded w-12" />

                <!-- Add to Cart Form -->
                <form action="{{ route('cart.store') }}" method="get" class="inline">
                    <input type="hidden" name="quantity" id="cartQuantity" value="1" />
                    <input type="hidden" name="product_id" value="{{ $product->id }}" />
                    <input type="hidden" name="price" id="cartPriceId"
                        value="{{ $product->offer ?? $product->old_price }}" />
                    <input name="main_price" type="hidden" value="{{ $product->offer ?? $product->old_price }}">
                    @if ($optinId)
                        <input type="hidden" name="option_id" value="{{ $optinId }}" id="cart_option_id" />
                    @endif
                    <button type="submit" onclick="updateQuantityBeforeSubmit(this.form)"
                        class="py-2 px-6 laptop:py-3 laptop:px-10 bg-blue rounded text-white text-sm font-bold">
                        Add To Cart
                    </button>
                </form>

                <!-- Buy Now Form -->
                <form action="{{ route('buy.store') }}" method="get" class="inline">
                    <input type="hidden" name="quantity" id="buyQuantity" value="1" />
                    <input type="hidden" name="product_id" value="{{ $product->id }}" />
                    <input type="hidden" name="price" id="buyPriceId"
                        value="{{ $product->offer ?? $product->old_price }}" />
                    <input name="main_price" type="hidden" value="{{ $product->offer ?? $product->old_price }}">
                    @if ($optinId)
                        <input type="hidden" name="option_id" value="{{ $optinId }}" id="buy_option_id" />
                    @endif
                    <button type="submit" onclick="updateQuantityBeforeSubmit(this.form)"
                        class="py-2 px-6 laptop:py-3 laptop:px-10 bg-red rounded text-white text-sm tablet:text-base laptop:text-base font-bold">
                        Buy Now
                    </button>
                </form>
            </div>


        </div>


        <div class="w-full laptop:w-[330px] ">

            <div class="p-4 border border-dashed border-blue">
                <p class="mb-3 text-xs laptop:text-sm"><i
                        class="fa-solid fa-square-check text-sm text-blue mr-2"></i>Delivery
                    Charge: সারা বাংলাদেশে একই থাকবে</p>
                <p class="mb-3 text-xs laptop:text-sm"><i
                        class="fa-solid fa-square-check text-sm text-blue mr-2"></i>Delivery
                    Charge: টি শার্ট ৭০ /-</p>
                <p class="mb-3 text-xs laptop:text-sm"><i
                        class="fa-solid fa-square-check text-sm text-blue mr-2"></i>Delivery
                    Charge: শাড়ি পাঞ্জাবিতে ১০০ /-</p>
                <p class="mb-3 text-xs laptop:text-sm"><i
                        class="fa-solid fa-square-check text-sm text-blue mr-2"></i>Delivery
                    Charge: ২৪৯৯+ শপিং এ ফ্রি</p>
                <p class="mb-3 text-xs laptop:text-sm"><i
                        class="fa-solid fa-square-check text-sm text-blue mr-2"></i>Product
                    হাতে পেয়ে মূল্য পরিশোধ।</p>
                <p class="mb-3 text-xs laptop:text-sm"><i
                        class="fa-solid fa-square-check text-sm text-blue mr-2"></i>Product
                    পছন্দ না হলে সাথে সাথেই Return এর সুযোগ।</p>
                <p class="mb-3 text-xs laptop:text-sm"><i
                        class="fa-solid fa-square-check text-sm text-blue mr-2"></i>Order
                    Confirmation এর ০২-০৪ দিনের ভিতর ডেলিভারী।</p>
                <p class="mb-3 text-xs laptop:text-sm"><i
                        class="fa-solid fa-square-check text-sm text-blue mr-2"></i>Video
                    Review দেখে Product এর Quality সম্পর্কে নিশ্চিত হওয়া।</p>
            </div>

            <div>
                <iframe class="mt-5 rounded" src="https://www.youtube.com/embed/MvOTNP_xQ7A?si=4eR_nfb_qj42-bns"
                    height="160" width="290"></iframe>

            </div>


        </div>

    </div>


    <!-- -----------------deskcription------------------------ -->



    <div class="deskcription-box container mx-auto py-10 p-3">
        <div class="flex justify-center items-center gap-2 border-b-2 border-gray-400 pb-1">
            <h1
                class="description py-3 px-8 rounded bg-[#6B7280] font-medium text-white text-base cursor-pointer hover:bg-gray-600">
                Description</h1>
            <h1
                class="Additional-information py-3 px-8 rounded bg-[#6B7280] font-medium text-white text-base cursor-pointer hover:bg-gray-600">
                Additional information</h1>
        </div>

        <div class="d-bx">
            <h1 class="text-2xl laptop:text-3xl text-black my-4">Description</h1>
            {!! $product->description !!}

        </div>

        <div class="a-information">
            <h1 class="text-2xl laptop:text-3xl text-black my-4">Additional information</h1>

            <div id="additional_information" style="width: 100%">

                @foreach ($product->variations as $variations)
                    {{-- {{ $variations }} --}}
                    <div class="gap-4 my-5" style="flex-wrap: nowrap; justify-content: center; align-items: center">
                        <p id="weight" class="text-sm font-bold border-r border-r-slate-300 ">{{ $variations->name }}
                        </p>
                        @foreach ($variations->options as $options)
                            {{-- <div class="border-r border-r-slate-300" style="flex-wrap: nowrap; justify-content: center; align-items: center""> --}}
                            <p class="text-sm text-gray-500">{{ $options->name }}</p>
                            <p class="text-sm text-gray-500">Price: {{ $options->price }}</p>
                            <div class="border-r border-r-slate-300" style="    background: #cbd5e1;height: 19px;"></div>
                            {{-- </div> --}}
                        @endforeach
                    </div>
                    <hr>
                @endforeach

                {{-- <div class=" gap-4 mb-5">
                <p id="dimensions" class="text-sm font-bold px-5 border-r border-r-slate-300">Dimensions </p>
                <p class="text-sm text-gray-500">8 × 11 × 4 cm</p>
                </div>

                <div class="gap-4 mb-5">
                <p id="color" class="text-sm font-bold px-5 border-r border-r-slate-300"> Color </p>
                <p class="text-sm text-gray-500">Black, Dark Olive, Light Purple, White</p>
                </div>

                <div class="gap-4 mb-5">
                 <p id="size" class="text-sm font-bold px-5 border-r border-r-slate-300">Size </p>
                 <p class="text-sm text-gray-500">L, M, XL, XXL</p>
                </div>
                 --}}

            </div>

        </div>

    </div>

    <div class="container mx-auto p-3 laptop:py-8">
        <h2 class="my-7 text-blue text-base laptop:text-xl font-semibold ">Related Products</h2>

        <div class="grid grid-cols-2 gap-2 tablet:grid-cols-3 laptop:grid-cols-4">

            @foreach ($related_products as $related_product)
                @php
                    $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $related_product->title)));
                @endphp
                <div class="swiper-slide text-center border rounded p-1 w-50">
                    <a href="{{ route('product.single', ['slug' => $slug, 'id' => $related_product->id]) }}">
                        <img class="bg-slate-100 p-2 w-full h-48 object-cover"
                            src="{{ asset('storage/' . $related_product->thumb_image) }}" alt="">
                    </a>
                    <h5 class="title text-sm laptop:text-base font-hindSiliguri">{{ $related_product->title }}</h5>
                    <p class="my-3">
                        @if ($related_product->offer)
                            <span class="regular line-through text-red mr-2">{{ $related_product->old_price }}৳</span>
                            <span class="special">{{ $related_product->offer }}৳</span>
                        @else
                            <span class="special">{{ $related_product->old_price }}৳</span>
                        @endif
                    </p>
                    <a href="{{ route('product.single', ['slug' => $slug, 'id' => $related_product->id]) }}"
                        class="py-2 block bg-blue text-white text-center rounded-xl text-xs laptop:text-base">View
                        Product</a>
                </div>
            @endforeach
            @if (count($related_products) === 0)
                <h3 class="text-red">No Related product Found!</h3>
            @endif

        </div>

    </div>

    <script>
        // Function to handle quantity changes and ensure minimum value is 1
        function handleQuantityChange() {
            const quantityInput = document.getElementById('sharedQuantity');
            if (quantityInput.value < 1) {
                quantityInput.value = 1;
            }
        }

        // Add event listener to shared quantity input
        document.getElementById('sharedQuantity').addEventListener('change', handleQuantityChange);

        // Function to update hidden quantity fields before form submission
        function updateQuantityBeforeSubmit(form) {
            const sharedQuantity = document.getElementById('sharedQuantity').value;
            const quantityField = form.querySelector('input[name="quantity"]');
            quantityField.value = sharedQuantity;
        }

        function optionsPrice(price, id) {
            // Update displayed price
            document.getElementById('updateOfferPrice').innerText = price;
            
            // Update price and option ID for both forms
            document.getElementById('cartPriceId').value = price;
            document.getElementById('buyPriceId').value = price;
            
            document.getElementById('cart_option_id').value = id;
            document.getElementById('buy_option_id').value = id;
        }
    </script>

@endsection
