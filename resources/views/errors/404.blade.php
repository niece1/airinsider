@extends('layouts.frontend')

@section('title', 'Page not found')

@section('content')

<!-- Title jumbotron -->
<section class="title-jumbotron">
    <div class="parallax-text">
        <h1>Page not found</h1>
    </div>
</section>
<!-- /.Title jumbotron -->

<!-- Error page -->
<section class="error-page">
    <div class="error-page-wrapper">
        <h2>404</h2>
        <h6>Page not found</h6>
        <p>
            The page details you entered may be incorrect or the page was removed.
        </p>
        <a href="{{ url('/') }}" class="button">Home page</a>
    </div>
</section>
<!-- /.Error page -->

@endsection
