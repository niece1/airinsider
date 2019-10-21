@extends('layouts.frontend')

@section('content')

<section class="contact-jumbotron">
	<div class="parallax-text">
		<h1>Contact us</h1>
	</div>
</section>

<section class="contact-page">
	<div class="contact-page-wrapper">

		<div class="contact-us">
			<h2>Don'nt be shy...</h2>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nobis veniam unde tenetur ullam.</p>
			<h5>social media</h5>
			<p class="contact-social">
				<a href="#" id="facebook">fb</a>
				<a href="#" id="twitter">tw</a>
				<a href="#">pt</a>
			</p>
		</div>

		<div class="contact-form">
			<h2>Write to us</h2>
			<form method="POST" action="/contact">

				<div class="contact-form-group">
					<input type="text" name="name" placeholder="Name" value="{{ old('name') }}" autocomplete="name" autofocus>
					<div class="invalid-feedback">{{ $errors->first('name') }}</div>                                
				</div>

				<div class="contact-form-group">              
					<input type="email" name="email"  placeholder="Email" value="{{ old('email') }}" autocomplete="email">
					<div class="invalid-feedback">{{ $errors->first('email') }}</div>                                   
				</div>

				<div class="contact-form-group">              
					<textarea type="text" name="message" placeholder="Message" value="{{ old('message') }}" autocomplete="message"></textarea>
					<div class="invalid-feedback">{{ $errors->first('message') }}</div>                                
				</div>
				@csrf
				<button type="submit" class="button">Send</button>

			</form>
		</div>

		<div class="right-column">
			<h2>Our office</h2>
		</div>

	</div>
</section>


@endsection

