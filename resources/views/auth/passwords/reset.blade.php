@extends('layouts.frontend')

@section('title', 'Reset password')

@section('content')

<!-- Title jumbotron -->
<section class="title-jumbotron">
    <div class="parallax-text">
        <h1>Reset password</h1>
    </div>
</section>
<!-- /.Title jumbotron -->

<!-- Reset page -->
<section class="login-register">
    <div class="login-register-wrapper">
        <!-- Form -->
        <form action="{{ route('password.update') }}" method="POST">
            @csrf
            <div class="form-group">
                <div class="group-holder">
                    <input type="hidden" name="token" value="{{ $token }}">
                    <input id="email" type="email" name="email" value="{{ $email ?? old('email') }}" placeholder="Email" autocomplete="email" required>
                    @error('email')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <div class="group-holder">
                    <input id="password" type="password" name="password" placeholder="Password" autocomplete="new-password" required>
                    @error('password')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <div class="group-holder">
                    <input id="password-confirm" type="password" name="password_confirmation" placeholder="Confirm password" autocomplete="new-password" required>
                </div>
            </div>
            <button type="submit" class="button">
                Reset password
            </button>
        </form>
        <!-- /.Form -->
    </div>
</section>
<!-- /.Reset page -->

@endsection
