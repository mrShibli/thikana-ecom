
@extends('clientside.app.app')
<!-- -------------------hero-section------------------- -->
@section('client-content')

    <div class="swiper hero-slider container mx-auto p-3 py-3">
        <div class="swiper-wrapper">
            @foreach($banners as $banner)
                <div class="swiper-slide">
                    <img src="{{ asset($banner->image) }}" alt="">
                </div>
            @endforeach

        </div>
        {{-- <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div> --}}
        <div class="swiper-pagination"></div>
    </div>

    <!-- ---------product-category-section-------------- -->

    <div class="category container mx-auto py-5 p-3 ">

        <input type="search" name="search" placeholder="Search Category" id=""
               class="p-1 pl-2 border rounded my-5 placeholder:text-xs focus:border-red outline-none">

        <div class="grid grid-cols-4 tablet:grid-cols-4 laptop:grid-cols-8 desktop:grid-cols-9 ">

            @foreach($categories as $category)
                <div>
                    <a href="{{route ("shop",$category->slug)}}">
                        <img class="w-14 h-14" src="{{ asset($category->image) }}"
                             alt="">
                    </a>
                    <a href="{{route ("shop",$category->slug)}}">
                        <h6 class="text-xs mt-2">{{$category->name}}</h6>
                    </a>
                </div>
            @endforeach
        </div>
    </div>



    <!-- ------------------Featured_Products-section-------------------  -->

    <div class="container mx-auto p-3 laptop:py-8 ">
        <h2 class="mb-4 laptop:mb-12 text-blue text-xl font-semibold text-center ">Featured Products</h2>
        <div class="swiper featured-slider pb-14 ">
            <div class="swiper-wrapper">
                @foreach ($features_products as $features_product)
                    @php
                        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $features_product->title)));
                    @endphp
                    <div class="swiper-slide text-center border rounded p-2 w-64 h-96">
                        <a href="{{ route('product.single', ['slug' => $slug, 'id' => $features_product->id]) }}">
                            <img class="bg-slate-100 p-2 w-full h-48 object-cover"
                                 src="{{ asset('storage/' . $features_product->thumb_image) }}" alt="">
                        </a>
                        <h5 class="title text-sm laptop:text-base font-hindSiliguri">{{$features_product->title }}</h5>
                        <p class="my-3">
                            @if($features_product->offer)
                                <span class="regular line-through text-red mr-2">{{ $features_product->old_price }}৳</span>
                                <span class="special">{{ $features_product->offer }}৳</span>
                            @else
                                <span class="special">{{$features_product->old_price }}৳</span>
                            @endif
                        </p>
                        <a href="{{ route('product.single', ['slug' => $slug, 'id' => $features_product->id]) }}"
                           class="py-2 block bg-blue text-white text-center rounded-xl text-xs laptop:text-base">View
                            Product</a>
                    </div>

                @endforeach


            </div>

            {{-- <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div> --}}
            <div class="swiper-pagination"></div>

        </div>


    </div>

    <div class="divider border  block  container mx-auto my-7 "></div>

    <!-- --------------New_Arrival-section------------------  -->

    <div class="container mx-auto p-3 laptop:py-5">
        <h2 class="mb-4 laptop:mb-12 text-center mt-7 text-blue text-xl font-semibold">New Arrival</h2>
        <div class="divider border  block container my-8"></div>

        <div class="swiper newArrival-slider pb-14 ">
            <div class="swiper-wrapper">
                @foreach ($products as $product)
                    @php
                        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $product->title)));
                    @endphp
                    <div class="swiper-slide text-center border rounded p-2 w-64 h-96">
                        <a href="{{ route('product.single', ['slug' => $slug, 'id' => $product->id]) }}">
                            <img class="bg-slate-100 p-2 w-full h-48 object-cover"
                                 src="{{ asset('storage/'.$product->thumb_image) }}" alt="">
                        </a>
                        <h5 class="title text-sm laptop:text-base font-hindSiliguri">{{$product->title }}</h5>
                        <p class="my-3">
                            @if($product->offer)
                                <span class="regular line-through text-red mr-2">{{ $product->old_price }}৳</span>
                                <span class="special">{{ $product->offer }}৳</span>
                            @else
                                <span class="special">{{$product->old_price }}৳</span>
                            @endif
                        </p>
                        <a href="{{ route('product.single', ['slug' => $slug, 'id' => $product->id]) }}"
                           class="py-2 block bg-blue text-white text-center rounded-xl text-xs laptop:text-base">View
                            Product</a>
                    </div>
                @endforeach

            </div>

            {{-- <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div> --}}
            <div class="swiper-pagination"></div>

        </div>

    </div>

    <!-- -------------------------c-review------------------- -->

    <div class="container mx-auto p-3 tablet:py-6 laptop:py-8 ">

        <h2 class="mb-14 text-center text-blue text-base laptop:text-xl  font-semibold">Happy Customer</h2>

        <div class="grid gap-4 grid-cols-2 tablet:grid-cols-3 laptop:grid-cols-4 client-review swiper pb-14">
            <div class="swiper-wrapper">

                <div class="swiper-slide">
                    <img class="w-full h-44 tablet:h-72 laptop:h-96 object-cover rounded"
                         src="{{ asset('clientside/images/hpy-cstmr (1).jpg') }}" alt="">
                </div>
                <div class="swiper-slide">
                    <img class="w-full h-44 tablet:h-72 laptop:h-96 object-cover rounded"
                         src="{{ asset('clientside/images/hpy-cstmr (2).jpg') }}" alt="">
                </div>
                <div class="swiper-slide">
                    <img class="w-full h-44 tablet:h-72 laptop:h-96 object-cover rounded"
                         src="{{ asset('clientside/images/hpy-cstmr (1).png') }}" alt="">
                </div>
                <div class="swiper-slide">
                    <img class="w-full h-44 tablet:h-72 laptop:h-96 object-cover rounded"
                         src="{{ asset('clientside/images/hpy-cstmr (2).png') }}" alt="">
                </div>
                <div class="swiper-slide">
                    <img class="w-full h-44 tablet:h-72 laptop:h-96 object-cover rounded"
                         src="{{ asset('clientside/images/hpy-cstmr (1).png') }}" alt="">
                </div>

            </div>

            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-pagination"></div>


        </div>

    </div>




    <!-- --------------T-Shirt_Collection-section--------------------  -->


    <div class="container mx-auto p-3 laptop:py-5">
        <h2 class="mb-4 laptop:mb-12 text-center mt-7 text-blue text-xl font-semibold">Featured Collection</h2>
        <div class="divider border  block  container my-8 "></div>

        <div class="grid grid-cols-2 gap-2 tablet:grid-cols-3 laptop:grid-cols-4">
            @foreach ($features_products as $features_product)
                @php
                    $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $features_product->title)));
                @endphp
                <div class="swiper-slide text-center border rounded p-1 w-50">
                    <a href="{{ route('product.single', ['slug' => $slug, 'id' => $features_product->id]) }}">
                        <img class="bg-slate-100 p-2 w-full h-48 object-cover"
                             src="{{ asset('storage/'. $features_product->thumb_image) }}" alt="">
                    </a>
                    <h5 class="title text-sm laptop:text-base font-hindSiliguri">{{$features_product->title }}</h5>
                    <p class="my-3">
                        @if($features_product->offer)
                            <span class="regular line-through text-red mr-2">{{ $features_product->old_price }}৳</span>
                            <span class="special">{{ $features_product->offer }}৳</span>
                        @else
                            <span class="special">{{$features_product->old_price }}৳</span>
                        @endif
                    </p>
                    <a href="{{ route('product.single', ['slug' => $slug, 'id' => $features_product->id]) }}"
                       class="py-2 block bg-blue text-white text-center rounded-xl text-xs laptop:text-base">View
                        Product</a>
                </div>
            @endforeach
        </div>

    </div>



    <!-- ------------Our_Activities(blog)-section-------------------  -->


    <div class="container mx-auto p-3 laptop:py-5 blog">
        <h2 class="mb-10 mt-7 text-blue text-2xl font-medium text-center">Our Activities</h2>

        <div class="grid grid-cols-2 gap-4 tablet:grid-cols-3 laptop:grid-cols-4 ">
            @foreach($activities as $activity)
                <div>
                    <a href="#"> <img src="{{ asset($activity->thumb_images) }}" alt=""></a>
                    <a href="#">
                        <p class="title text-red my-2 text-x">{{$activity->title}}</p>
                    </a>
                    <a href="#">
                        <h5 class="my-3 text-sm laptop:text-base">{{$activity->note}}</h5>
                    </a>
                    <a href="#"
                       class="py-2 block bg-blue text-white text-center rounded-xl text-xs laptop:text-base">Read
                        More</a>
                </div>
            @endforeach



        </div>

    </div>




    <!-- --------------------------------  -->


    <div class="container mx-auto p-3 laptop:py-10 grid gap-4 grid-cols-2  laptop:grid-cols-4">

        <div class="flex items-center gap-4 ">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor"
                class="w-8  h-8
            laptop:w-10 laptop:h-10 text-blue border-2  border-blue rounded-full p-1 ">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M6.633 10.25c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 0 1 2.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 0 0 .322-1.672V2.75a.75.75 0 0 1 .75-.75 2.25 2.25 0 0 1 2.25 2.25c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282m0 0h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 0 1-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 0 0-1.423-.23H5.904m10.598-9.75H14.25M5.904 18.5c.083.205.173.405.27.602.197.4-.078.898-.523.898h-.908c-.889 0-1.713-.518-1.972-1.368a12 12 0 0 1-.521-3.507c0-1.553.295-3.036.831-4.398C3.387 9.953 4.167 9.5 5 9.5h1.053c.472 0 .745.556.5.96a8.958 8.958 0 0 0-1.302 4.665c0 1.194.232 2.333.654 3.375Z" />
            </svg>
            <div>
                <h4 class="text-sm laptop:text-base text-blue font-medium">High-quality Goods</h4>
                <p class="text-xs laptop:text-sm">Enjoy top quality items for less</p>
            </div>
        </div>
        <div class="flex items-center gap-4">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor"
                class="w-8  h-8
            laptop:w-10 laptop:h-10 text-blue border-2  border-blue rounded-full p-1 ">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 0 0 .75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 0 0-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0 1 12 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 0 1-.673-.38m0 0A2.18 2.18 0 0 1 3 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 0 1 3.413-.387m7.5 0V5.25A2.25 2.25 0 0 0 13.5 3h-3a2.25 2.25 0 0 0-2.25 2.25v.894m7.5 0a48.667 48.667 0 0 0-7.5 0M12 12.75h.008v.008H12v-.008Z" />
            </svg>
            <div>

                <h4 class="text-sm laptop:text-base text-blue font-medium">24/7 Live chat</h4>
                <p class="text-xs laptop:text-sm">Instant assistance whenever you need</p>
            </div>
        </div>

        <div class="flex items-center gap-4">

            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor"
                class="w-8  h-8
            laptop:w-10 laptop:h-10 text-blue border-2  border-blue rounded-full p-1 ">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
            </svg>
            <div>
                <h4 class="text-sm laptop:text-base text-blue font-medium">Express Shipping</h4>
                <p class="text-xs laptop:text-sm">Fast & reliable delivery options</p>
            </div>
        </div>
        <div class="flex items-center gap-4  ">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor"
                class="w-8  h-8
            laptop:w-10 laptop:h-10 text-blue border-2  border-blue rounded-full p-1 ">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
            </svg>

            <div>
                <h4 class="text-sm laptop:text-base text-blue font-medium"> Secure Payment</h4>
                <p class="text-xs laptop:text-sm">Multiple safe payment methods</p>
            </div>
        </div>


    </div>


    @endsection
