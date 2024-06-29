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
    @if($errors->any())
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
                <a class="text-xs text-red hover:text-blue" href="{{route ("index")}}">Home <i class="fas fa-angle-right text-xs text-gray-400"></i></a>
                <a class="text-xs text-red hover:text-blue" href="">Products <i class="fas fa-angle-right text-xs text-gray-400"></i></a> 
                <h2 class="p-title my-2 text-base tablet:table laptop:text-[17px] leading-6">Ramadan Special Premium Dawah T-Shirt । নিশ্চই কষ্টের সাথেই স্বস্তি রয়েছে</h2>
            </div> 
            <div class="flex gap-1">
                
                 <img class="w-60 laptop:w-80 object-contain" src="{{ asset('storage/'.$product->thumb_image) }}" alt="">
            <div class="image-gallery px-1">
                @php
                    $productIMage = json_decode($product->images);
                @endphp
                @foreach ($productIMage as $image)
                    <img class="w-14 h-16 laptop:w-24 laptop:h-28 object-cover mb-1 border border-red " src="{{ asset('storage/'.$image) }}" alt="">
                @endforeach
            </div>
            </div> 


        </div>
        <div class=" w-full laptop:w-[460px] border rounded p-3">
            <div class="hidden laptop:block">
                <a class="text-xs text-red hover:text-blue" href="{{route ("index")}}">Home <i class="fas fa-angle-right text-xs text-gray-400"></i></a>
                <a class="text-xs text-red hover:text-blue" href="">Products <i class="fas fa-angle-right text-xs text-gray-400"></i></a> 
                <h2 class="p-title my-2 text-sm tablet:table laptop:text-[17px] leading-6">{{ $product->title }}</h2>
            </div> 

           

            <div class="mt-4">
                @if($product->offer)
                <p class="px-2 py-1 bg-[#F38A0E] rounded text-xs text-white font-bold inline-block" >Sale!</p>
                <h1 class="text-base tablet:text-xl laptop:text-2xl font-bold"> <span class="text-red line-through">{{ $product->old_price }}৳</span> <span id="updateOfferPrice">{{ $product->offer }}</span> ৳ </h1>
                @else
                    <span id="updateOfferPrice">{{ $product->old_price }}</span> ৳
                @endif
            </div>

            {{-- <div class="color-btn mt-5">
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
            </div> --}}
            @php
                $optinId=null;
            @endphp
            @foreach ($product->variations as $variations)
                <div class="p-size mt-5">
                    <h4 class="font-semibold mb-2">{{ $variations->name }}</h4>
                    <div class="flex gap-2">
                        @foreach ($variations->options as $options)
                        @php
                            $optinId = $options->id
                        @endphp
                            <div class="black p-[2px] border border-gray-500 rounded hover:border-2 hover:border-gray-600 transition-all">
                                <button class="py-1 px-2 transition-all text-sm" onclick="optionsPrice({{ $options->price }},{{$options->id}})">{{ $options->name }}</button>
                            </div> 
                        @endforeach
                    </div>
                </div>
            @endforeach
            <form action="{{ route('cart.store') }}" method="get">
                <div class="flex items-center gap-2 my-5">
                    {{-- <input type="number"  id="quantity" name="quantity" min="1" value="1" minlength="1"  class="py-2 pl-4 laptop:py-2 laptop:px-10 border text-white rounded  bg-gray-100 w-12"> --}}
                    <input type="number" name="quantity" value="1" style="padding: 8px 0px" class=" border text-black rounded   w-12"/>
                    <input type="hidden" name="product_id" value="{{ $product->id }}"/>
                    <input type="hidden" name="price" id="priceId"/>
                    <input name="main_price" type="hidden" value="{{$product->offer??$product->old_price}}">
                    @if($optinId)
                        <input type="hidden" name="option_id" value="{{ $optinId }}" id="option_id"/>
                    @endif
                    <button type="submit" class=" py-2 px-8 laptop:py-3 laptop:px-10 bg-blue rounded text-white text-sm  font-bold">Add To Cart</button>
                    <a href="#" class=" py-2 px-8 laptop:py-3 laptop:px-10 bg-red rounded text-white text-sm tablet:text-base laptop:text-base font-bold">Buy Now</a>
                </div>   
            </form>
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
            {!! $product->description !!}
           
        </div>

        <div class="a-information">
            <h1 class="text-2xl laptop:text-3xl text-black my-4">Additional information</h1> 

            <div id="additional_information" style="width: 100%">

               @foreach ($product->variations as $variations)
               {{-- {{ $variations }} --}}
                <div class="gap-4 my-5"  style="flex-wrap: nowrap; justify-content: center; align-items: center">
                    <p id="weight" class="text-sm font-bold border-r border-r-slate-300 ">{{ $variations->name }} </p>
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

<script>
    function optionsPrice(price,id) {
        document.getElementById('updateOfferPrice').innerText = price;
        document.getElementById('priceId').value = price;
        document.getElementById('option_id').value = id;
        
    }

</script>
@endsection
