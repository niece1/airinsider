@extends('layouts.frontend')

@section('content')

<section class="title-jumbotron">
    <div class="parallax-text">
        <h1>Войти</h1>
    </div>
</section>

<section class="register">
    <div class="register-wrapper">
        <p>Нет аккаунта?<a href="{{ route('register') }}">создать</a></p>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <div class="group-holder">
                    <input id="email fg" type="email" name="email" value="{{ old('email') }}" placeholder="Email" autocomplete="email" required>
                    @error('email')
                    <span class="invalid-feedback">
                        {{ $message }}
                    </span>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <div class="group-holder">
                    <input id="password" type="password" name="password" placeholder="Пароль" autocomplete="current-password" required>
                    @error('password')
                    <span class="invalid-feedback">
                        {{ $message }}
                    </span>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label class="checkbox-container" for="remember">
                    Запомнить меня
                    <input class="checkbox" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <span class="checkmark"></span>
                </label>
            </div>
            <div class="form-group">
                <button type="submit" class="button">
                    Войти
                </button>
                @if (Route::has('password.request'))
                <a class="reset-link" href="{{ route('password.request') }}">
                    Забыли пароль?
                </a>
                @endif
            </div>
        </form>
        <p class="social-proceed">Продолжить с помощью вашей соцсети</p>
        <p><a href="{{ url('login/facebook') }}"><i class="fab fa-facebook-f"></i></a><a href="{{ url('login/google') }}"><i class="fab fa-google"></i></a><a href="{{ url('login/github') }}"><i class="fab fa-github"></i></a></p>
    </div>
</section>

@endsection