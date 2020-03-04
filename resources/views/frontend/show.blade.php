@extends('layouts.frontend')

@section('title', $post->title)

@section('content')

<section class="title-jumbotron">
    <div class="parallax-text">
        <h1>{{ $post->title }}</h1>
    </div>
</section>

<section class="news-show">
    <div class="news-show-wrapper">
        <div class="item-itself">
            @if($post->photo)
            <div class="thumbnail">
                <img src="{{ asset('storage/'.$post->photo->path) }}" alt="Photo">
            </div>
            <p>{{ $post->photo_source }}</p>
            @endif
            <p>
                @if($post->updated_at){{ date('d-m-Y', strtotime($post->updated_at)) }}@endif
                @if($post->category)<span class="dot"></span> <a href="{{ route('category', [$post->category->id]) }}">{{ $post->category->title }}</a>@endif
                @if($post->user)<span class="dot"></span> by <a href="{{ route('user', [$post->user->id]) }}">{{ $post->user->name }}</a>@endif
            </p>
            <h1>{{ $post->title }}</h1>
            <p class="show-body">{!! clean($post->body) !!}</p>
            <div class="item-line"></div>
            <!-- Go to www.addthis.com/dashboard to customize your tools -->
            <div class="addthis_inline_share_toolbox add-this-position"></div>
            <p class="meta-right">
            <likes :default_likes="{{ $post->likes }}" :entity_id="{{ $post->id }}" :entity_owner="{{ $post->user_id }}"></likes>
            </p>
            <comments :post="{{ $post }}"></comments>
        </div>
        <aside class="sidebar">
            <div class="related-posts-widget">
                <h2>Related posts</h2>
                @foreach ($related as $post)
                <ul class="related">
                    <li>
                        @if($post->photo)
                        <a href="{{ route('post.show', [$post->slug]) }}">
                            <img src="{{ asset('storage/'.$post->photo->path) }}" alt="Photo">
                        </a>
                        @endif
                        <div class="post-content">
                            <p>
                                <a href="{{ route('post.show', [$post->slug]) }}">{{ $post->title }}</a>
                            </p>
                            <small>{{ $post->date }}</small>
                        </div>
                    </li>
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
            <div class="category-widget">
                <h2>Categories</h2>
                @foreach ($categories as $category)
                <ul class="category-list">
                    <li><a href="{{ route('category', [$category->id]) }}">{{ $category->title }}</a></li>
                </ul>
                @endforeach
            </div>
        </aside>
        <div class="clear"></div>
    </div>
</section>

@endsection

@push('scripts')

<script type="text/javascript" src="{{ asset('js/sticky-kit.min.js') }}"></script>
<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5de3d2128881893a"></script>

@endpush