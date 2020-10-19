@extends('layouts.error')

@section('title', 'Ошибка 503')

@section('content')

<!-- Title jumbotron -->
<section class="title-jumbotron">
    <div class="parallax-text">
        <h1>Сервис недоступен</h1>
    </div>
</section>
<!-- /.Title jumbotron -->

<!-- Error page -->
<section class="error-page">
    <div class="error-page-wrapper">
        <h1>503</h1>
        <h6>Приложение недоступно</h6>
        <p>Приложение на данный момент недоступно по техническим причинам.</p>
    </div>
</section>
<!-- /.Error page -->

@endsection
