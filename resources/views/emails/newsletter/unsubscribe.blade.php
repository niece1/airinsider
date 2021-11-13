@extends('layouts.frontend')

@section('title', 'Unsubscribe')

@section('content')

<!-- Title jumbotron -->
<section class="title-jumbotron">
    <div class="parallax-text">
        <h1>Unsubscribe</h1>
    </div>
</section>
<!-- /.Title jumbotron -->

<!-- Error page -->
<section class="unsubscribe-page">
    <div class="unsubscribe-page-wrapper">
        <h4>You are successfully unsubscribed</h4>
        <p>
            We are sorry to see you go and you will no longer receive emails from us
        </p>
        <a href="{{ url('/') }}" class="button">Home page</a>
    </div>
</section>
<!-- /.Error page -->

@endsection
