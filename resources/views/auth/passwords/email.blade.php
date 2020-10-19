@extends('layouts.frontend')

@section('title', 'Сбросить пароль')

@section('content')

<!-- Title jumbotron -->
<section class="title-jumbotron">
    <div class="parallax-text">
        <h1>Сбросить пароль</h1>
    </div>
</section>
<!-- /.Title jumbotron -->

<!-- Reset page -->
<section class="login-register">
    <div class="login-register-wrapper">
        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
        @endif
        <!-- Form -->
        <form action="{{ route('password.email') }}" method="POST">
            @csrf
            <div class="form-group">
                <div class="group-holder">
                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Email" autocomplete="email">
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        {{ $message }}
                    </span>
                    @enderror
                </div>
            </div>
            <button type="submit" class="button">
                Отправить ссылку
            </button>
        </form>
        <!-- /.Form -->
    </div>
</section>
<!-- /.Reset page -->

@endsection
