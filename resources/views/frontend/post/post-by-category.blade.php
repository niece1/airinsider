@extends('layouts.frontend')

@section('title', $chosen_category->title)

@section('content')

<section class="title-jumbotron">
    <div class="parallax-text">
        <h1>{{ $chosen_category->title }}</h1>
    </div>
</section>

<!-- Posts by category section -->
<section class="news">
    <div class="news-wrapper">
        @foreach ($posts_by_category as $post_item)
        <div class="item">
            @if ($post_item->photo)
            <div class="image-holder">
                <a href="{{ route('post.show', [$post_item->slug]) }}">
                    <img class="lazyload"
                        src="data:image/gif;base64,R0lGODlhBAADAIAAAP///wAAACH5BAEAAAEALAAAAAAEAAMAAAIDjI9WADs="
                        data-src="{{ asset('storage/' . $post_item->photo->path) }}" alt="Photo">
                    <div class="image-overlay"></div>
                </a>
            </div>
            @endif
            <div class="item-content">
                <a href="{{ route('post.show', [$post_item->slug]) }}">
                    <h6>{{ $post_item->title }}</h6>
                </a>
                <p class="item-blog-text">
                    {{ $post_item->description }}{{ $post_item->three_dots }}
                </p>
                @if ($post_item->user)
                <p class="item-blog-author">
                    <i class="fas fa-user-edit"></i>
                    <a href="{{ route('post.by.user', [$post_item->user->id]) }}">
                        {{ $post_item->user->name }}
                    </a>
                </p>
                @endif
                <p>
                    <i class="fas fa-clock"></i>
                    Время чтения: {{ $post_item->time_to_read }} мин.
                </p>
                <p class="item-blog-date">{{ $post_item->date }}</p>
                <p class="item-blog-comment">
                    Комментарии: {{ $post_item->comments->count() }}
                </p>
                <div class="blog-line"></div>
                <div class="item-blog-bottom">
                    <a href="{{ route('post.show', [$post_item->slug]) }}" class="button">
                        Читать
                    </a>
                    @if ($post_item->category)
                    <p>
                        <i class="fas fa-tags"></i>
                        <a href="{{ route('post.by.category', [$post_item->category->id]) }}">
                            {{ $post_item->category->title }}
                        </a>
                    </p>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>

<section class="news-pagination">
    <div class="news-pagination-wrapper">
        {{ $posts_by_category->links() }}
    </div>
</section>

@endsection
