@extends('layouts.frontend')

@section('content')

<section class="title-jumbotron">
    <div class="parallax-text">
        <h1>{{ __('Login') }}</h1>
    </div>
</section>

<section class="register">
    <div class="register-wrapper">        
        <p>Don't have an account?<a href="{{ route('register') }}">sign up here</a></p>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <div class="group-holder">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email" autocomplete="email" autofocus>

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        {{ $message }}
                    </span>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <div class="group-holder">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" autocomplete="current-password">

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        {{ $message }}
                    </span>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label class="checkbox-container" for="remember">
                    {{ __('Remember Me') }}
                    <input class="checkbox" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <span class="checkmark"></span>
                </label>
            </div>
            <div class="form-group">
                <button type="submit" class="button">
                    {{ __('Login') }}
                </button>
                @if (Route::has('password.request'))
                <a class="reset-link" href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
                @endif
            </div>
        </form>
        <p class="social-proceed">Proceed with your social network</p>
        <p><a href="{{ url('login/facebook') }}"><i class="fab fa-facebook-f"></i></a><a href="{{ url('login/google') }}"><i class="fab fa-google"></i></a><a href="{{ url('login/github') }}"><i class="fab fa-github"></i></a></p>
    </div>
</section>

@endsection