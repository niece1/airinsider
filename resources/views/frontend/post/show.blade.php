@extends('layouts.frontend')

@section('title', $post->title)

@section('meta', $post->description)

@section('content')

<!-- Title jumbotron -->
<section class="title-jumbotron">
    <div class="parallax-text">
        <div class="heading">Read more</div>
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
                    src="data:image/gif;base64,R0lGODlhAgABAIAAAP///wAAACH5BAEAAAEALAAAAAACAAEAAAICTAoAOw=="
                    data-src="{{ asset('storage/' . $post->photo->path) }}" alt="Photo">
            </div>
            @if ($post->photo_source)
            <p class="photo-source">{{ $post->photo_source }}</p>
            @endif
            @endif
            <p class="meta">
                @if ($post->category)
                <a href="{{ $post->category->slug }}" class="show-category">
                    {{ $post->category->title }}
                </a>
                @endif
                {{ $post->publish_date_time }}
                @if ($post->user)
                <a href="{{ $post->user->slug }}" class="show-author">
                    {{ $post->user->name }}
                </a>
                @endif
            </p>
            <h1>{{ $post->title }}</h1>
            <p>{{ $post->description }}</p>
            {!! clean($post->body) !!}
            <div class="item-line"></div>
            <!-- Go to www.addthis.com/dashboard to customize your tools -->
            <div class="addthis_inline_share_toolbox add-this-position"></div>
            <p class="meta-right">
            <!-- Likes Vue Component -->
            <likes :default_likes="{{ $post->likes }}" :entity_id="{{ $post->id }}" 
                   :entity_owner="{{ $post->user_id }}">
            </likes>
            </p>
            <h4>Comments: {{ $post->comments->count() }}</h4>
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
<script type="text/javascript" src="{{ asset('js/sticky-kit.min.js') }}" defer></script>
<script type="text/javascript" src="{{ asset('js/sticky-kit_users.js') }}" defer></script>
<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5de3d2128881893a"></script>
<!-- /.Scripts -->

@endpush
