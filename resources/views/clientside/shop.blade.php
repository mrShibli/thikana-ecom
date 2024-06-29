@extends("clientside.app.app")
@section("client-content")
    <h1 id="heading" class=" text-2xl laptop:text-4xl text-black text-center p-2 laptop:p-4 bg-gray-200">Shop</h1>

    <div class="container mx-auto p-3 py-8 flex flex-wrap gap-4 justify-center">

        <div class="w-full laptop:w-1/4">
            <h2 class=" mb-4 text-base text-blue font-semibold">Filter by price</h2>
            <a href="#" class="py-2 block text-center text-sm rounded bg-blue text-white hover:bg-gray-300 hover:text-black">Filter</a>

            <div id="price" class="py-3 border-b">
                <p>Price: 290৳  — 300৳ </p>
            </div>

            <div id="color" class="py-3 border-b">
                <h2 class=" mb-4 text-base text-blue font-semibold">Filter by Color</h2>

                <a href=""><p class="text-red hover:text-blue text-sm mb-1">Black <span class="text-black">(1)</span></p></a>
                <a href=""><p class="text-red hover:text-blue text-sm mb-1">Dark Olive <span class="text-black">(1)</span></p></a>
                <a href=""><p class="text-red hover:text-blue text-sm mb-1">Light Purple <span class="text-black">(1)</span></p></a>
                <a href=""><p class="text-red hover:text-blue text-sm mb-1">White <span class="text-black">(1)</span></p></a>

            </div>

            <div id="color" class="py-3">
                <h2 class=" mb-4 text-base text-blue font-semibold">Filter by Size</h2>

                <a href=""><p class="text-red hover:text-blue text-sm mb-1">L <span class="text-black">(1)</span></p></a>
                <a href=""><p class="text-red hover:text-blue text-sm mb-1">M <span class="text-black">(1)</span></p></a>
                <a href=""><p class="text-red hover:text-blue text-sm mb-1">XL <span class="text-black">(1)</span></p></a>
                <a href=""><p class="text-red hover:text-blue text-sm mb-1">XXL <span class="text-black">(1)</span></p></a>

            </div>

            <div id="color" class="py-3">
                <h2 class=" mb-4 text-base text-blue font-semibold">Filter by Category</h2>

                <a href=""><p class="text-red hover:text-blue text-sm mb-1">Mens Fashion </p></a>
                <a href=""><p class="text-red hover:text-blue text-sm mb-1">T-Shirt Collection  </p></a>
                <a href=""><p class="text-red hover:text-blue text-sm mb-1">Dawah T-Shirt </p></a>


            </div>

        </div>

        <div class="w-full laptop:w-[70%]">

            <div class="grid grid-cols-2 gap-4 tablet:grid-cols-3 laptop:grid-cols-4">

                <div class="text-center border rounded p-2">
                    <a href="product_single.html"> <img class="bg-slate-100 p-2" src="images/Special-Dawah-T-Shirt-1-.jpg" alt=""></a>
                    <h5 class="title text-sm laptop:text-base font-hindSiliguri">Ramadan Special Premium Dawah T-Shirt । নিশ্চই কষ্টের সাথেই স্বস্তি রয়েছে</h5>
                    <p class="my-3"><span class="regular line-through text-red mr-2">350৳</span> <span class="special">299৳</span></p>
                    <a href="#" class="py-2 block bg-blue text-white text-center rounded-xl text-xs laptop:text-base">View Product</a>
                </div>

                <div class="text-center border rounded p-2">
                    <a href="product_single.html"> <img class="bg-slate-100 p-2" src="images/img (1).jpg" alt=""></a>
                    <h5 class="title text-sm laptop:text-base font-hindSiliguri">Ramadan Special Premium Dawah T-Shirt । নিশ্চই কষ্টের সাথেই স্বস্তি রয়েছে</h5>
                    <p class="my-3"><span class="regular line-through text-red mr-2">350৳</span> <span class="special">299৳</span></p>
                    <a href="#" class="py-2 block bg-blue text-white text-center rounded-xl text-xs laptop:text-base">View Product</a>
                </div>

                <div class="text-center border rounded p-2">
                    <a href="product_single.html"><img class="bg-slate-100 p-2" src="images/img (2).jpg" alt=""></a>
                    <h5 class="title text-sm laptop:text-base font-hindSiliguri">Ramadan Special Premium Dawah T-Shirt । নিশ্চই কষ্টের সাথেই স্বস্তি রয়েছে</h5>
                    <p class="my-3"><span class="regular line-through text-red mr-2">350৳</span> <span class="special">299৳</span></p>
                    <a href="#" class="py-2 block bg-blue text-white text-center rounded-xl text-xs laptop:text-base">View Product</a>
                </div>

                <div class="text-center border rounded p-2">
                    <a href="product_single.html"> <img class="bg-slate-100 p-2" src="images/img (3).jpg" alt=""></a>
                    <h5 class="title text-sm laptop:text-base font-hindSiliguri">Ramadan Special Premium Dawah T-Shirt । নিশ্চই কষ্টের সাথেই স্বস্তি রয়েছে</h5>
                    <p class="my-3"><span class="regular line-through text-red mr-2">350৳</span> <span class="special">299৳</span></p>
                    <a href="#" class="py-2 block bg-blue text-white text-center rounded-xl text-xs laptop:text-base">View Product</a>
                </div>

                <div class="text-center border rounded p-2">
                    <a href="product_single.html"><img class="bg-slate-100 p-2" src="images/img (1).jpg" alt=""></a>
                    <h5 class="title text-sm laptop:text-base font-hindSiliguri">Ramadan Special Premium Dawah T-Shirt । নিশ্চই কষ্টের সাথেই স্বস্তি রয়েছে</h5>
                    <p class="my-3"><span class="regular line-through text-red mr-2">350৳</span> <span class="special">299৳</span></p>
                    <a href="#" class="py-2 block bg-blue text-white text-center rounded-xl text-xs laptop:text-base">View Product</a>
                </div>

                <div class="text-center border rounded p-2">
                    <a href="product_single.html"> <img class="bg-slate-100 p-2" src="images/img (4).jpg" alt=""></a>
                    <h5 class="title text-sm laptop:text-base font-hindSiliguri">Ramadan Special Premium Dawah T-Shirt । নিশ্চই কষ্টের সাথেই স্বস্তি রয়েছে</h5>
                    <p class="my-3"><span class="regular line-through text-red mr-2">350৳</span> <span class="special">299৳</span></p>
                    <a href="#" class="py-2 block bg-blue text-white text-center rounded-xl text-xs laptop:text-base">View Product</a>
                </div>

            </div>

        </div>

    </div>
@endsection
