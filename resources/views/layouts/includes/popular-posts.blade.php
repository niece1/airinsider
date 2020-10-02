<h5>Популярные новости</h5>
@foreach ($popular_post as $post)
<ul>
    <li>
        @if ($post->photo)
        <div class="image-holder">
            <a href="{{ route('post.show', [$post->slug]) }}">
                <img class="lazyload"
                    src="data:image/gif;base64,R0lGODlhBAADAIAAAP///wAAACH5BAEAAAEALAAAAAAEAAMAAAIDjI9WADs=" 
                    data-src="{{ asset('storage/'.$post->photo->path) }}" 
                    width="92" height="69" alt="Photo">
            </a>
        </div>
        @endif
        <small>{{ $post->date }}</small>
        <a href="{{ route('post.show', [$post->slug]) }}" class="popular-link-title">
            <p>{{ $post->title }}</p>
        </a>
    </li>
</ul>
@endforeach
