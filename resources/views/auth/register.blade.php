@extends('layouts.frontend')

@section('content')
<div class="register">
    <div class="register-wrapper">

        <h1>{{ __('Register') }}</h1>
        <p>If you already have an account<a href="{{ route('login') }}">login here</a></p>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-group">
                <div class="group-holder">
                    <input id="name" type="text" class="@error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Name" autocomplete="name" autofocus>


                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <div class="group-holder">


                    <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email" required>

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group">


                <div class="group-holder">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password" required autocomplete="new-password">

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group">


                <div class="group-holder">
                    <input id="password-confirm" type="password" class="form-control" placeholder="Confirm password" name="password_confirmation" required autocomplete="new-password">
                </div>
            </div>


            <button type="submit" class="button">
                {{ __('Register') }}
            </button>

        </form>

    </div>
</div>
@endsection