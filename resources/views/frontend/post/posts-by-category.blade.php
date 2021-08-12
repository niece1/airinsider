@extends('layouts.frontend')

@section('title', $chosen_category->title)

@section('content')

<!-- Title jumbotron -->
<section class="title-jumbotron">
    <div class="parallax-text">
        <h1>{{ $chosen_category->title }}</h1>
    </div>
</section>
<!-- /.Title jumbotron -->

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
                    <a href="{{ $post_item->user->slug }}">
                        {{ $post_item->user->name }}
                    </a>
                </p>
                @endif
                <p>
                    <i class="fas fa-clock"></i>
                    {{ $post_item->time_to_read }} minutes to read
                </p>
                <p class="item-blog-date">{{ $post_item->date }}</p>
                <div class="blog-line"></div>
                <div class="item-blog-bottom">
                    <a href="{{ route('post.show', [$post_item->slug]) }}" class="button">
                        Read more
                    </a>
                    @if ($post_item->category)
                    <p>
                        <i class="fas fa-tags"></i>
                        <a href="{{ $post_item->category->slug }}">
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
<!-- /.Posts by category section -->

<!-- Pagination -->
<section class="news-pagination">
    <div class="news-pagination-wrapper">
        {{ $posts_by_category->links('vendor.pagination.default') }}
    </div>
</section>
<!-- /.Pagination -->

@endsection
