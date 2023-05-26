@component('mail::message')

# Hello! Now, let's get to this week issue!

@foreach ($posts as $post_item)
<ul>
    <li class="item-holder">
        <a href="{{ route('post.show', [$post_item->slug]) }}">
            <img src="{{ Storage::url($post_item->photo->path) }}" alt="{{ $post_item->title }}">
            <h3>{{ $post_item->title }}</h3>
        </a>
    </li>
</ul>
@endforeach

<div class="regards">
Regards,<br>
{{ config('app.name') }} team
</div>

<a href="{{ route('subscription.destroy', ['remember_token' => $subscription->remember_token]) }}">
<small>Unsubscribe</small>
</a>

@endcomponent
