<!doctype html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name'))</title>
    <!-- Fontawesome -->
    <script src="https://kit.fontawesome.com/0f7f320048.js" crossorigin="anonymous"></script>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <header>
            <div class="menu-wrapper">
                <div class="logo">
                    <a href="{{ url('/') }}">авиа<span class="logo-span">инсайдер</span></a>
                </div>
                <nav>
                    <ul>
                        <li>
                            <a href="#">О нас</a>
                        </li>
                        <li>
                            <a href="{{ route('contact') }}">Контакты</a>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:void(0)">Категории</a>
                            <ul>
                                <li>
                                    <a class="sub-item" href="#"><span>История</span></a>
                                </li>
                                <li>
                                    <a class="sub-item" href="#"><span>Проишествия</span></a>
                                </li>
                                <li>
                                    <a class="sub-item" href="#"><span>Скидки</span></a>
                                </li>
                            </ul>
                        </li>
                        @guest
                        <li>
                            <a href="{{ route('login') }}">Войти</a>
                        </li>
                        @endguest
                        @auth
                        <li class="sub-menu">
                            <a href="javascript:void(0)">{{ Auth::user()->name }}</a>
                            <ul>
                                <li>
                                    <a href="{{ route('logout') }}" class="sub-item" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();"><span>{{ __('Logout') }}</span>
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                                <li>
                                    <a class="sub-item" href="/dashboard/posts"><span>Dashboard</span></a>
                                </li>
                            </ul>
                        </li>
                        @endauth
                        <li>
                            <a href=""><i class="fas fa-search"></i></a>
                        </li>
                    </ul>
                </nav>
                <div class="menu-toggle">
                    <div class="hamburger-menu">
                    </div>
                </div>
            </div>
        </header>

        <main>
            @yield('content')
        </main>

        <!--Footer-->
        <footer>
            <div class="footer_wrapper_upper">
                <div class="footer_about">
                    <a href="{{ url('/') }}" class="logo-footer">Авиаинсайдер</a>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nobis veniam unde tenetur ullam. Amet, reprehenderit ea nam voluptatibus quisquam harum!</p>
                    <a href="#"><span>Read more</span></a>
                </div>
                <div class="footer_links">
                    <h5>Категории</h5>
                    <ul>
                        <li><a href="index.html"><span>Проишествия</span></a></li>
                        <li><a href="about.html"><span>Скидки</span></a></li>
                        <li><a href="contact.html"><span>Эрбас</span></a></li>
                        <li><a href="albums.html"><span>Боинг</span></a></li>
                        <li><a href="blog.html"><span>Авиасалон</span></a></li>
                    </ul>
                </div>
                <div class="footer_links">
                    <h5>Меню</h5>
                    <ul>
                        <li><a href="{{ url('/') }}"><span>На главную</span></a></li>
                        <li><a href="about.html"><span>О нас</span></a></li>
                        <li><a href="{{ route('contact') }}"><span>Контакты</span></a></li>
                        <li><a href="{{ route('login') }}"><span>Войти</span></a></li>
                        <li><a href="{{ route('register') }}"><span>Регистрация</span></a></li>
                        <li><a href="blog.html"><span>Поиск</span></a></li>
                    </ul>
                </div>
                <div class="popular_posts">
                    @include('layouts.partials.popular-posts')
                </div>
            </div>
            <div class="footer_wrapper_down">
                <svg class="hidden">
                    <symbol id="icon-heart" viewBox="0 0 24 21">
                        <path d="M20.497.957A6.765 6.765 0 0 0 17.22.114a6.76 6.76 0 0 0-5.218 2.455A6.778 6.778 0 0 0 3.506.957 6.783 6.783 0 0 0 0 6.897c0 .732.12 1.434.335 2.09 1.163 5.23 11.668 11.827 11.668 11.827s10.498-6.596 11.663-11.826a6.69 6.69 0 0 0 .336-2.091 6.786 6.786 0 0 0-3.505-5.94z" />
                    </symbol>
                </svg>
                <div class="footer_copyright">
                    <p> &#169; {{ date('Y') }} Airinsider.</p>
                    <p>Noa Digital. Made with <button class="iconbutton">
                            <svg class="icon icon--heart">
                                <use xlink:href="#icon-heart"></use>
                            </svg>
                        </button>for a better web.</p>
                </div>
                <div class="footer_newsletter">
                    <h5>Newsletter Subscribe</h5>

                    <!-- Vue component -->
                    <subscription></subscription>

                    <p>Don't forget to folow me on:</p>
                    <a href="#" id="facebook">fb</a>
                    <a href="#" id="twitter">tw</a>
                    <a href="#">pt</a>
                </div>
            </div>
        </footer>
        <!--/.Footer-->
    </div>
    <!-- Scripts -->
    <script>
        window.AuthUser = '{!! auth()->user() !!}'
        window.__auth = function() {
            try {
                return JSON.parse(AuthUser)
            } catch (error) {
                return null
            }
        }
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    @stack('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.1.1/gsap.min.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
</body>

</html>