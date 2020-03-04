@extends('layouts.frontend')

@section('title', 'Ошибка 404')

@section('content')

<section class="title-jumbotron">
    <div class="parallax-text">
        <h1>Страница не найдена</h1>
    </div>
</section>

<section class="error-page">
    <div class="error-page-wrapper">
        <h1>404</h1>
        <h6>Страница не найдена</h6>
        <p>Страница, которую вы ищете не существует. Возможно, она была удалена или перемещена.</p>
        <a href="{{ url('/') }}" class="button">На главную</a>
    </div>
</section>

@endsection

