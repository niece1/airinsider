@extends('layouts.frontend')

@section('content')
<!-- Jumbotron section -->
<section class="jumbothron">
    <div class="jumbothron-wrapper">
        <div class="content">
            <h1>{{ $featured->title }}</h1>
            <p>{{ $featured->featured_description }}{{ $featured->featured_three_dots }}</p>
            <a class="button" href="{{ route('post.show', [$featured->slug]) }}">Читать</a>
        </div>
        @if($featured->photo)
        <div class="photo">
            <img src="{{ asset('storage/'.$featured->photo->path) }}" alt="News">
        </div>
        @endif
    </div>
</section>

<!-- News section -->
<section class="news">
    <h1>Latest news</h1>
    <div class="news-wrapper">
        @foreach ($news as $news_item)
        <div class="item">
            @if($news_item->photo)
            <div class="image-holder">
                <a href="{{ route('post.show', [$news_item->slug]) }}">
                    <img src="{{ asset('storage/'.$news_item->photo->path) }}" alt="Photo">
                    <div class="image-overlay"></div>
                </a>
            </div>
            @endif
            <div class="item-content">
                <a href="{{ route('post.show', [$news_item->slug]) }}">
                    <h6>{{ $news_item->title }}</h6>
                </a>
                <p class="item-blog-text">{{ $news_item->description }}{{ $news_item->three_dots }}</p>
                @if($news_item->user)
                <p class="item-blog-author"><i class="fas fa-user-edit"></i>By <a href="{{ route('user', [$news_item->user->id]) }}">{{ $news_item->user->name }}</a></p>
                @endif
                <p><i class="fas fa-clock"></i>{{ $news_item->time_to_read }} minutes to read</p>
                <p class="item-blog-date">{{ $news_item->date }}</p>
                <p class="item-blog-comment">Comments: {{ $news_item->comments->count() }}</p>
                <div class="blog-line">
                </div>
                <div class="item-blog-bottom">
                    <a href="{{ route('post.show', [$news_item->slug]) }}" class="button">Читать</a>
                    @if($news_item->category)
                    <p><i class="fas fa-tags"></i><a href="{{ route('category', [$news_item->category->id]) }}">{{ $news_item->category->title }}</a></p>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>

<section class="news-pagination">
    <div class="news-pagination-wrapper">
        {{ $news->links() }}
    </div>
</section>

@endsection