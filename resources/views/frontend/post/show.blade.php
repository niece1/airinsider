@extends('layouts.frontend')

@section('title', $post->title)

@section('content')

<!-- Title jumbotron -->
<section class="title-jumbotron">
    <div class="parallax-text">
        <h1>{{ $post->title }}</h1>
    </div>
</section>
<!-- /.Title jumbotron -->

<!-- Show post page -->
<section class="news-show">
    <div class="news-show-wrapper">
        <div class="item-itself">
            @if ($post->photo)
            <div class="thumbnail">
                <img class="lazyload"
                    src="data:image/gif;base64,R0lGODlhBAADAIAAAP///wAAACH5BAEAAAEALAAAAAAEAAMAAAIDjI9WADs="
                    data-src="{{ asset('storage/' . $post->photo->path) }}" alt="Photo">
            </div>
            @if ($post->photo_source)
            <p class="photo-source">{{ $post->photo_source }}</p>
            @endif
            @endif
            <p class="meta">
                @if ($post->category)
                <a href="{{ route('posts.by.category', [$post->category->id]) }}" class="show-category">
                    {{ $post->category->title }}
                </a>
                @endif
                @if ($post->updated_at)
                {{ $post->show_page_date }} /
                @endif
                @if ($post->updated_at)
                {{ $post->show_page_time }} /
                @endif
                @if ($post->user)
                <a href="{{ route('posts.by.user', [$post->user->id]) }}" class="show-author">
                    {{ $post->user->name }}
                </a>
                @endif
            </p>
            <h1>{{ $post->title }}</h1>
            <p class="show-body">{!! clean($post->body) !!}</p>
            <div class="item-line"></div>
            <!-- Go to www.addthis.com/dashboard to customize your tools -->
            <div class="addthis_inline_share_toolbox add-this-position"></div>
            <p class="meta-right">
            <!-- Likes Vue Component -->
            <likes :default_likes="{{ $post->likes }}" :entity_id="{{ $post->id }}" 
                   :entity_owner="{{ $post->user_id }}">
            </likes>
            </p>
            <h4>Комментарии: {{ $post->comments->count() }}</h4>
            <!-- Comments Vue Component -->
            <comments :post="{{ $post }}"></comments>
        </div>
        <!-- Sidebar -->
        @include('frontend.post.includes.sidebar')
        <!-- /.Sidebar -->
        <div class="clear"></div>
    </div>
</section>
<!-- /.Show post page -->

@endsection

@push('scripts')

<!-- Scripts -->
<script type="text/javascript" src="{{ asset('js/sticky-kit.min.js') }}"></script>
<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5de3d2128881893a"></script>
<!-- /.Scripts -->

@endpush
