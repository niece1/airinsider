@extends('layouts.frontend')

@section('title', 'You are subscribed')

@section('meta', 'Airways Media - You are subscribed')

@section('content')

<!-- Title jumbotron -->
<section class="title-jumbotron">
    <div class="parallax-text">
        <h1>Subscribed</h1>
    </div>
</section>
<!-- /.Title jumbotron -->

<!-- Subscribed page -->
<section class="subscribed-unsubscribed">
    <div class="subscribed-unsubscribed-wrapper">
        <h2>You are subscribed!</h2>
        <p>
            Your subscription has been confirmed and you've been added to the newsletter
        </p>
        <a href="{{ url('/') }}" class="button">Home page</a>
    </div>
</section>
<!-- /.Subscribed page -->

@endsection
