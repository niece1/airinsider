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
            <div class="alert">{{ session()->get('message') }}</div>
			@if(!session()->has('message'))

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
			@endif
		</div>

		<div class="right-column">
			<h2>Our office</h2>
		</div>

	</div>
</section>

<section class="slider">
	<h2>Explore our random articles</h2>
<div class="contact-slider">
  @foreach ($random_news as $news_item)
        <div class="item ">
            <div class="image-holder">
                <a href="#"><img src="{{ $news_item->photo->path ?? ''  }}" alt="Photo"></a>
            </div>
            <div class="item-content">
                <a href="#">
                    <h6>{{ $news_item->title }}</h6>
                </a>
                <p class="item-blog-text">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nemo, accusantium?</p>
                <p class="item-blog-author"><i class="fas fa-user-edit"></i>By <a href="#">Volodymyr Zhonchuk</a></p>
                <p><i class="fas fa-clock"></i>{{ $news_item->time_to_read }} minutes to read</p>
                <p class="item-blog-date">October5, 2019</p>
                <p class="item-blog-comment">Comments: 4</p>
                <div class="blog-line">
                </div>

                <div class="item-blog-bottom">
                    <a href="#" class="button">Читать</a>
                    <p><i class="fas fa-tags"></i><a href="#">History</a></p>
                </div>
            </div>
        </div>
        @endforeach
</div>
</section>
@endsection

@push('scripts')
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
@endpush