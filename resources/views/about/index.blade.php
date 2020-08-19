@extends('layouts.frontend')

@section('title', 'О нас')

@section('content')

<section class="title-jumbotron">
    <div class="parallax-text">
        <h1>О нас</h1>
    </div>
</section>

<section class="about-page">
    <div class="about-page-wrapper">
        <div class="thumbnail">
            <img class="lazyload"
                 src="data:image/gif;base64,R0lGODlhBQABAIAAAP///wAAACH5BAEAAAEALAAAAAAFAAEAAAICjF0AOw=="
                 data-src="{{ asset('images/takeoff.jpg') }}" alt="Photo">
        </div>
        <div class="about-content">
            <h3>Авиаинсайдер - авиационный новостной портал, освещающий
                события в мире гражданской авиации.</h3>
            <p>На страницах нашего сайта вы найдете новости основных производителей
                авиационной техники, анализ рынка отрасли, авиапроисшествия,
                а также скидки и акционные предложения авиакомпаний. Веб приложение
                имеет удобный пользовательский интерфейс, а информация всегда
                подана в доступной форме.
            </p>
        </div>
        <div class="thumbnail">
            <img class="lazyload"
                 src="data:image/gif;base64,R0lGODlhBQABAIAAAP///wAAACH5BAEAAAEALAAAAAAFAAEAAAICjF0AOw=="
                 data-src="{{ asset('images/schedule.jpg') }}" alt="Photo">
        </div>
        <div class="about-content">
            <h3>Стать автором публикаций.</h3>
            <p>Если вы хотите стать одним из авторов Авиаинсайдера - отправьте
                соответствующий запрос на странице <a href="{{ route('contact') }}">Контакты</a>. 
                Также на нашем сайте доступен API, предоставляющий информацию о 
                новостях приложения.
            </p>
        </div>
    </div>
</section>

@endsection