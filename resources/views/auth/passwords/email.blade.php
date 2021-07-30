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
        @include('auth.includes.flash')
        <!-- Form -->
        <form action="{{ route('password.email') }}" method="POST">
            @csrf
            <div class="form-group">
                <div class="group-holder">
                    <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="Email" autocomplete="email" required>
                    @error('email')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <button type="submit" class="button">
                Send password reset link
            </button>
        </form>
        <!-- /.Form -->
    </div>
</section>
<!-- /.Reset page -->

@endsection
