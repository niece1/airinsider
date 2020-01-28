<h5>Популярные новости</h5>
@foreach ($popular as $post)
<ul>
    <li>
        @if($post->photo)
        <a href="{{ route('post.show', [$post->slug]) }}">
            <img src="{{ asset('storage/'.$post->photo->path) }}" height="60" width="90" alt="Photo">
        </a>
        @endif
        <small>{{ $post->date }}</small>
        <a href="#">
            <p>{{ $post->title }}</p>
        </a>
    </li>
</ul>
@endforeach