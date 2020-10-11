@component('mail::message')
# Авиаинсайдер

Приветствуем!
Как всегда в четверг подборка новостей из мира гражданской авиации.
Приятного просмотра!

@foreach ($posts as $post_item)
<a href="{{ route('post.show', [$post_item->slug]) }}">
<h2>{{ $post_item->title }}</h2>
</a>
@endforeach

С уважением,<br>
{{ config('app.name') }}
@endcomponent
