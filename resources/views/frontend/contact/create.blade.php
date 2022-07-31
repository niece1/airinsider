@extends('layouts.frontend')

@section('title', 'Contact us')

@section('meta', 'Airways Media - Contact us')

@section('content')

<!-- Title jumbotron -->
<section class="title-jumbotron">
    <div class="parallax-text">
        <h1>Contact us</h1>
    </div>
</section>
<!-- /.Title jumbotron -->

<!-- Contact page -->
<section class="contact-page">
    <div class="contact-page-wrapper">
        <div class="contact-us">
            <h2>Contact support</h2>
            <p>
                We are here to answer any question related to our subject or help you.
            </p>
            <h3>social</h3>
            <p>
                <span class="contact-social">facebook</span>
                <span class="contact-social">twitter</span>
            </p>
        </div>
        <div class="contact-form">
            <h2>Fill in the form</h2>
            @include('frontend.contact.includes.flash')
            @if (!session()->has('success'))
            <!-- Contact form -->
            <form action="/contact" method="POST">
                <div class="contact-form-group">
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="Name" autocomplete="name" required>
                    <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                </div>
                <div class="contact-form-group">
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="Email" autocomplete="email" required>
                    <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                </div>
                <div class="contact-form-group">
                    <textarea type="text" name="message" placeholder="Message" autocomplete="message" required>
                        {{ old('message') }}
                    </textarea>
                    <div class="invalid-feedback">
                        {{ $errors->first('message') }}
                    </div>
                    <div class="policy-consent">
                        <small>
                            By sending the form you accept 
                            <a href="{{ route('terms-and-conditions') }}">Terms and Conditions</a> and
                            <a href="{{ route('privacy-policy') }}">Privacy Policy.</a>
                        </small>
                    </div>
                </div>
                <x-honey recaptcha/>
                <button type="submit" class="button">Send</button>
                @csrf
            </form>
            <!-- /.Contact form -->
            @endif
        </div>
        <div class="right-column">
            <h2>Get in touch</h2>
            <p>
                Let us know how we can help you. If you are experiencing a technical problem, please inform us.
                Looking for ways to partner with on your next project? Tell us more about what you need.
            </p>
        </div>
    </div>
</section>
<!-- /.Contact page -->

@endsection
