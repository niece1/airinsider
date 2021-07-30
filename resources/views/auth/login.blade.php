@extends('layouts.frontend')

@section('title', 'Sign in')

@section('content')

<!-- Title jumbotron -->
<section class="title-jumbotron">
    <div class="parallax-text">
        <h1>Sign in</h1>
    </div>
</section>
<!-- /.Title jumbotron -->

<!-- Login page -->
<section class="login-register">
    <div class="login-register-wrapper">
        <p>Don't have account?
            <a href="{{ route('register') }}">create</a>
        </p>
        <!-- Form -->
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="form-group">
                <div class="group-holder">
                    <input type="email" name="email" value="{{ old('email') }}" id="email" placeholder="Email" autocomplete="email" required>
                    @error('email')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <div class="group-holder">
                    <input type="password" name="password" id="password" placeholder="Password" autocomplete="current-password" required>
                    @error('password')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label class="checkbox-container" for="remember">
                    Remember me
                    <input type="checkbox" name="remember" id="remember" class="checkbox" {{ old('remember') ? 'checked' : '' }}>
                    <span class="checkmark"></span>
                </label>
            </div>
            <!--@captcha-->
            <div class="form-group">
                <button type="submit" class="button">
                    Sign in
                </button>
                @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="reset-link">
                    Forgot your password?
                </a>
                @endif
            </div>
        </form>
        <!-- /.Form -->
        
        <!-- Social login -->
        <p class="social-proceed">Proceed with your social network</p>
        <p>
            <a href="{{ url('login/facebook') }}">
                <i class="fab fa-facebook-f"></i>
            </a>
            <a href="{{ url('login/google') }}">
                <i class="fab fa-google"></i>
            </a>
            <a href="{{ url('login/github') }}">
                <i class="fab fa-github"></i>
            </a>
        </p>
        <!-- /.Social login -->
    </div>
</section>
<!-- /.Login page -->

@endsection
