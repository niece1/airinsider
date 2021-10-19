<aside class="sidebar">
    <!-- Related posts -->
    <div class="related-posts-widget">
        <h4>Read next</h4>
        @foreach ($related as $post)
        <ul class="related">
            <li>
                @if ($post->photo)
                <div class="image-holder">
                    <a href="{{ route('post.show', [$post->slug]) }}">
                        <img class="lazyload"
                            src="data:image/gif;base64,R0lGODlhAwACAIAAAP///wAAACH5BAEAAAEALAAAAAADAAIAAAICjF8AOw=="
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
        <h4>Read by tags</h4>
        <div class="tag-cloud">
            @foreach ($tags as $tag)
            <a href="{{ $tag->slug }}">{{ $tag->title }}</a>
            @endforeach
        </div>
    </div>
    <!-- /.Tag widget -->
    
    <!-- Category widget -->
    <div class="category-widget">
        <h4>Subjects</h4>
        @foreach ($categories as $category)
        <ul class="category-list">
            <li>
                <a href="{{ $category->slug }}">
                    {{ $category->title }}
                </a>
            </li>
        </ul>
        @endforeach
    </div>
    <!-- /.Category widget -->
</aside>
