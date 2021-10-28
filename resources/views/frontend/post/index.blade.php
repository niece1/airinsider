@extends('layouts.frontend')

@section('title', 'Airways Media - Aviation news')

@section('content')

<!-- Jumbotron section -->
<section class="jumbothron">
    @if ($featured)
    <div class="jumbothron-wrapper">
        <div class="content">            
            <h2>{{ $featured->title }}</h2>
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
                    src="data:image/gif;base64,R0lGODlhAgABAIAAAP///wAAACH5BAEAAAEALAAAAAACAAEAAAICTAoAOw=="
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
                        src="data:image/gif;base64,R0lGODlhAgABAIAAAP///wAAACH5BAEAAAEALAAAAAACAAEAAAICTAoAOw=="
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
<!-- /.Posts section -->

<!-- Pagination section -->
<section class="news-pagination">
    <div class="news-pagination-wrapper">
        {{ $posts->links('vendor.pagination.default') }}
    </div>
</section>
<!-- /.Pagination section -->

<!-- Newsletter widget -->
<section class="newsletter">
    <div class="newsletter-wrapper">
        <div class="newsletter-info">
            <h2>Stay in the know</h2>
            <p>Get updates on industry events and latest news: subscribe to our newsletters.</p>
            <p>Issued weekly.</p>
        </div>
        <div class="newsletter-widget">
            <!-- Vue component -->
            <subscription></subscription>
        </div>
    </div>
</section>
<!-- /.Newsletter widget -->

<!-- Random posts slider -->
<section class="slider">
    <h2>Read next</h2>
    <div class="contact-slider">
        <div class="contact-slider-wrapper">
            @foreach ($random_posts as $post_item)
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
                    <p class="item-blog-date">
                        {{ $post_item->date }}
                    </p>
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
