@extends('layouts.frontend')

@section('title', 'Airways Media - Aviation news')

@section('meta', 'An authoritative source of aviation news and international travel affairs from the experts')

@section('content')

<!-- Jumbotron section -->
<section class="jumbothron">
    @if ($featured)
    <div class="jumbothron-wrapper">
        <div class="content">
            <a href="{{ route('post.show', [$featured->slug]) }}" title="{{ $featured->title }}">
                <h2>{{ $featured->title }}</h2>
            </a>
            <p>
                {{ $featured->featured_excerpt }}{{ $featured->featured_three_dots }}
            </p>
            <a href="{{ route('post.show', [$featured->slug]) }}" class="button">
                Read more
            </a>            
        </div>
        @if ($featured->photo)
        <div class="image-holder">
            <a href="{{ route('post.show', [$featured->slug]) }}">
                <img class="lazyload" 
                    src="data:image/gif;base64,R0lGODlhAgABAIAAAP///wAAACH5BAEAAAEALAAAAAACAAEAAAICTAoAOw=="
                    data-src="{{ Storage::url($featured->photo->path) }}" alt="{{ $featured->title }}">
                <div class="image-overlay"></div>
            </a>
        </div>
        @endif        
    </div>
    @endif
</section>
<!-- /.Jumbotron section -->

<!-- Posts section -->
<section class="news">
    <h1>Latest news</h1>
    <div class="news-wrapper">
        @forelse ($posts as $post_item)
        <div class="item">
            @if ($post_item->photo)
            <div class="image-holder">
                <a href="{{ route('post.show', [$post_item->slug]) }}">
                    <img class="lazyload"
                        src="data:image/gif;base64,R0lGODlhAgABAIAAAP///wAAACH5BAEAAAEALAAAAAACAAEAAAICTAoAOw=="
                        data-src="{{ Storage::url($post_item->photo->path) }}" alt="{{ $post_item->title }}">
                    <div class="image-overlay"></div>
                </a>
            </div>
            @endif
            <div class="item-content">
                <a href="{{ route('post.show', [$post_item->slug]) }}" title="{{ $post_item->title }}">
                    <h2>{{ $post_item->title }}</h2>
                </a>
                <p class="item-blog-text">
                    {{ $post_item->excerpt }}{{ $post_item->three_dots }}
                </p>
                @if ($post_item->user)
                <div class="item-blog-author">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon-user"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8
                            0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    <a href="{{ $post_item->user->slug }}" title="Posts by {{ $post_item->user->name }}">
                        {{ $post_item->user->name }}
                    </a>
                </div>
                @endif
                <div class="item-blog-time-to-read">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon-clock"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9
                            9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    {{ $post_item->time_to_read }} minutes to read
                </div>
                @if ($post_item->category)
                <div class="item-blog-tag">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon-category"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512
                            0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994
                            1.994 0 013 12V7a4 4 0 014-4z" />
                    </svg>
                    <a href="{{ $post_item->category->slug }}">
                            {{ $post_item->category->title }}
                    </a>
                </div>
                @endif
                <p class="item-blog-date">{{ $post_item->date }}</p>
            </div>
        </div>
        @empty
        <h3>Temporarily unavailable</h3>
        @endforelse
    </div>
</section>
<!-- /.Posts section -->

<!-- Pagination section -->
<section class="news-pagination">
    <div class="news-pagination-wrapper">
        {{ $posts->links('vendor.pagination.default') }}
    </div>
</section>
<!-- /.Pagination section -->

<!-- Subscription livewire component widget -->
<livewire:subscription />
<!-- /.Subscription livewire component widget -->

<!-- Random posts slider -->
<section class="slider">
    <h3>Read next</h3>
    <div class="contact-slider">
        <div class="contact-slider-wrapper">
            @foreach ($random_posts as $post_item)
            <div class="item">
                @if ($post_item->photo)
                <div class="image-holder">
                    <a href="{{ route('post.show', [$post_item->slug]) }}">
                        <img class="lazyload" 
                            src="data:image/gif;base64,R0lGODlhAgABAIAAAP///wAAACH5BAEAAAEALAAAAAACAAEAAAICTAoAOw=="
                            data-src="{{ Storage::url($post_item->photo->path) }}" alt="{{ $post_item->title }}">
                        <div class="image-overlay"></div>
                    </a>
                </div>
                @endif
                <div class="item-content">
                    <a href="{{ route('post.show', [$post_item->slug]) }}" title="{{ $post_item->title }}">
                        <h2>{{ $post_item->title }}</h2>
                    </a>
                    <p class="item-blog-text">
                        {{ $post_item->excerpt }}{{ $post_item->three_dots }}
                    </p>
                    @if ($post_item->user)
                    <div class="item-blog-author">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon-user"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8
                                0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <a href="{{ $post_item->user->slug }}" title="Posts by {{ $post_item->user->name }}">
                            {{ $post_item->user->name }}
                        </a>
                    </div>
                    @endif
                    <div class="item-blog-time-to-read">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon-clock"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9
                                9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        {{ $post_item->time_to_read }} minutes to read
                    </div>
                    @if ($post_item->category)
                    <div class="item-blog-tag">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon-category"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512
                                0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994
                                1.994 0 013 12V7a4 4 0 014-4z" />
                        </svg>
                        <a href="{{ $post_item->category->slug }}">
                            {{ $post_item->category->title }}
                        </a>
                    </div>
                    @endif
                    <p class="item-blog-date">{{ $post_item->date }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- /.Random posts slider -->

@endsection

@push('scripts')

<!-- Scripts -->
<script src="{{ asset('js/slick.min.js') }}"></script>
<script src="{{ asset('js/slick_users.js') }}"></script>
<!-- /.Scripts -->

@endpush
