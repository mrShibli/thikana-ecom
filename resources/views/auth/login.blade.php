@extends('layouts.authmaster')

@section('content')
    <div class="container form-container">
        <div class="registration-form">
            <div class="form-logo text-center">
                <img src="{{ asset('clientside/images/logo.png') }}" alt="" class="img-fluid" width="150">
            </div>
            <h5 class=" mt-2 text-center">{{ __('Login Your Account Now!') }}</h5>
            <hr>
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                        name="email" value="{{ old('email') }}" autocomplete="email" autofocus
                        placeholder="Enter your email" required>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                        placeholder="Password" name="password" required autocomplete="current-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                            {{ old('remember') ? 'checked' : '' }}>

                        <label class="form-check-label" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                    </div>
                </div>



                <button type="submit" class="btn btn-primary btn-block">{{ __('Login') }}</button>
                @if (Route::has('login'))
                    <a class="mt-2" href="{{ route('register') }}"> <small> <span>Don't have accouunt ?</span>
                            {{ __('Resgiter') }}</small>
                    </a> <br>
                @endif
                @if (Route::has('password.request'))
                    <a class="" href="{{ route('password.request') }}">
                        <small> {{ __('Forgot Your Password?') }}</small>
                    </a>
                @endif
            </form>
        </div>
    </div>
@endsection
