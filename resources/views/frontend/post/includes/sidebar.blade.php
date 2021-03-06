<aside class="sidebar">
    <!-- Related posts -->
    <div class="related-posts-widget">
        <h2>Похожие статьи</h2>
        @foreach ($related as $post)
        <ul class="related">
            <li>
                @if ($post->photo)
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
    <!-- /.Related posts -->
    
    <!-- Tag widget -->
    <div class="tag-widget">
        <h2>Наши тэги</h2>
        <div class="tag-cloud">
            @foreach ($tags as $tag)
            <a href="{{ route('posts.by.tag', [$tag->id]) }}">{{ $tag->title }}</a>
            @endforeach
        </div>
    </div>
    <!-- /.Tag widget -->
    
    <!-- Category widget -->
    <div class="category-widget">
        <h2>Категории</h2>
        @foreach ($categories as $category)
        <ul class="category-list">
            <li>
                <a href="{{ route('posts.by.category', [$category->id]) }}">
                    {{ $category->title }}
                </a>
            </li>
        </ul>
        @endforeach
    </div>
    <!-- /.Category widget -->
</aside>
