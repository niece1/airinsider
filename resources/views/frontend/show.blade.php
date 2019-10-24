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
			<p>September 7, 2019 / <a href="#">Airbus</a> / by<a href="#">Volodymyr Zhonchuk</a> </p>
			<h1>{{ $news_item->title }}</h1>
			<p>{{ $news_item->body }}</p>
			
		</div>
		<aside class="sidebar">

			<div class="search-widget">
				<form action="#">
					<input type="text" name="search" placeholder="Search">
				</form>
			</div>

			<div class="related-posts-widget">
				<h2>Related posts</h2>
				<ul class="related">
					<li>
						<a href="#">
							<img src="#" alt="Photo">
						</a>
						<div class="post-content">
							<p>
								<a href="#"></a>
							</p>
							<small>September 7, 2019</small>
						</div>
					</li>
				</ul>
			</div>

			<div class="category-widget">
				<h2>Categories</h2>
				@foreach ($categories as $category)
				<ul class="category-list">
					<li><a href="">{{ $category->title }}</a></li>
				</ul>
				@endforeach
			</div>

			<div class="tag-widget">
				<h2>Our tags</h2>
				@foreach ($tags as $tag)
				<div class="tag-cloud">
					<a href="#">{{ $tag->title }}</a>
				</div>
				@endforeach
			</div>

		</aside>
	</div>
</section>
@endsection