@extends('layouts.frontend')

@section('title', 'Page expired')

@section('content')

<!-- Title jumbotron -->
<section class="title-jumbotron">
    <div class="parallax-text">
        <h1>Page expired</h1>
    </div>
</section>
<!-- /.Title jumbotron -->

<!-- Error page -->
<section class="error-page">
    <div class="error-page-wrapper">
        <h2>419</h2>
        <h6>Page expired</h6>
        <p>
            Sorry, your session has expired. Please refresh and try again.
        </p>
        <a href="{{ url('/') }}" class="button">Home page</a>
    </div>
</section>
<!-- /.Error page -->

@endsection
