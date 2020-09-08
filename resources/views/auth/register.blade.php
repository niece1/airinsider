@extends('layouts.frontend')

@section('title', 'Создать аккаунт')

@section('content')

<section class="title-jumbotron">
    <div class="parallax-text">
        <h1>Создать аккаунт</h1>
    </div>
</section>

<section class="register">
    <div class="register-wrapper">
        <p>Уже есть аккаунт?
            <a href="{{ route('login') }}">войти</a>
        </p>
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="form-group">
                <div class="group-holder">
                    <input type="text" name="name" value="{{ old('name') }}" id="name" placeholder="Имя" autocomplete="name" required>
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
                    <input type="password" name="password" id="password" placeholder="Пароль" autocomplete="new-password" required>
                    @error('password')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <div class="group-holder">
                    <input type="password" name="password_confirmation" id="password-confirm" placeholder="Подтвердите пароль" autocomplete="new-password">
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
