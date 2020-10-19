@extends('layouts.frontend')

@section('title', 'Ошибка 403')

@section('content')

<!-- Title jumbotron -->
<section class="title-jumbotron">
    <div class="parallax-text">
        <h1>Запрещено</h1>
    </div>
</section>
<!-- /.Title jumbotron -->

<!-- Error page -->
<section class="error-page">
    <div class="error-page-wrapper">
        <h1>403</h1>
        <h6>Страница запрещена</h6>
        <p>
            Посещение данной страницы запрещено, так как у вас нет прав администратора.
        </p>
        <a href="{{ url('/') }}" class="button">На главную</a>
    </div>
</section>
<!-- /.Error page -->

@endsection
