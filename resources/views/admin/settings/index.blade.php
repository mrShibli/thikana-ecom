@extends('layouts.master')
@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-12 col-md-8 mx-auto">
                <h2 class="text-center py-2">WebSite Settings</h2>
                <div class="card ">
                    <div class="card-body">
                        <form method="post" enctype="multipart/form-data" action="{{route ("admin.settings.store")}}">
                            @csrf
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input class="form-control" type="text" name="title" placeholder="Enter website Title"
                                       @if($setting) value="{{$setting->title}}"
                                       @else value="{{old ("title")}}" @endif
                                >
                                @error('title')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="slogan" class="form-label">Slogan</label>
                                <input class="form-control" type="text" name="slogan" id="slogan" placeholder="Enter website slogan"
                                       @if($setting) value="{{$setting->slogan}}"
                                       @else value="{{old ("slogan")}}" @endif>
                                @error('slogan')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Phone Number</label>
                                        <input class="form-control" type="text" name="phone" id="phone" placeholder="Enter Phone Number"
                                               @if($setting) value="{{$setting->phone}}"
                                               @else value="{{old ("phone")}}" @endif>
                                        @error('phone')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email Address</label>
                                        <input class="form-control" type="email" name="email" id="phone" placeholder="Enter email Address"
                                               @if($setting) value="{{$setting->email}}"
                                               @else value="{{old ("email")}}" @endif>
                                        @error('email')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="address" class="form-label">Address</label>
                                        <input class="form-control" type="text" name="address" id="address" placeholder="Enter Address"
                                               @if($setting) value="{{$setting->address}}"
                                               @else value="{{old ("address")}}" @endif>
                                        @error('address')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="logo" class="form-label">Site Logo</label>
                                        <input class="form-control" type="file" name="logo" id="logo">
                                        @if($setting)
                                            <input class="form-control" type="hidden" value="{{$setting->logo}}" name="old_logo">
                                            <div>
                                                <img src="{{asset ($setting->logo)}}" alt="" width="120"
                                                     class="img-thumbnail">
                                            </div>
                                        @endif
                                        @error('logo')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-success">Update Settings</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
