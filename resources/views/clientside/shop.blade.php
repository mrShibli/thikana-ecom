@extends("clientside.app.app")
@section("client-content")
    <h1 id="heading" class=" text-2xl laptop:text-4xl text-black text-center p-2 laptop:p-4 bg-gray-200">Shop</h1>

    <div class="container mx-auto p-3 py-8 flex flex-wrap gap-4 justify-center">

        <div class="w-full laptop:w-1/4">
            <h2 class=" mb-4 text-base text-blue font-semibold">Filter by price</h2>
            <div id="price" class="py-3 border-b">
                <input type="text" class="js-range-slider" name="my_range" value=""/>
            </div>
            <div id="color" class="py-3">
                <h2 class=" mb-4 text-base text-blue font-semibold">Filter by Category</h2>
                <a href="{{route ("shop")}}"
                   class="@if(!$selected_category)active @endif">
                    <p class="text-red hover:text-blue text-sm mb-1">All Category</p>
                </a>
                @foreach($categories as $category)
                    <a href="{{route ("shop",$category->slug)}}"
                       class="@if($category->slug===$selected_category)active @endif">
                        <p class="text-red hover:text-blue text-sm mb-1">{{$category->name}}</p>
                    </a>
                @endforeach

            </div>
            <div id="color" class="py-3">
                <h2 class=" mb-4 text-base text-blue font-semibold">Filter by SubCategory</h2>
                @if($selected_category)
                    <a href="{{route ("shop",$selected_category)}}"
                       class="@if(!$selected_sub_category)active @endif">
                        <p class="text-red hover:text-blue text-sm mb-1">All SubCategory</p>
                    </a>
                @endif
                @if(!empty($sub_categories))
                    @foreach($sub_categories as $sub_category)
                        <a href="{{route ("shop",[$selected_category,$sub_category->slug])}}"
                           class="@if($sub_category->slug===$selected_sub_category)active @endif">
                            <p class="text-red hover:text-blue text-sm mb-1">{{$sub_category->name}}</p>
                        </a>
                    @endforeach
                @endif

            </div>

        </div>

        <div class="w-full laptop:w-[70%]">
            <div class="flex justify-end p-4">
                <select name="sort" id="sort"
                        class="form-select block w-full max-w-xs p-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value="latest" @if($sort_value==="latest") selected @endif>Latest</option>
                    <option value="price_desc" @if($sort_value==="price_desc") selected @endif>
                        Price High to Low</option>
                    <option value="price_asc" @if($sort_value==="price_asc") selected @endif>
                        Price Low to high</option>
                </select>
            </div>
            <div class="grid grid-cols-2 gap-4 tablet:grid-cols-3 laptop:grid-cols-4">
                @foreach($products as $product)
                    @php
                        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $product->title)));
                    @endphp
                    <div class="text-center border rounded p-2">
                        <a href="{{route ("product.single",[$product->id,$slug])}}">
                            <img class="bg-slate-100 p-2" src="{{ asset($product->thumb_image) }}" alt="">
                        </a>
                        <h5 class="title text-sm laptop:text-base font-hindSiliguri">{{$product->title}}</h5>
                        <p class="my-3">
                            @if($product->offer)
                                <span class="regular line-through text-red mr-2">{{ $product->old_price }}৳</span>
                                <span class="special">{{ $product->offer }}৳</span>
                            @else
                                <span class="special">{{$product->old_price }}৳</span>
                            @endif
                        </p>
                        <a href="{{route ("product.single",[$product->id,$slug])}}"
                           class="py-2 block bg-blue text-white text-center rounded-xl text-xs laptop:text-base">View
                            Product</a>
                    </div>
                @endforeach
                @if(count ($products) ===0 )
                    <h2 class="text-center text-red">No product Found</h2>
                @endif
            </div>

        </div>

    </div>
@endsection
@section("script")
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/js/ion.rangeSlider.min.js"></script>
    <script>
        $(document).ready(function () {
            const rangeSilder = $(".js-range-slider").ionRangeSlider({
                type: "double",
                min: 0,
                max: 1000,
                step: 10,
                from: {{$price_min}},
                to: {{$price_max}},
                skin: 'round',
                max_postfix: "+",
                prefix: "$",
                onFinish: function () {
                    applyFilter();
                }
            });
            $("#sort").change(function () {
                applyFilter();
            })
            const slider = $(".js-range-slider").data("ionRangeSlider");

            function applyFilter() {
                let url = '{{url ()->current ()}}?';
                url += `price_min=${slider.result.from}&price_max=${slider.result.to}`;
                //sorting
                url += `&sort=${$("#sort").val()}`
                window.location.href = url;
            }
        });
    </script>
@endsection
