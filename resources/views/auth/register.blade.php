@extends('layouts.frontend')

@section('title', 'Sign up')

@section('content')

<!-- Title jumbotron -->
<section class="title-jumbotron">
    <div class="parallax-text">
        <h1>Sign up</h1>
    </div>
</section>
<!-- /.Title jumbotron -->

<!-- Register page -->
<section class="login-register">
    <div class="login-register-wrapper">
        <p>Already have account?
            <a href="{{ route('login') }}">Sign in</a>
        </p>
        <!-- Form -->
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="form-group">
                <div class="group-holder">
                    <input type="text" name="name" value="{{ old('name') }}" id="name" placeholder="Name" autocomplete="name" required>
                    @error('name')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <div class="group-holder">
                    <input type="email" name="email" value="{{ old('email') }}" id="email" placeholder="Email" required>
                    @error('email')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <div class="group-holder">
                    <input type="password" name="password" id="password" placeholder="Password" autocomplete="new-password" required>
                    @error('password')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <div class="group-holder">
                    <input type="password" name="password_confirmation" id="password-confirm" placeholder="Confirm password" autocomplete="new-password">
                </div>
            </div>
           <!--@captcha-->
            <button type="submit" class="button">
                Sign up
            </button>
        </form>
        <!-- /.Form -->
    </div>
</section>
<!-- /.Register page -->

@endsection
