@extends('layouts.frontend')

@section('title', $post->title)

@section('content')

<section class="title-jumbotron">
    <div class="parallax-text">
        <h1>{{ $post->title }}</h1>
    </div>
</section>

<section class="news-show">
    <div class="news-show-wrapper">
        <div class="item-itself">
            @if($post->photo)
            <div class="thumbnail">
                <img class="lazyload" src="data:image/gif;base64,R0lGODlhBAADAIAAAP///wAAACH5BAEAAAEALAAAAAAEAAMAAAIDjI9WADs=" data-src="{{ asset('storage/'.$post->photo->path) }}" alt="Photo">
            </div>
            <p>{{ $post->photo_source }}</p>
            @endif
            <p>
                @if($post->updated_at){{ $post->show_page_date }}@endif
                @if($post->category)<span class="dot"></span> <a href="{{ route('category', [$post->category->id]) }}">{{ $post->category->title }}</a>@endif
                @if($post->user)<span class="dot"></span> by <a href="{{ route('user', [$post->user->id]) }}">{{ $post->user->name }}</a>@endif
            </p>
            <h1>{{ $post->title }}</h1>
            <p class="show-body">{!! clean($post->body) !!}</p>
            <div class="item-line"></div>
            <!-- Go to www.addthis.com/dashboard to customize your tools -->
            <div class="addthis_inline_share_toolbox add-this-position"></div>
            <p class="meta-right">
            <likes :default_likes="{{ $post->likes }}" :entity_id="{{ $post->id }}" :entity_owner="{{ $post->user_id }}"></likes>
            </p>
            <h4>Комментарии: {{ $post->comments->count() }}</h4>
            <!-- Comments Vue Component -->
            <comments :post="{{ $post }}"></comments>
        </div>
        @include('frontend.includes.sidebar')
        <div class="clear"></div>
    </div>
</section>

@endsection

@push('scripts')

<script type="text/javascript" src="{{ asset('js/sticky-kit.min.js') }}"></script>
<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5de3d2128881893a"></script>

@endpush