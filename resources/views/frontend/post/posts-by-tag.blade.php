@extends('layouts.frontend')

@section('title', $chosen_tag->title)

@section('content')

<!-- Title jumbotron -->
<section class="title-jumbotron">
    <div class="parallax-text">
        <h1>{{ $chosen_tag->title }}</h1>
    </div>
</section>
<!-- /.Title jumbotron -->

<!-- Posts by tag section -->
<section class="news">
    <div class="news-wrapper">
        @forelse ($posts_by_tag as $post_item)
        <div class="item">
            @if ($post_item->photo)
            <div class="image-holder">
                <a href="{{ route('post.show', [$post_item->slug]) }}">
                    <img class="lazyload" 
                        src="data:image/gif;base64,R0lGODlhAgABAIAAAP///wAAACH5BAEAAAEALAAAAAACAAEAAAICTAoAOw=="
                        data-src="{{ asset('storage/' . $post_item->photo->path) }}" alt="Photo">
                    <div class="image-overlay"></div>
                </a>
            </div>
            @endif
            <div class="item-content">
                <a href="{{ route('post.show', [$post_item->slug]) }}">
                    <h2>{{ $post_item->title }}</h2>
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
                <div class="blog-line">
                </div>
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
        @empty
        <h3>Temporarily unavailable</h3>
        @endforelse
    </div>
</section>
<!-- /.Posts by tag section -->

<!-- Pagination -->
<section class="news-pagination">
    <div class="news-pagination-wrapper">
        {{ $posts_by_tag->links('vendor.pagination.default') }}
    </div>
</section>
<!-- /.Pagination -->

@endsection
