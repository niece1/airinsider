@extends('layouts.frontend')

@section('title', 'We are missing your email')

@section('meta', 'Airways Media - We are missing your email')

@section('content')

<!-- Title jumbotron -->
<section class="title-jumbotron">
    <div class="parallax-text">
        <h1>Missing email</h1>
    </div>
</section>
<!-- /.Title jumbotron -->

<!-- Missing subscription page -->
<section class="subscribed-unsubscribed">
    <div class="subscribed-unsubscribed-wrapper">
        <h2>We are missing <span class="email">{{ $email }}</span> email</h2>
        <p>
            It seems like you have unsubscribed from our newsletter emails. Fill
            in subscription form again on our home page
        </p>
        <a href="{{ url('/') }}" class="button">Home page</a>
    </div>
</section>
<!-- /.Missing subscription page -->

@endsection
