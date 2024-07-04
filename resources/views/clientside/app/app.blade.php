<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thikana</title>
    <link rel="shortcut icon" href="{{ asset('clientside/images/logo.png') }}" type="image/x-icon">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
          rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <!-- Swiper's CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    @vite("resources/css/app.css")
    <link rel="stylesheet" href="{{ asset('clientside/dist/assets/index.css') }}">
    <!--Plugin CSS file with desired skin-->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/css/ion.rangeSlider.min.css"/>
    <style>
        a.active p {
            color: rgb(46 49 146 / var(--tw-text-opacity)) !important;
        }
    </style>
</head>

<body>
<!-- ---------------Footer-section---------------------------  -->

<header>
    @php
        $socials = \App\Models\Social::where ("status",1)->get ();
        if ($socials){
            $socials = [];
        }
        $setting = \App\Models\Setting::first ();
        if (!$setting){
            $setting =[
             "title"   => "",
                    "email"   => "",
                    "slogan"  => "",
                    "phone"   => "",
                    "address" => "",
                    "logo"    => ""
];
        }
    @endphp
    <div class="header-top  px-10 py-2  flex  justify-between bg-blue">
        <div>
            <a href="#" class="text-white text-xs  laptop:text-sm">Donation for Palestine</a>
            <a href="#" class="text-white pl-3 text-xs laptop:text-sm">Track Order</a>
        </div>
        <!-- <p class="text-sm text-white hidden laptop:block">Free Shipping Over 1499 Taka Order!</p> -->
        <div>
            @foreach($socials as $social)
                <a href="{{$social->url}}" target="_blank" class="ml-2 text-white text-base"><i
                            class="{{$social->class}}"></i></a>
            @endforeach
        </div>
    </div>

    <div class="flex justify-between px-2 laptop:px-10 py-2 bg-[#FAF4F6] items-center">
        <a href="{{route ("index")}}"> <img class="w-32 laptop:w-40 h-auto"
                                            src="{{ asset($setting->logo) }}"
                                            alt=""></a>
        @php
            $categories = \App\Models\ProductCategory::with("subCategory")->select(["name","slug"])->where("status","active")->where ('show_menu',true)->get ();
        @endphp
        <nav class="hidden laptop:block">
            <ul class="flex gap-4">
                @foreach($categories as $category)
                    <li class="@if($category->sub_category)dropdown @endif">
                        <a href="{{route ("shop",$category->slug)}}" class="text-base text-red hover:text-blue ">
                            {{$category->name}} @if($category->sub_category)
                                <i class="fa-solid fa-angle-down"></i>
                            @endif
                        </a>
                        @if($category->sub_category)
                            <ul>
                                @foreach($category->sub_category as $sub_cat)
                                    <li>
                                        <a href="shop.html"
                                           class="text-base text-red hover:text-blue">{{$sub_cat->name}}</a>
                                    </li>
                                @endforeach

                            </ul>
                        @endif
                    </li>
                @endforeach
            </ul>
        </nav>

        <div class="user"><a href="{{ route('login') }}"><img class="w-8 h-8"
                                                              src="{{ asset('clientside/images/profile.png') }}" alt=""></a>
        </div>

        <div class="cart flex gap-2">
            <a href="{{ route('cart.index') }}">
                <img class="w-8 h-8" src="{{ asset('clientside/images/cart.png') }}" alt="">
                <p class="text-red">0ট</p>
            </a>
        </div>

    </div>
</header>

@yield('client-content')

<!-- ---------------Footer-section---------------------------  -->

<div class="footer bg-[#00000F] p-3 laptop:py-10">
    <div class="container mx-auto grid gap-4 grid-cols-1 tablet:grid-cols-4">
        <div>
            <a href="{{route ("index")}}"><img class="w-1/4 tablet:w-36 laptop:w-1/2  h-auto mb-2 tablet:mb-5 laptop:mb-6"
                             src="{{ asset($setting->logo) }}" alt=""></a>
            <p class="text-white text-sm laptop:text-sm">{{$setting->slogan}}</p>
        </div>

        <div>
            @php
                $pages = \App\Models\Page::where ("status",1)->get ();
            @endphp
            <h1 class="text-white mb-2 text-[18px]">Quick LInks</h1>
            <div class="divider w-16 h-1 bg-[#7C0E19] mb-6"></div>
            <div>
                @foreach($pages as $page)
                    <a href="{{route ("page",$page->slug)}}"
                       class="text-white text-xs laptop:text-sm block mb-4 hover:text-red">{{$page->title}}</a>
                @endforeach

            </div>
        </div>

        <div>
            <h1 class="text-white mb-2 text-[18px]">Categories</h1>
            <div class="divider w-16 h-1 bg-[#7C0E19] mb-6"></div>
            <div>
                @foreach($categories as $category)
                    <a href="{{route ("shop",$category->slug)}}"
                       class="text-white text-xs laptop:text-sm block mb-4 hover:text-red">
                        {{$category->name}}
                    </a>
                @endforeach
            </div>
        </div>
        <div>
            <h1 class="text-white mb-2 text-[18px]">Contact Us</h1>
            <div class="divider w-16 h-1 bg-[#7C0E19] mb-6"></div>

            <div>
                @foreach($socials as $social)
                    <a href="{{$social->url}}" target="_blank">
                        <i class="{{$social->class}} text-red h-8 w-8 leading-[30px] text-center  border-red border-2 rounded-full hover:scale-105 ease-linear mr-2"></i>
                    </a>
                @endforeach
                <div class="mt-5">
                    <p class="text-white text-xs laptop:text-sm"><i
                                class="fa-solid fa-location-dot text-red mr-1"></i> {{$setting->address}}</p>
                    <p class="text-white text-xs laptop:text-sm my-4"><i
                                class="fa-solid fa-envelope-open-text text-red mr-1"></i> <a
                                href="mailto:{{$setting->email}}">{{$setting->email}}</a></p>
                    <p class="text-white text-xs laptop:text-sm"><i
                                class="fa-solid fa-phone-volume text-red mr-1"></i> <a
                                href="tel:{{$setting->phone}}">{{$setting->phone}}</a></p>
                </div>

            </div>

        </div>

    </div>

    <div class="divider border-[1px] border-rose-950 container mx-auto my-10"></div>
    <p class="text-center text-white text-xs tablet:text-sm  laptop:text-sm  mt-4 laptop:mt-10 leading-6 ">
        Copyright © 2024 Thikana.shop .All rights reserved. Website Designed & Developed by <a class="text-red"
                                                                                               href="#">SOFTEB.COM</a>
    </p>

</div>
<!-- swiper js  -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<!--jQuery-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!-- cstm js  -->
<script src="{{ asset('clientside/js/script.js') }}"></script>
<!--Plugin JavaScript file-->
@yield("script")
</body>

</html>
