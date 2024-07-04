@extends("clientside.app.app")
@section("client-content")
    <div class="container mx-auto p-3 laptop:py-10">
        <h1 class="text-center text-2xl pb-5">{{$page->title}}</h1>
        {!! $page->content !!}
    </div>
@endsection
