@extends('layouts.frontend')

@section('title', 'You have been already unsubscribed')

@section('meta', 'Airways Media - You have been already unsubscribed')

@section('content')

<!-- Title jumbotron -->
<section class="title-jumbotron">
    <div class="parallax-text">
        <h1>Unsubscribed</h1>
    </div>
</section>
<!-- /.Title jumbotron -->

<!-- Already unsubscribed page -->
<section class="subscribed-unsubscribed">
    <div class="subscribed-unsubscribed-wrapper">
        <h2>You have been already unsubscribed</h2>
        <p>
            We have unsubscribed you from our newsletter emails earlier
        </p>
        <a href="{{ url('/') }}" class="button">Home page</a>
    </div>
</section>
<!-- /.Already unsubscribed page -->

@endsection
