@extends('layouts.frontend')

@section('title', 'Тэг: ' . $tag->title)

@section('content')

<section class="title-jumbotron">
    <div class="parallax-text">
        <h1>Тэг: {{ $tag->title }}</h1>
    </div>
</section>

<!-- Posts by category section -->
<section class="news">
    <div class="news-wrapper">
        @foreach ($news_by_tag as $news_item)
        <div class="item">
            @if($news_item->photo)
            <div class="image-holder">
                <a href="{{ route('post.show', [$news_item->slug]) }}">
                    <img class="lazyload" src="data:image/gif;base64,R0lGODlhBAADAIAAAP///wAAACH5BAEAAAEALAAAAAAEAAMAAAIDjI9WADs=" data-src="{{ asset('storage/'.$news_item->photo->path) }}" alt="Photo">
                    <div class="image-overlay"></div>
                </a>
            </div>
            @endif
            <div class="item-content">
                <a href="{{ route('post.show', [$news_item->slug]) }}">
                    <h6>{{ $news_item->title }}</h6>
                </a>
                <p class="item-blog-text">{{ $news_item->description }}{{ $news_item->three_dots }}</p>
                <p class="item-blog-author"><i class="fas fa-user-edit"></i>By <a href="{{ route('user', [$news_item->user->id]) }}">{{ $news_item->user->name }}</a></p>
                <p><i class="fas fa-clock"></i>{{ $news_item->time_to_read }} minutes to read</p>
                <p class="item-blog-date">{{ $news_item->date }}</p>
                <p class="item-blog-comment">Comments: {{ $news_item->comments->count() }}</p>
                <div class="blog-line">
                </div>
                <div class="item-blog-bottom">
                    <a href="{{ route('post.show', [$news_item->slug]) }}" class="button">Читать</a>
                    <p><i class="fas fa-tags"></i><a href="{{ route('category', [$news_item->category->id]) }}">{{ $news_item->category->title }}</a></p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>

<section class="news-pagination">
    <div class="news-pagination-wrapper">
        {{ $news_by_tag->links() }}
    </div>
</section>

@endsection