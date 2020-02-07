@extends('layouts.frontend')

@section('content')

<section class="title-jumbotron">
    <div class="parallax-text">
       <h1>{{ __('Register') }}</h1>
   </div>
</section>

<section class="register">
    <div class="register-wrapper">        
        <p>If you already have an account<a href="{{ route('login') }}">login here</a></p>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-group">
                <div class="group-holder">
                    <input id="name" type="text" class="@error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Name" autocomplete="name" autofocus>
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        {{ $message }}
                    </span>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <div class="group-holder">
                    <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email">
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        {{ $message }}
                    </span>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <div class="group-holder">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password" autocomplete="new-password">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        {{ $message }}
                    </span>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <div class="group-holder">
                    <input id="password-confirm" type="password" class="form-control" placeholder="Confirm password" name="password_confirmation" autocomplete="new-password">
                </div>
            </div>
            @captcha
            <button type="submit" class="button">
                {{ __('Register') }}
            </button>
        </form>
    </div>
</section>

@endsection