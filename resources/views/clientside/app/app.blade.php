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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="{{ asset('clientside/dist/assets/index.css') }}">

</head>

<body>
    <!-- ---------------Footer-section---------------------------  -->
    
    <header>
        <div class="header-top  px-10 py-2  flex  justify-between bg-blue">
            <div>
                <a href="#" class="text-white text-xs  laptop:text-sm">Donation for Palestine</a>
                <a href="#" class="text-white pl-3 text-xs laptop:text-sm">Track Order</a>
            </div>
            <!-- <p class="text-sm text-white hidden laptop:block">Free Shipping Over 1499 Taka Order!</p> -->
            <div>
                <a href="#" class="ml-2 text-white text-base"><i class="fab fa-facebook"></i></a>
                <a href="#" class="ml-2 text-white text-base"><i class="fab fa-instagram"></i></a>
                <a href="#" class="ml-2 text-white text-base"><i class="fab fa-youtube"></i></a>
            </div>
        </div>

        <div class="flex justify-between px-2 laptop:px-10 py-2 bg-[#FAF4F6] items-center">
            <a href="#"> <img class="w-32 laptop:w-40 h-auto" src="{{ asset('clientside/images/logo.png') }}"
                    alt=""></a>

            <nav class="hidden laptop:block">
                <ul class="flex gap-4">
                    <li class="dropdown"><a href="shop.html" class="text-base text-red hover:text-blue ">T-Shirt
                            Collection <i class="fa-solid fa-angle-down"></i></i></a>
                        <ul>
                            <li><a href="shop.html" class="text-base text-red hover:text-blue">Dawah T-Shirt</a></li>
                        </ul>
                    </li>
                    <li><a href="shop.html" class="text-base text-red hover:text-blue ">Gift Item</a></li>
                    <li><a href="shop.html" class="text-base text-red hover:text-blue ">Mens Fashion</a></li>
                    <li><a href="shop.html" class="text-base text-red hover:text-blue ">Womens Fashion</a></li>
                    <li><a href="shop.html" class="text-base text-red hover:text-blue">Customize Chocolate</a></li>
                    <li><a href="shop.html" class="text-base text-red hover:text-blue ">Fashion Accessories</a></li>
                </ul>
            </nav>

            <div class="user"><a href="{{ route('login') }}"><img class="w-8 h-8"
                        src="{{ asset('clientside/images/profile.png') }}" alt=""></a></div>

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
                <a href="#"><img class="w-1/4 tablet:w-36 laptop:w-1/2  h-auto mb-2 tablet:mb-5 laptop:mb-6"
                        src="{{ asset('clientside/images/logo.png') }}" alt=""></a>
                <p class="text-white text-sm laptop:text-sm">Unbox The Unexpected</p>
            </div>

            <div>
                <h1 class="text-white mb-2 text-[18px]">Quick LInks</h1>
                <div class="divider w-16 h-1 bg-[#7C0E19] mb-6"></div>
                <div>
                    <a href="blog.html" class="text-white text-xs laptop:text-sm block mb-4 hover:text-red">Blog</a>
                    <a href="shop.html" class="text-white text-xs laptop:text-sm block mb-4 hover:text-red">Shop</a>
                    <a href="my-account.html" class="text-white text-xs laptop:text-sm block mb-4 hover:text-red">My
                        account</a>
                    <a href="terms-and-conditions.html"
                        class="text-white text-xs laptop:text-sm block mb-4 hover:text-red">Terms and Conditions</a>
                    <a href="privacy-policy.html"
                        class="text-white text-xs laptop:text-sm block mb-4 hover:text-red">Privacy Policy</a>
                    <a href="refund_returns.html"
                        class="text-white text-xs laptop:text-sm block mb-4 hover:text-red">Refund and Return
                        Policy</a>
                    <a href="donation-of-thikana-shop.html"
                        class="text-white text-xs laptop:text-sm block mb-4 hover:text-red">Donation for Palestine</a>
                </div>
            </div>

            <div>
                <h1 class="text-white mb-2 text-[18px]">Categories</h1>
                <div class="divider w-16 h-1 bg-[#7C0E19] mb-6"></div>
                <div>
                    <a href="#" class="text-white text-xs laptop:text-sm block mb-4 hover:text-red">T-Shirt
                        Collection </a>
                    <a href="#" class="text-white text-xs laptop:text-sm block mb-4 hover:text-red">Dawah
                        T-Shirt</a>
                    <a href="#" class="text-white text-xs laptop:text-sm block mb-4 hover:text-red">Gift
                        Item</a>
                    <a href="#" class="text-white text-xs laptop:text-sm block mb-4 hover:text-red">Mens
                        Fashion</a>
                    <a href="#" class="text-white text-xs laptop:text-sm block mb-4 hover:text-red">Womens
                        Fashion</a>
                    <a href="#" class="text-white text-xs laptop:text-sm block mb-4 hover:text-red">Customize
                        Chocolate</a>
                    <a href="#" class="text-white text-xs laptop:text-sm block mb-4 hover:text-red">Fashion
                        Accessories</a>
                </div>
            </div>
            <div>
                <h1 class="text-white mb-2 text-[18px]">Contact Us</h1>
                <div class="divider w-16 h-1 bg-[#7C0E19] mb-6"></div>

                <div>
                    <a href="#"><i
                            class="fa-brands fa-facebook text-red h-8 w-8 leading-[30px] text-center  border-red border-2 rounded-full hover:scale-105 ease-linear mr-2"></i>
                    </a>
                    <a href="#"><i
                            class="fa-brands fa-youtube   text-red h-8 w-8 leading-[30px] text-center  border-red border-2 rounded-full hover:scale-105 ease-linear"></i></a>
                    <div class="mt-5">
                        <p class="text-white text-xs laptop:text-sm"> <i
                                class="fa-solid fa-location-dot text-red mr-1"></i> Kolahat, Badalgachi, Naogaon</p>
                        <p class="text-white text-xs laptop:text-sm my-4"> <i
                                class="fa-solid fa-envelope-open-text text-red mr-1"></i> <a
                                href="mailto:thikanagiftshop@gmail.com">thikanagiftshop@gmail.com</a></p>
                        <p class="text-white text-xs laptop:text-sm"> <i
                                class="fa-solid fa-phone-volume text-red mr-1"></i> <a
                                href="tel:+8801327-282454">+8801327-282454</a></p>
                    </div>

                </div>

            </div>

        </div>

        <div class="divider border-[1px] border-rose-950 container mx-auto my-10"></div>
        <p class="text-center text-white text-xs tablet:text-sm  laptop:text-sm  mt-4 laptop:mt-10 leading-6 ">
            Copyright © 2024 Thikana.shop .All rights reserved. Website Designed & Developed by <a class="text-red"
                href="#">SOFTEB.COM</a></p>

    </div>


    <!-- swiper js  -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <!-- cstm js  -->
    <script src="{{ asset('clientside/js/script.js') }}"></script>


</body>

</html>
