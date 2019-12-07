<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Airinsider') }}</title>

    <!-- Fontawesome -->      
    <script src="https://kit.fontawesome.com/0f7f320048.js" crossorigin="anonymous"></script>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
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
                            <a href="#">Категории</a>
                            <ul>
                                <li>
                                    <a class="sub-item" href="#">История</a>
                                </li>
                                <li>
                                    <a class="sub-item" href="#">Проишествия</a>
                                </li>
                                <li>
                                    <a class="sub-item" href="#">Скидки</a>
                                </li>
                            </ul>
                        </li>
                        @guest
                        <li>
                            <a href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @endguest
                        @auth
                        <li class="sub-menu">
                            <a href="#">{{ Auth::user()->name }}</a>
                            <ul>
                                <li>
                                    <a href="{{ route('logout') }}" class="sub-item" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                            <li>
                                <a class="sub-item" href="/dashboard/posts">Dashboard</a>
                            </li>
                        </ul>
                    </li>
                    @endauth
                </ul>

            </nav>

            <div class="menu-toggle">
                <div class="hamburger-menu">

                </div>

            </div>

        </div>
    </header>
        <!--<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
        <!-- <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
        <!--<ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
        <!--   @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>-->

        <main>
            @yield('content')
        </main>

        <!--Footer-->

        <footer>
            <div class="footer_wrapper_upper">
                <div class="footer_about">
                    <a href="#" class="logo-footer">Авиаинсайдер</a>
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
                    <h5>Полезные ссылки</h5>
                    <ul>
                        <li><a href="index.html"><span>На главную</span></a></li>
                        <li><a href="about.html"><span>О нас</span></a></li>
                        <li><a href="contact.html"><span>Контакты</span></a></li>
                        <li><a href="albums.html"><span>Войти</span></a></li>
                        <li><a href="blog.html"><span>Зарегистрироваться</span></a></li>

                    </ul>
                </div>

                <div class="popular_posts">
                    <h5>Популярные новости</h5>
                    <ul>
                        <li>
                            <a href="#">
                                <img src="{{ asset('images/qatar.jpg') }}" height="60" width="90" alt="Photo">
                            </a>
                            <a href="#"><small>14 May, 2014</small></a>
                            <a href="#">
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Illum.</p>
                            </a>
                        </li>

                        <li>
                            <a href="#">
                                <img src="{{ asset('images/qatar.jpg') }}" height="60" width="90" alt="Photo">
                            </a>
                            <a href="#"><small>14 May, 2014</small></a>
                            <a href="#">
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Illum.</p>
                            </a>
                        </li>

                        <li>
                            <a href="#">
                                <img src="{{ asset('images/qatar.jpg') }}" height="60" width="90" alt="Photo">
                            </a>
                            <a href="#"><small>14 May, 2014</small></a>
                            <a href="#">
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Illum.</p>
                            </a>
                        </li>
                    </ul>



                </div>
            </div>

            <div class="footer_wrapper_down">
                <div class="footer_copyright">


                    <p> &#169; Copyright 2019 Airinsider. All rights reserved.</p>
                    <p>Made with love fore a better web.</p>
                </div>

                <div class="footer_newsletter">
                    <h5>Newsletter Subscribe</h5>
                    <form class="input-wrapper" data-text="">
                        <input id="newsletter" type="email" placeholder="Get newsletter">
                        <button type="submit"><i class="fa fa-envelope-o"></i></button>
                    </form>
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
        window.__auth = function () {
            try {
                return JSON.parse(AuthUser)
            } catch (error) {
                return null
            }
        } 
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    @stack('scripts')
    <script src="{{ asset('js/app.js') }}" defer></script>   
</body>
</html>