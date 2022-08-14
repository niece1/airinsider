@extends('layouts.frontend')

@section('title', 'You are unsubscribed')

@section('meta', 'Airways Media - You are unsubscribed')

@section('content')

<!-- Title jumbotron -->
<section class="title-jumbotron">
    <div class="parallax-text">
        <h1>Unsubscribed</h1>
    </div>
</section>
<!-- /.Title jumbotron -->
@if (session()->has('error'))
<div class="flash">
    <div class="flash-wrapper">
        <span class="alert-success">{{ session('error') }}</span>
    </div>
</div>
@endif
<!-- Unsubscribed page -->
<section class="subscribed-unsubscribed">
    <div class="subscribed-unsubscribed-wrapper">
        <h2>You are unsubscribed</h2>
        <p>
            We are sorry to see you go and you will no longer receive emails from us
        </p>
        <a href="{{ url('/') }}" class="button">Home page</a>
    </div>
</section>
<!-- /.Unsubscribed page -->

@endsection
