@extends('layouts.frontend')

@section('content')

<section class="title-jumbotron">
    <div class="parallax-text">
       <h1>{{ __('Reset Password') }}</h1>
   </div>
</section>

<section class="register">
    <div class="register-wrapper">
        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
        @endif
        <form method="POST" action="{{ route('password.email') }}">
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
            <button type="submit" class="button">
                {{ __('Send Password Reset Link') }}
            </button>
        </form>
    </div>
</section>

@endsection