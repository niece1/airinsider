@extends('layouts.frontend')

@section('title', 'Ошибка 419')

@section('content')

<!-- Title jumbotron -->
<section class="title-jumbotron">
    <div class="parallax-text">
        <h1>Страница устарела</h1>
    </div>
</section>
<!-- /.Title jumbotron -->

<!-- Error page -->
<section class="error-page">
    <div class="error-page-wrapper">
        <h1>419</h1>
        <h6>Данная страница устарела.</h6>
        <p>
            Токен, передаваемый формой, устарел, отсутствует или неверный. Перейдите на главную.
        </p>
        <a href="{{ url('/') }}" class="button">На главную</a>
    </div>
</section>
<!-- /.Error page -->

@endsection
