<aside class="sidebar">
    <div class="related-posts-widget">
        <h2>Related posts</h2>
        @foreach ($related as $post)
        <ul class="related">
            <li>
                @if($post->photo)
                <div class="image-holder">
                    <a href="{{ route('post.show', [$post->slug]) }}">
                        <img class="lazyload"
                            src="data:image/gif;base64,R0lGODlhBAADAIAAAP///wAAACH5BAEAAAEALAAAAAAEAAMAAAIDjI9WADs=" 
                            data-src="{{ asset('storage/' . $post->photo->path) }}" alt="Photo">
                    </a>
                </div>
                @endif
                <div class="post-content">
                    <p>
                        <a href="{{ route('post.show', [$post->slug]) }}">
                            {{ $post->title }}
                        </a>
                    </p>
                    <small>{{ $post->date }}</small>
                </div>
            </li>
        </ul>
        @endforeach
    </div>
    <div class="tag-widget">
        <h2>Our tags</h2>
        <div class="tag-cloud">
            @foreach ($tags as $tag)
            <a href="{{ route('tag', [$tag->id]) }}">{{ $tag->title }}</a>
            @endforeach
        </div>
    </div>
    <div class="category-widget">
        <h2>Categories</h2>
        @foreach ($categories as $category)
        <ul class="category-list">
            <li>
                <a href="{{ route('category', [$category->id]) }}">
                    {{ $category->title }}
                </a>
            </li>
        </ul>
        @endforeach
    </div>
</aside>
