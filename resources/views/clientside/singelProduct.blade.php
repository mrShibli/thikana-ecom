@extends('clientside.app.app')

@section('client-content')
  
    <!-- -----------product-single-page--------- -->

    <div class=" container mx-auto my-5 flex flex-wrap gap-4 p-3 ">
        <div class="w-full laptop:w-[430px] border rounded p-2">
            <div class="laptop:hidden tablet:hidden desktop:hidden">
                <a class="text-xs text-red hover:text-blue" href="index.html">Home <i class="fas fa-angle-right text-xs text-gray-400"></i></a>
                <a class="text-xs text-red hover:text-blue" href="">Products <i class="fas fa-angle-right text-xs text-gray-400"></i></a> 
                <h2 class="p-title my-2 text-base tablet:table laptop:text-[17px] leading-6">Ramadan Special Premium Dawah T-Shirt । নিশ্চই কষ্টের সাথেই স্বস্তি রয়েছে</h2>
            </div> 
            <div class="flex gap-1">
                
                 <img class="w-60 laptop:w-80 object-contain" src="images/product-single.jpg" alt="">
            <div class="image-gallery px-1">
                <img class="w-14 h-16 laptop:w-24 laptop:h-28 object-cover mb-1 border border-red " src="images/single-img_ (1).jpg" alt="">
                <img class="w-14 h-16 laptop:w-24 laptop:h-28 object-cover mb-1 border border-red" src="images/single-img_ (2).jpg" alt="">
                <img class="w-14 h-16 laptop:w-24 laptop:h-28 object-cover mb-1 border border-red" src="images/single-img_ (3).jpg" alt="">
                <img class="w-14 h-16 laptop:w-24 laptop:h-28 object-cover mb-1 border border-red" src="images/single-img_ (4).jpg" alt="">
            </div>
            </div> 


        </div>
        <div class=" w-full laptop:w-[460px] border rounded p-3">
            <div class="hidden laptop:block">
                <a class="text-xs text-red hover:text-blue" href="index.html">Home <i class="fas fa-angle-right text-xs text-gray-400"></i></a>
                <a class="text-xs text-red hover:text-blue" href="">Products <i class="fas fa-angle-right text-xs text-gray-400"></i></a> 
                <h2 class="p-title my-2 text-sm tablet:table laptop:text-[17px] leading-6">Ramadan Special Premium Dawah T-Shirt । নিশ্চই কষ্টের সাথেই স্বস্তি রয়েছে</h2>
            </div> 

           

            <div class="mt-4">
                <p class="px-2 py-1 bg-[#F38A0E] rounded text-xs text-white font-bold inline-block" >Sale!</p>
                <h1 class="text-base tablet:text-xl laptop:text-2xl font-bold"> <span class="text-red line-through">350৳</span>  299৳ </h1>
            </div>

            <div class="color-btn mt-5">
                <h4 class="font-semibold mb-2">Color</h4>
                <div class="flex gap-2">
                    <div class="black p-[2px] border border-gray-500 rounded hover:border-2 hover:border-gray-600 transition-all">
                        <button class="p-4 transition-all  bg-black"></button>
                    </div> 
                    <div class="dark-olive p-[2px] border border-gray-500 rounded hover:border-2 hover:border-gray-600 transition-all">
                        <button class="p-4 transition-all  bg-[#454636]"></button>
                    </div>
                    
                    <div class="light-purple p-[2px] border border-gray-500 rounded hover:border-2 hover:border-gray-600 transition-all">
                        <button class="p-4 transition-all  bg-[#9F92A6]"></button>
                    </div>
                    
                    <div class="white p-[2px] border border-gray-500 rounded hover:border-2 hover:border-gray-600 transition-all">
                        <button class="p-4 transition-all bg-white"></button>
                    </div> 
                </div>
            </div>

            <div class="p-size mt-5">
                <h4 class="font-semibold mb-2">Size</h4>
                <div class="flex gap-2">
                    <div class="black p-[2px] border border-gray-500 rounded hover:border-2 hover:border-gray-600 transition-all">
                        <button class="py-1 px-2 transition-all text-sm ">L</button>
                    </div> 
                    <div class="dark-olive p-[2px] border border-gray-500 rounded hover:border-2 hover:border-gray-600 transition-all">
                        <button class="py-1 px-2 transition-all text-sm ">M</button>
                    </div>
                    
                    <div class="light-purple p-[2px] border border-gray-500 rounded hover:border-2 hover:border-gray-600 transition-all">
                        <button class="py-1 px-2 transition-all text-sm ">XL</button>
                    </div>
                    
                    <div class="white p-[2px] border border-gray-500 rounded hover:border-2 hover:border-gray-600 transition-all">
                        <button class="py-1 px-2 transition-all text-sm">XXL</button>
                    </div> 
                </div>
            </div>

            <div class="flex items-center gap-2 my-5">
                <input type="number"  id="quantity" name="quantity" min="1" value="1" minlength="1"  class="py-2 pl-4 laptop:py-2 laptop:px-10 border text-white rounded  bg-gray-100 w-12">
                <a href="cart.html" class=" py-2 px-8 laptop:py-3 laptop:px-10 bg-blue rounded text-white text-sm  font-bold">Add To Cart</a>
                <a href="#" class=" py-2 px-8 laptop:py-3 laptop:px-10 bg-red rounded text-white text-sm tablet:text-base laptop:text-base font-bold">Buy Now</a>
            </div>   

        </div>


        <div class="w-full laptop:w-[330px] ">

            <div class="p-4 border border-dashed border-blue">
                <p class="mb-3 text-xs laptop:text-sm"><i class="fa-solid fa-square-check text-sm text-blue mr-2"></i>Delivery Charge: সারা বাংলাদেশে একই থাকবে</p>
                <p class="mb-3 text-xs laptop:text-sm"><i class="fa-solid fa-square-check text-sm text-blue mr-2"></i>Delivery Charge: টি শার্ট ৭০ /-</p>
                <p class="mb-3 text-xs laptop:text-sm"><i class="fa-solid fa-square-check text-sm text-blue mr-2"></i>Delivery Charge: শাড়ি পাঞ্জাবিতে ১০০ /-</p>
                <p class="mb-3 text-xs laptop:text-sm"><i class="fa-solid fa-square-check text-sm text-blue mr-2"></i>Delivery Charge: ২৪৯৯+ শপিং এ  ফ্রি</p>
                <p class="mb-3 text-xs laptop:text-sm"><i class="fa-solid fa-square-check text-sm text-blue mr-2"></i>Product হাতে পেয়ে মূল্য পরিশোধ।</p>
                <p class="mb-3 text-xs laptop:text-sm"><i class="fa-solid fa-square-check text-sm text-blue mr-2"></i>Product পছন্দ না হলে সাথে সাথেই Return এর সুযোগ।</p>
                <p class="mb-3 text-xs laptop:text-sm"><i class="fa-solid fa-square-check text-sm text-blue mr-2"></i>Order Confirmation এর ০২-০৪ দিনের ভিতর ডেলিভারী।</p>
                <p class="mb-3 text-xs laptop:text-sm"><i class="fa-solid fa-square-check text-sm text-blue mr-2"></i>Video Review দেখে Product এর Quality সম্পর্কে নিশ্চিত হওয়া।</p> 
            </div>

            <div>  
                <iframe class="mt-5 rounded" src="https://www.youtube.com/embed/MvOTNP_xQ7A?si=4eR_nfb_qj42-bns" height="160" width="290"></iframe>  
                
            </div>



        </div>

    </div>


    <!-- -----------------deskcription------------------------ -->

    

    <div class="deskcription-box container mx-auto py-10 p-3">
        <div class="flex justify-center items-center gap-2 border-b-2 border-gray-400 pb-1">
            <h1 class="description py-3 px-8 rounded bg-[#6B7280] font-medium text-white text-base cursor-pointer hover:bg-gray-600">Description</h1>
            <h1 class="Additional-information py-3 px-8 rounded bg-[#6B7280] font-medium text-white text-base cursor-pointer hover:bg-gray-600">Additional information</h1>
        </div>

        <div class="d-bx">
            <h1 class="text-2xl laptop:text-3xl text-black my-4">Description</h1>
            <p class="text-black text-sm laptop:text-base mb-2">“নিশ্চই কষ্টের সাথেই, স্বস্তি রয়েছে” আয়াত টি  সূরা “আল-ইনশিরাহ” তে করা মহান আল্লাহ তা’য়ালার এক অবিস্মরনীয় ওয়াদা এবং সমগ্র কোরআন মাজীদের সুন্দরতম আয়াত সমুহের ভিতর অন্যতম।</p>
            <p class="mb-3 text-sm laptop:text-base">Dawah Message : নিশ্চই কষ্টের সাথেই স্বস্তি রয়েছে </p> 
            <p class="mb-3 text-sm laptop:text-base"> Fabrics:  Single Jersey</p> 
            <p class="mb-3 text-sm laptop:text-base"> Fabrics Type: 100% Cotton Fabric</p> 
            <p class="mb-3 text-sm laptop:text-base"> GSM: 170-180 Gsm</p> 
            <p class="mb-3 text-sm laptop:text-base">Size: 4 Size Available (M, L, XL, XXL) </p>
            <p class="mb-3 text-sm laptop:text-base">Color: 4 Colors available (Black, Olive Black, White, and Light Purple)</p> 
            <p class="mb-3 text-sm laptop:text-base">Used one-by-one rib at the neck with full body top sewing. </p>
            <p class="mb-3 text-sm laptop:text-base">100% Export Quality</p>
           
        </div>

        <div class="a-information">
            <h1 class="text-2xl laptop:text-3xl text-black my-4">Additional information</h1> 

            <div id="additional_information" >
                <div class="gap-4 mb-5">
               <p id="weight" class="text-sm font-bold px-5 border-r border-r-slate-300 ">Weight </p>
               <p class="text-sm text-gray-500">0.150 g</p>
                </div>

                <div class=" gap-4 mb-5">
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
                
                
            </div>
           
        </div>

    </div>


    <div class="container mx-auto p-3 laptop:py-8">
        <h2 class="my-7 text-blue text-base laptop:text-xl font-semibold ">Related Products</h2>

        <div class="grid grid-cols-2 gap-4 tablet:grid-cols-3 laptop:grid-cols-5"> 
        
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

     
    
        </div>
        
    </div>


@endsection