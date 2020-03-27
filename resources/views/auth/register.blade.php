@extends('layouts.frontend')

@section('content')

<section class="title-jumbotron">
    <div class="parallax-text">
        <h1>Создать аккаунт</h1>
    </div>
</section>

<section class="register">
    <div class="register-wrapper">
        <p>Уже есть аккаунт?<a href="{{ route('login') }}">войти</a></p>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-group">
                <div class="group-holder">
                    <input id="name" type="text" name="name" value="{{ old('name') }}" placeholder="Имя" autocomplete="name" required>
                    @error('name')
                    <span class="invalid-feedback">
                        {{ $message }}
                    </span>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <div class="group-holder">
                    <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="Email" required>
                    @error('email')
                    <span class="invalid-feedback">
                        {{ $message }}
                    </span>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <div class="group-holder">
                    <input id="password" type="password" placeholder="Пароль" name="password" autocomplete="new-password" required>
                    @error('password')
                    <span class="invalid-feedback">
                        {{ $message }}
                    </span>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <div class="group-holder">
                    <input id="password-confirm" type="password" placeholder="Подтвердите пароль" name="password_confirmation" autocomplete="new-password">
                </div>
            </div>
            <div class="contact-form-group">
                <div class="group-holder">
                    <input type="hidden" class="g-token" name="g-token">
                </div>
            </div>
            <!--@captcha-->
            <button type="submit" class="button">
                Создать
            </button>
        </form>
    </div>
</section>

@endsection