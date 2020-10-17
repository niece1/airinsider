<h5>Популярные новости</h5>
@foreach ($popular_posts as $post_item)
<ul>
    <li>
        @if ($post_item->photo)
        <div class="image-holder">
            <a href="{{ route('post.show', [$post_item->slug]) }}">
                <img class="lazyload"
                    src="data:image/gif;base64,R0lGODlhBAADAIAAAP///wAAACH5BAEAAAEALAAAAAAEAAMAAAIDjI9WADs=" 
                    data-src="{{ asset('storage/'.$post_item->photo->path) }}" 
                    width="92" height="69" alt="Photo">
            </a>
        </div>
        @endif
        <small>{{ $post_item->date }}</small>
        <a href="{{ route('post.show', [$post_item->slug]) }}" class="popular-link-title">
            <p>{{ $post_item->title }}</p>
        </a>
    </li>
</ul>
@endforeach
