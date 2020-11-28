@extends('layouts.frontend')

@section('title', 'Напишите нам')

@section('content')

<!-- Title jumbotron -->
<section class="title-jumbotron">
    <div class="parallax-text">
        <h1>Напишите нам</h1>
    </div>
</section>
<!-- /.Title jumbotron -->

<!-- Contact page -->
<section class="contact-page">
    <div class="contact-page-wrapper">
        <div class="contact-us">
            <h2>Не стесняйтесь...</h2>
            <p>
                Если Вас что-то интересует или беспокоит в пределах тематики
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
            @include('frontend.contact.includes.flash')
            @if (!session()->has('success'))
            <!-- Contact form -->
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
            <!-- /.Contact form -->
            @endif
        </div>
        <div class="right-column">
            <h2>Сотрудничество</h2>
            <p>
                Если Вы желаете разместить рекламу на нашем сайте или у Вас есть
                иное предложение коммерческого характера - мы также готовы обсудить
                Ваше с нами сотрудничество.
            </p>
        </div>
    </div>
</section>
<!-- /.Contact page -->

<!-- Random posts slider -->
<section class="slider">
    <h2>Возможно вас заинтересует</h2>
    <div class="contact-slider">
        <div class="contact-slider-wrapper">
            @foreach ($random_posts as $posts_item)
            <div class="item">
                @if ($posts_item->photo)
                <div class="image-holder">
                    <a href="{{ route('post.show', [$posts_item->slug]) }}">
                        <img class="lazyload" 
                            src="data:image/gif;base64,R0lGODlhBAADAIAAAP///wAAACH5BAEAAAEALAAAAAAEAAMAAAIDjI9WADs="
                            data-src="{{ asset('storage/' . $posts_item->photo->path) }}" alt="Photo">
                        <div class="image-overlay"></div>
                    </a>
                </div>
                @endif
                <div class="item-content">
                    <a href="{{ route('post.show', [$posts_item->slug]) }}">
                        <h6>{{ $posts_item->title }}</h6>
                    </a>
                    <p class="item-blog-text">
                        {{ $posts_item->description }}{{ $posts_item->three_dots }}
                    </p>
                    @if ($posts_item->user)
                    <p class="item-blog-author">
                        <i class="fas fa-user-edit"></i>
                        <a href="{{ route('posts.by.user', [$posts_item->user->id]) }}">
                            {{ $posts_item->user->name }}
                        </a>
                    </p>
                    @endif
                    <p>
                        <i class="fas fa-clock"></i>
                        Время чтения: {{ $posts_item->time_to_read }} мин.
                    </p>
                    <p class="item-blog-date">
                        {{ $posts_item->date }}
                    </p>
                    <p class="item-blog-comment">
                        Комментарии: {{ $posts_item->comments->count() }}
                    </p>
                    <div class="blog-line"></div>
                    <div class="item-blog-bottom">
                        <a href="{{ route('post.show', [$posts_item->slug]) }}" class="button">
                            Читать
                        </a>
                        @if ($posts_item->category)
                        <p>
                            <i class="fas fa-tags"></i>
                            <a href="{{ route('posts.by.category', [$posts_item->category->id]) }}">
                                {{ $posts_item->category->title }}
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
<!-- /.Random posts slider -->

@endsection

@push('scripts')

<!-- Scripts -->
<script src="{{ asset('js/slick.min.js') }}"></script>
<script src="{{ asset('js/slick_users.js') }}"></script>
<!-- /.Scripts -->

@endpush
