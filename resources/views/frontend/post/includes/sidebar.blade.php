<aside class="sidebar">
    <!-- Related posts -->
    <div class="related-posts-widget">
        @if (count($related))
        <h4>Read next</h4>
        @foreach ($related as $post)
        <ul class="related">
            <li>
                @if ($post->photo)
                <div class="image-holder">
                    <a href="{{ route('post.show', [$post->slug]) }}">
                        <img class="lazyload"
                            src="data:image/gif;base64,R0lGODlhAgABAIAAAP///wAAACH5BAEAAAEALAAAAAACAAEAAAICTAoAOw=="
                            data-src="{{ Storage::url($post->photo->path) }}" alt="{{ $post->title }}">
                        <div class="image-overlay"></div>
                    </a>
                </div>
                @endif
                <div class="post-content">
                    <a href="{{ route('post.show', [$post->slug]) }}" title="{{ $post->title }}">
                        <h5>{{ $post->title }}</h5>
                    </a>
                    <small>{{ $post->date }}</small>
                </div>
            </li>
        </ul>
        @endforeach
        @else
        <h4>Related coming soon...</h4>
        @endif
    </div>
    <!-- /.Related posts -->
    
    <!-- Tag widget -->
    <div class="tag-widget">
        <h4>Read by tags</h4>
        <div class="tag-cloud">
            @foreach ($tags as $tag)
            <a href="{{ $tag->slug }}">#{{ lcfirst($tag->title) }}</a>
            @endforeach
        </div>
    </div>
    <!-- /.Tag widget -->
</aside>
