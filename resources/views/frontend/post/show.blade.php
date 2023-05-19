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
                    data-src="{{ Storage::url($post->photo->path) }}" alt="{{ $post->title }}">
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
                <a href="{{ $post->user->slug }}" class="show-author" title="Posts by {{ $post->user->name }}">
                    {{ $post->user->name }}
                </a>
                @endif
            </p>
            <h1>{{ $post->title }}</h1>
            <p>{{ $post->description }}</p>
            {!! clean($post->body) !!}
            <div class="item-line"></div>
            <div class="meta-bottom">
                <div class="post-tags">
                    @foreach ($post->tags as $tag)
                    <a href="{{ $tag->slug }}" class="button">#{{ lcfirst($tag->title) }}</a>
                    @endforeach
                </div>
                <div class="votes">
                    <!-- Likes Vue Component -->
                    <likes :default_likes="{{ $post->likes }}" :entity_id="{{ $post->id }}" 
                           :entity_owner="{{ $post->user_id }}">
                    </likes>
                </div>
            </div>
            @guest
            <a href="{{ route('login') }}" class="auth-condition">Sign in to comment</a>
            @endguest
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
<!-- /.Scripts -->

@endpush
