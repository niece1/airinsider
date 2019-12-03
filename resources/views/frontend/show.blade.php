@extends('layouts.frontend')

@section('content')
<section class="contact-jumbotron">
	<div class="parallax-text">
		<h1>{{ $post->title }}</h1>
	</div>
</section>

<section class="news-show">
	<div class="news-show-wrapper">
		<div class="item-itself">
			<div class="thumbnail">
			<img src="{{ $post->photo->path ?? ''  }}" alt="Photo">
			</div>
			<p>{{ date('d-m-Y', strtotime($post->updated_at)) }} <span class="dot"></span> <a href="{{ route('category', [$post->category->id]) }}">{{ $post->category->title }}</a> <span class="dot"></span> by <a href="{{ route('user', [$post->user->id]) }}">{{ $post->user->name }}</a> </p>
			<h1>{{ $post->title }}</h1>
			<p>{{ $post->body }}</p>
			<div class="item-line"></div>
			
                <!-- Go to www.addthis.com/dashboard to customize your tools -->
                <div class="addthis_inline_share_toolbox add-this-position"></div>
            
            <p class="meta-right">
            	<likes :default_likes="{{ $post->likes }}" :entity_id="{{ $post->id }}" :entity_owner="{{ $post->user_id }}"></likes>
            </p>
            <comments :post="{{ $post }}"></comments>
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
					<li><a href="{{ route('category', [$category->id]) }}">{{ $category->title }}</a></li>
				</ul>
				@endforeach
			</div>

			<div class="tag-widget">
				<h2>Our tags</h2>				
				<div class="tag-cloud">
					@foreach ($tags as $tag)
					<a href="{{ route('tag', [$tag->id]) }}">{{ $tag->title }}</a>
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
<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5de3d2128881893a"></script>

@endpush