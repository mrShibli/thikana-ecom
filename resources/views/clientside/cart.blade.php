@extends('clientside.app.app')

@section('client-content')
<div class="container mx-auto p-3 laptop:py-10">
    <h1 class="text-xl laptop:text-2xl text-blue text-center py-4">Cart</h1>
    <div class="divider border my-2 mb-8"> </div>

    <div class="flex flex-wrap gap-4">
        @if(session('success'))
        <div class="bg-green-300 p-3 text-white text-center w-full">{{session('success')}}</div>
        @endif

        <div class="w-full laptop:w-[70%] border rounded p-1 laptop:p-4 flex justify-center"> 

            <div id="cart-table" class="p-1 tablet:p-3 laptop:p-4">
                 <table class="flex">
                <tr class="border">
                  <th class="border p-1 laptop:p-2 px-1 laptop:px-4 text-[10px]  laptop:text-xs">Remove</th>
                  <th class="border p-1 laptop:p-2 px-1 laptop:px-4 text-[10px]  laptop:text-xs">Thumbnail</th>
                  <th class="border p-1 laptop:p-2 px-1 laptop:px-4 text-[10px]  laptop:text-xs">Product Title	</th>
                  <th class="border p-1 laptop:p-2 px-1 laptop:px-4 text-[10px]  laptop:text-xs">Price</th>
                  <th class="border p-1 laptop:p-2 px-1 laptop:px-4 text-[10px]  laptop:text-xs">Quantity</th>
                  <th class="border p-1 laptop:p-2 px-1 laptop:px-4 text-[10px]  laptop:text-xs">Total</th> 
                </tr>
                @foreach ($carts as $cart)
                    <tr>
                    <td class="border p-1 laptop:p-2 px-1 laptop:px-4 text-xs text-[10px]  text-red">
                        <a href="{{route ("cart.destroy",$cart->id)}}"><i class="fas fa-times pl-4"></i></a>
                    </td>
                    <td class="border p-1 laptop:p-2 px-1 laptop:px-4 text-xs text-[10px] " id="p-img"><a href=""><img src="{{asset ($cart->product->thumb_image)}}" alt="" class=" h-12 w-10 laptop:h-16 laptop:w-14"></a></td>
                    <td class="border p-1 laptop:p-2 px-1 laptop:px-4 text-xs text-[10px] " id="p-title"><a href="">{{$cart->product->title}}</a></td>
                    <td class="border p-1 laptop:p-2 px-1 laptop:px-4 text-xs text-[10px] " id="p-price">{{ $cart->price }}৳</td>
                    <td class="border p-1 laptop:p-2 px-1 laptop:px-4 text-xs text-[10px] ">{{ $cart->qunt }}</td>
                    <td class="border p-1 laptop:p-2 px-1 laptop:px-4 text-xs text-[10px] " id="p-price-total">{{ $cart->qunt * $cart->price }}৳</td>
                    </tr>
                @endforeach
                 
              </table>
               <div class=" p-4 bg-[#F2F2F2]">
                <input class="py-2 px-3 bg-white text-xs placeholder:text-[10px] laptop:placeholder:text-xs" type="text" name="text" placeholder="Coupon Code" id="">
                <a href="" class="py-2 px-3 bg-blue text-[10px] laptop:text-xs text-white">Apply Coupon</a>
                <a href="" class="py-2 px-3 bg-[#9091c2] text-xs text-white block text-center my-4 rounded">Apply Coupon</a>

            </div>
            </div>    

        </div>


        <div class=" w-full laptop:w-[27%] border rounded p-2 laptop:p-4">
            <h2 class="text-base text-black">Cart totals</h2>
            <div class="flex justify-evenly gap-4  my-4 bg-slate-100 border border-gray-300">
                <p class="p-2 text-xs laptop:text-sm">Subtotal</p>
                <p class="p-2 border-l border-gray-300 pl-6 text-xs laptop:text-sm">{{$sub_total}}৳</p>
            </div>
            <a href="{{route ("checkout")}}" class="py-2 px-3 bg-blue text-xs text-white block text-center rounded">Proceed to checkout</a>

            <div>  
                <iframe class="mt-5 rounded" src="https://www.youtube.com/embed/MvOTNP_xQ7A?si=4eR_nfb_qj42-bns" height="160" width="290"></iframe>  
                
            </div>
            
        </div>
    </div>

</div>

@endsection
