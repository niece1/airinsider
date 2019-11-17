@extends('layouts.frontend')

@section('content')
<section class="contact-jumbotron">
	<div class="parallax-text">
		<h1>{{ $news_item->title }}</h1>
	</div>
</section>

<section class="news-show">
	<div class="news-show-wrapper">
		<div class="item-itself">
			<div class="thumbnail">
			<img src="{{ $news_item->photo->path ?? ''  }}" alt="Photo">
			</div>
			<p>September 7, 2019 <span class="dot"></span> <a href="#">{{ $news_item->category->title }}</a> <span class="dot"></span> by <a href="#">Volodymyr Zhonchuk</a> </p>
			<h1>{{ $news_item->title }}</h1>
			<p>{{ $news_item->body }}</p>
			<div class="item-line"></div>
			<a href="#" class="share" id="facebook">fb</a>
            <a href="#" class="share" id="twitter">tw</a>
            <a href="#" class="share">vk</a>
            <p class="meta-right"><i class="far fa-comment"></i><span>3</span> <i class="far fa-heart"></i><span>12</span></p>
            <comments :news_item="{{ $news_item }}"></comments>
		</div>
		<aside class="sidebar">

			<div class="search-widget">
				<form action="#">
					<input type="text" name="search" placeholder="Search">
					<button class="submit"><i class="fas fa-search"></i></button>
				</form>
			</div>

			<div class="related-posts-widget">
				<h2>Related posts</h2>
				@foreach ($related as $post)
				<ul class="related">
					<li>
						<a href="#">
							<img src="{{ $post->photo->path ?? '' }}" alt="Photo">
						</a>
						<div class="post-content">
							<p>
								<a href="#">{{ $post->title }}</a>
							</p>
							<small>September 7, 2019</small>
						</div>
					</li>
				</ul>
				@endforeach
			</div>

			<div class="category-widget">
				<h2>Categories</h2>
				@foreach ($categories as $category)
				<ul class="category-list">
					<li><a href="#">{{ $category->title }}</a></li>
				</ul>
				@endforeach
			</div>

			<div class="tag-widget">
				<h2>Our tags</h2>				
				<div class="tag-cloud">
					@foreach ($tags as $tag)
					<a href="#">{{ $tag->title }}</a>
					@endforeach
				</div>				
			</div>

		</aside>
		<div class="clear"></div>
	</div>
</section>
@endsection

@push('scripts')
    <script type="text/javascript" src="{{ asset('js/sticky-kit.js') }}"></script>
@endpush