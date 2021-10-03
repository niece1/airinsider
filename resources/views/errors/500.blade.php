@extends('layouts.frontend')

@section('title', 'Something went wrong')

@section('content')

<!-- Title jumbotron -->
<section class="title-jumbotron">
    <div class="parallax-text">
        <h1>Something went wrong</h1>
    </div>
</section>
<!-- /.Title jumbotron -->

<!-- Error page -->
<section class="error-page">
    <div class="error-page-wrapper">
        <h2>500</h2>
        <h6>Something went wrong.</h6>
        <p>
            We've been notified and will try to fix the problem as soon as possible.
        </p>
        <a href="{{ url('/') }}" class="button">Home page</a>
    </div>
</section>
<!-- /.Error page -->

@endsection
