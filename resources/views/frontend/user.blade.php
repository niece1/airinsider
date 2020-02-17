@extends('layouts.frontend')

@section('title', 'Автор: ' . $user->name)

@section('content')

<section class="title-jumbotron">
    <div class="parallax-text">
        <h1>Автор: {{ $user->name }}</h1>
    </div>
</section>

<!-- Posts by category section -->
<section class="news">
    <div class="news-wrapper">
        @foreach ($news_by_user as $news_item)
        <div class="item">
            @if($news_item->photo)
            <div class="image-holder">
                <a href="{{ route('post.show', [$news_item->slug]) }}"><img src="{{ asset('storage/'.$news_item->photo->path) }}" alt="Photo"></a>
            </div>
            @endif
            <div class="item-content">
                <a href="{{ route('post.show', [$news_item->slug]) }}">
                    <h6>{{ $news_item->title }}</h6>
                </a>
                <p class="item-blog-text">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nemo, accusantium?</p>
                <p class="item-blog-author"><i class="fas fa-user-edit"></i>By <a href="{{ route('user', [$news_item->user->id]) }}">{{ $news_item->user->name }}</a></p>
                <p><i class="fas fa-clock"></i>{{ $news_item->time_to_read }} minutes to read</p>
                <p class="item-blog-date">October5, 2019</p>
                <p class="item-blog-comment">Comments: 4</p>
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
        {{ $news_by_user->links() }}
    </div>
</section>

@endsection