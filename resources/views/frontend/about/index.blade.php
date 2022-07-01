@extends('layouts.frontend')

@section('title', 'About')

@section('meta', 'Airways Media - Who we are')

@section('content')

<!-- Title jumbotron -->
<section class="title-jumbotron">
    <div class="parallax-text">
        <h1>About</h1>
    </div>
</section>
<!-- /.Title jumbotron -->

<!-- About page -->
<section class="about-page">
    <div class="about-page-wrapper">
        <div class="thumbnail">
            <img class="lazyload"
                src="data:image/gif;base64,R0lGODlhAgABAIAAAP///wAAACH5BAEAAAEALAAAAAACAAEAAAICTAoAOw=="
                data-src="{{ asset('images/takeoff.jpg') }}" alt="Photo">
        </div>
        <div class="about-content">
            <h2>
                Who we are
            </h2>
            <p>
                We are small team of aviation educated specialists working in cooperation with web developers.
                We create and deliver an expert level publications on subject of civil aviation. 
            </p>
        </div>
        <div class="thumbnail">
            <img class="lazyload"
                src="data:image/gif;base64,R0lGODlhAgABAIAAAP///wAAACH5BAEAAAEALAAAAAACAAEAAAICTAoAOw=="
                data-src="{{ asset('images/cargolux.jpg') }}" alt="Photo">
        </div>
        <div class="about-content">
            <h2>Our mission</h2>
            <p>
                News Airways is online content provider aspiring to become the industry leader for online
                information in aviation. Topics we cover: information, analytics, events and news delivered in
                convenient for the reader way in intuitive interface.
            </p>
        </div>
    </div>
</section>
<!-- /.About page -->

@endsection