@extends('layouts.frontend')

@section('title', 'Напишите нам')

@section('content')

<section class="title-jumbotron">
    <div class="parallax-text">
        <h1>Напишите нам</h1>
    </div>
</section>

<section class="contact-page">
    <div class="contact-page-wrapper">
        <div class="contact-us">
            <h2>Не стесняйтесь...</h2>
            <p>Если Вас что-то интересует или беспокоит в пределах тематики
                сайта - смело адресуйте Ваш вопрос.
            </p>
            <h5>мы в соцсетях</h5>
            <p class="contact-social">
                <a href="#" id="facebook">fb</a>
                <a href="#" id="twitter">tw</a>
                <a href="#">pt</a>
            </p>
        </div>
        <div class="contact-form">
            <h2>Заполните форму</h2>
            @include('frontend.includes.flash')
            @if(!session()->has('success'))
            <form action="/contact" method="POST">
                <div class="contact-form-group">
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="Имя" autocomplete="name" required>
                    <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                </div>
                <div class="contact-form-group">
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="Email" autocomplete="email" required>
                    <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                </div>
                <div class="contact-form-group">
                    <textarea type="text" name="message" placeholder="Сообщение" autocomplete="message" required>
                        {{ old('message') }}
                    </textarea>
                    <div class="invalid-feedback">
                        {{ $errors->first('message') }}
                    </div>
                </div>
                <!--@captcha-->
                <button type="submit" class="button">Отправить</button>
                @csrf
            </form>
            @endif
        </div>
        <div class="right-column">
            <h2>Сотрудничество</h2>
            <p>Если Вы желаете разместить рекламу на нашем сайте или у Вас есть
                иное предложение коммерческого характера - мы также готовы обсудить
                Ваше с нами сотрудничество.
            </p>
        </div>
    </div>
</section>

<section class="slider">
    <h2>Возможно вас заинтересует</h2>
    <div class="contact-slider">
        <div class="contact-slider-wrapper">
            @foreach ($random_news as $news_item)
            <div class="item">
                @if($news_item->photo)
                <div class="image-holder">
                    <a href="{{ route('post.show', [$news_item->slug]) }}">
                        <img class="lazyload" 
                            src="data:image/gif;base64,R0lGODlhBAADAIAAAP///wAAACH5BAEAAAEALAAAAAAEAAMAAAIDjI9WADs="
                            data-src="{{ asset('storage/' . $news_item->photo->path) }}" alt="Photo">
                        <div class="image-overlay"></div>
                    </a>
                </div>
                @endif
                <div class="item-content">
                    <a href="{{ route('post.show', [$news_item->slug]) }}">
                        <h6>{{ $news_item->title }}</h6>
                    </a>
                    <p class="item-blog-text">
                        {{ $news_item->description }}{{ $news_item->three_dots }}
                    </p>
                    @if($news_item->user)
                    <p class="item-blog-author">
                        <i class="fas fa-user-edit"></i>
                        <a href="{{ route('user', [$news_item->user->id]) }}">
                            {{ $news_item->user->name }}
                        </a>
                    </p>
                    @endif
                    <p>
                        <i class="fas fa-clock"></i>
                        Время чтения: {{ $news_item->time_to_read }} мин.
                    </p>
                    <p class="item-blog-date">
                        {{ $news_item->date }}
                    </p>
                    <p class="item-blog-comment">
                        Комментарии: {{ $news_item->comments->count() }}
                    </p>
                    <div class="blog-line"></div>
                    <div class="item-blog-bottom">
                        <a href="{{ route('post.show', [$news_item->slug]) }}" class="button">
                            Читать
                        </a>
                        @if($news_item->category)
                        <p>
                            <i class="fas fa-tags"></i>
                            <a href="{{ route('category', [$news_item->category->id]) }}">
                                {{ $news_item->category->title }}
                            </a>
                        </p>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection

@push('scripts')

<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

@endpush
