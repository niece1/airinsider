@extends('layouts.frontend')

@section('title', 'Aviation closeup')

@section('content')

<!-- Jumbotron section -->
<section class="jumbothron">
    @if ($featured)
    <div class="jumbothron-wrapper">        
        <div class="content">            
            <h1>{{ $featured->title }}</h1>
            <p>
                {{ $featured->featured_description }}{{ $featured->featured_three_dots }}
            </p>
            <a href="{{ route('post.show', [$featured->slug]) }}" class="button">
                Read more
            </a>            
        </div>
        @if ($featured->photo)
        <div class="photo">
            <a href="{{ route('post.show', [$featured->slug]) }}">
                <img class="lazyload" 
                    src="data:image/gif;base64,R0lGODlhBAADAIAAAP///wAAACH5BAEAAAEALAAAAAAEAAMAAAIDjI9WADs="
                    data-src="{{ asset('storage/' . $featured->photo->path) }}" alt="News">
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
                    <a href="{{ route('posts.by.user', [$post_item->user->id]) }}">
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
                        <a href="{{ route('posts.by.category', [$post_item->category->id]) }}">
                            {{ $post_item->category->title }}
                        </a>
                    </p>
                    @endif
                </div>
            </div>
        </div>
        @empty
        <h1>Temporarily unavailable</h1>
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

<!-- Random posts slider -->
<section class="slider">
    <h2>Read next</h2>
    <div class="contact-slider">
        <div class="contact-slider-wrapper">
            @foreach ($random_posts as $posts_item)
            <div class="item">
                @if ($posts_item->photo)
                <div class="image-holder">
                    <a href="{{ route('post.show', [$posts_item->slug]) }}">
                        <img class="lazyload" 
                            src="data:image/gif;base64,R0lGODlhBAADAIAAAP///wAAACH5BAEAAAEALAAAAAAEAAMAAAIDjI9WADs="
                            data-src="{{ asset('storage/' . $posts_item->photo->path) }}" alt="Photo">
                        <div class="image-overlay"></div>
                    </a>
                </div>
                @endif
                <div class="item-content">
                    <a href="{{ route('post.show', [$posts_item->slug]) }}">
                        <h6>{{ $posts_item->title }}</h6>
                    </a>
                    <p class="item-blog-text">
                        {{ $posts_item->description }}{{ $posts_item->three_dots }}
                    </p>
                    @if ($posts_item->user)
                    <p class="item-blog-author">
                        <i class="fas fa-user-edit"></i>
                        <a href="{{ route('posts.by.user', [$posts_item->user->id]) }}">
                            {{ $posts_item->user->name }}
                        </a>
                    </p>
                    @endif
                    <p>
                        <i class="fas fa-clock"></i>
                        {{ $posts_item->time_to_read }} minutes to read
                    </p>
                    <p class="item-blog-date">
                        {{ $posts_item->date }}
                    </p>
                    <div class="blog-line"></div>
                    <div class="item-blog-bottom">
                        <a href="{{ route('post.show', [$posts_item->slug]) }}" class="button">
                            Read more
                        </a>
                        @if ($posts_item->category)
                        <p>
                            <i class="fas fa-tags"></i>
                            <a href="{{ route('posts.by.category', [$posts_item->category->id]) }}">
                                {{ $posts_item->category->title }}
                            </a>
                        </p>
                        @endif
                    </div>
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
