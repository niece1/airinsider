@extends('layouts.frontend')

@section('title', 'Войти')

@section('content')

<section class="title-jumbotron">
    <div class="parallax-text">
        <h1>Войти</h1>
    </div>
</section>

<section class="register">
    <div class="register-wrapper">
        <p>Нет аккаунта?
            <a href="{{ route('register') }}">создать</a>
        </p>
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
                    <input type="password" name="password" id="password" placeholder="Пароль" autocomplete="current-password" required>
                    @error('password')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label class="checkbox-container" for="remember">
                    Запомнить меня
                    <input type="checkbox" name="remember" id="remember" class="checkbox" {{ old('remember') ? 'checked' : '' }}>
                    <span class="checkmark"></span>
                </label>
            </div>
            @captcha
            <div class="form-group">
                <button type="submit" class="button">
                    Войти
                </button>
                @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="reset-link">
                    Забыли пароль?
                </a>
                @endif
            </div>
        </form>
        <p class="social-proceed">Продолжить с помощью вашей соцсети</p>
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
    </div>
</section>

@endsection
