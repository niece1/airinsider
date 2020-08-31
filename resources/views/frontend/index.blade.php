@extends('layouts.frontend')

@section('content')

<!-- Jumbotron section -->
<section class="jumbothron">
    @if($featured)
    <div class="jumbothron-wrapper">        
        <div class="content">            
            <h1>{{ $featured->title }}</h1>
            <p>
                {{ $featured->featured_description }}{{ $featured->featured_three_dots }}
            </p>
            <a href="{{ route('post.show', [$featured->slug]) }}" class="button">
                Читать
            </a>            
        </div>
        @if($featured->photo)
        <div class="photo">
            <img class="lazyload" 
                src="data:image/gif;base64,R0lGODlhBAADAIAAAP///wAAACH5BAEAAAEALAAAAAAEAAMAAAIDjI9WADs="
                data-src="{{ asset('storage/' . $featured->photo->path) }}" alt="News">
        </div>
        @endif        
    </div>
    @endif
</section>

<!-- News section -->
<section class="news">
    <h1>Последние новости</h1>
    <div class="news-wrapper">
        @forelse ($news as $news_item)
        <div class="item">
            @if($news_item->photo)
            <div class="image-holder">
                <a href="{{ route('post.show', [$news_item->slug]) }}">
                    <img class="lazyload"
                        src="data:image/gif;base64,R0lGODlhBAADAIAAAP///wAAACH5BAEAAAEALAAAAAAEAAMAAAIDjI9WADs="
                        data-src="{{ asset('storage/' . $news_item->photo->path) }}" alt="Photo">
                    <div class="image-overlay"></div>
                </a>
            </div>
            @endif
            <div class="item-content">
                <a href="{{ route('post.show', [$news_item->slug]) }}">
                    <h6>{{ $news_item->title }}</h6>
                </a>
                <p class="item-blog-text">
                    {{ $news_item->description }}{{ $news_item->three_dots }}
                </p>
                @if($news_item->user)
                <p class="item-blog-author">
                    <i class="fas fa-user-edit"></i>
                    <a href="{{ route('user', [$news_item->user->id]) }}">
                        {{ $news_item->user->name }}
                    </a>
                </p>
                @endif
                <p>
                    <i class="fas fa-clock"></i>
                    Время чтения: {{ $news_item->time_to_read }} мин.
                </p>
                <p class="item-blog-comment">
                    Комментарии: {{ $news_item->comments->count() }}
                </p>
                <p class="item-blog-date">{{ $news_item->date }}</p>                
                <div class="blog-line">
                </div>
                <div class="item-blog-bottom">
                    <a href="{{ route('post.show', [$news_item->slug]) }}" class="button">
                        Читать
                    </a>
                    @if($news_item->category)
                    <p>
                        <i class="fas fa-tags"></i>
                        <a href="{{ route('category', [$news_item->category->id]) }}">
                            {{ $news_item->category->title }}
                        </a>
                    </p>
                    @endif
                </div>
            </div>
        </div>
        @empty
        <h1>Временно недоступны</h1>
        @endforelse
    </div>
</section>

<!-- Pagination section -->
<section class="news-pagination">
    <div class="news-pagination-wrapper">
        {{ $news->links() }}
    </div>
</section>

@endsection
