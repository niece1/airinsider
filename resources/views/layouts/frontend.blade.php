<!doctype html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    
    <!-- Head -->
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title', config('app.name'))</title>
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>   
    <!-- /.Head -->
    
    <!-- Body -->
    <body>
        @include('cookie-consent::index')
        
        <!-- App -->
        <div id="app">
            
            <!-- Header -->
            <header>
                <div class="menu-wrapper">
                    <div class="logo">
                        <a href="{{ url('/') }}">
                            aviation<span class="logo-span">closeup</span>
                        </a>
                    </div>
                    <!-- Navigation -->
                    <nav>
                        <ul>
                            <li>
                                <a href="{{ route('about') }}">About</a>
                            </li>
                            <li>
                                <a href="{{ route('contact') }}">Contacts</a>
                            </li>
                            <li class="sub-menu">
                                <a href="javascript:void(0)">Categories</a>
                                <ul>
                                    <li>
                                        <a href="#" class="sub-item">
                                            <span>History</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#"  class="sub-item">
                                            <span>Accidents</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#"  class="sub-item">
                                            <span>Discounts</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            @guest
                            <li>
                                <a href="{{ route('login') }}">Sign in</a>
                            </li>
                            @endguest
                            @auth
                            <li class="sub-menu">
                                <a href="javascript:void(0)">{{ Auth::user()->name }}</a>
                                <ul>
                                    <li>
                                        <a href="{{ route('logout') }}" class="sub-item" onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                            <span>Logout</span>
                                        </a>
                                        <form action="{{ route('logout') }}" method="POST" id="logout-form" style="display: none;">
                                            @csrf
                                        </form>
                                    </li>
                                    @can('dashboard_access')
                                    <li>
                                        <a href="/dashboard/posts" class="sub-item">
                                            <span>Dashboard</span>
                                        </a>
                                    </li>
                                    @endcan
                                </ul>
                            </li>
                            @endauth
                            <li>
                                <a href="javascript:void(0)" id="search">
                                    <i class="fas fa-search"></i>
                                </a>
                            </li>
                        </ul>
                    </nav>
                    <!-- /.Navigation -->
                    <div class="menu-toggle">
                        <div class="hamburger-menu">
                        </div>
                    </div>
                </div>
                <!-- Search overlay -->
                <div class="search-overlay">
                    <span class="close-search">&times;</span>
                    <form action="{{ route('search.index') }}" method="GET" class="search-input" autocomplete="off">
                        @include('layouts.includes.fullscreen-search')
                    </form>
                </div>
                <!-- /.Search overlay -->
            </header>
            <!-- /.Header -->
            
             <!-- Main -->
            <main>
                @yield('content')
            </main>
             <!-- /.Main -->

            <!--Footer-->
            <footer>
                <div class="footer_wrapper_upper">
                    <div class="footer_about">
                        <a href="{{ url('/') }}" class="logo-footer">Авиаинсайдер</a>
                        <p>Авиационный новостной портал, освещающий 
                            события в мире гражданской авиации.
                        </p>
                        <a href="{{ route('about') }}">
                            <span>Читать далее</span>
                        </a>
                    </div>
                    <div class="footer_links">
                        <h5>Категории</h5>
                        <ul>
                            <li>
                                <a href="index.html">
                                    <span>Проишествия</span>
                                </a>
                            </li>
                            <li>
                                <a href="about.html">
                                    <span>Скидки</span>
                                </a>
                            </li>
                            <li>
                                <a href="contact.html">
                                    <span>Эрбас</span>
                                </a>
                            </li>
                            <li>
                                <a href="albums.html">
                                    <span>Боинг</span>
                                </a>
                            </li>
                            <li>
                                <a href="blog.html">
                                    <span>Авиасалон</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="footer_links">
                        <h5>Menu</h5>
                        <ul>
                            <li>
                                <a href="{{ url('/') }}">
                                    <span>Home</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('about') }}">
                                    <span>About</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('contact') }}">
                                    <span>Contacts</span>
                                </a>
                            </li>
                            @guest
                            <li>
                                <a href="{{ route('login') }}">
                                    <span>Sign in</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('register') }}">
                                    <span>Регистрация</span>
                                </a>
                            </li>
                            @endguest
                            @auth
                            <li>
                                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                    <span>Выйти</span>
                                </a>
                                <form action="{{ route('logout') }}" method="POST" id="logout-form" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                            @endauth
                            <li>
                                <a href="{{ route('search.index') }}">
                                    <span>Поиск</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!--Popular posts-->
                    <div class="popular_posts">
                        @include('layouts.includes.popular-posts')
                    </div>
                    <!-- /.Popular posts -->
                </div>
                <div class="footer_wrapper_down">
                    <svg class="hidden">
                    <symbol id="icon-heart" viewBox="0 0 24 21">
                        <path d="M20.497.957A6.765 6.765 0 0 0 17.22.114a6.76 
                            6.76 0 0 0-5.218 2.455A6.778 6.778 0 0 0 3.506.957 
                            6.783 6.783 0 0 0 0 6.897c0 .732.12 1.434.335 2.09 
                            1.163 5.23 11.668 11.827 11.668 11.827s10.498-6.596 
                            11.663-11.826a6.69 6.69 0 0 0 .336-2.091 6.786 6.786 
                            0 0 0-3.505-5.94z" />
                    </symbol>
                    </svg>
                    <div class="footer_copyright">
                        <p>&#169; {{ date('Y') }} Airinsider</p>
                        <p>
                            Noa Digital. Made with 
                            <button class="iconbutton">
                                <svg class="icon icon--heart">
                                <use xlink:href="#icon-heart"></use>
                                </svg>
                            </button>
                            for a better web.
                        </p>
                    </div>
                    <div class="footer_newsletter">
                        <h5>Подпишитесь на новости</h5>
                        
                        <p>Следите за новостями:</p>
                        <a href="#" id="facebook">fb</a>
                        <a href="#" id="twitter">tw</a>
                        <a href="#">pt</a>
                    </div>
                </div>
            </footer>       
            <!-- /.Footer -->
        </div>
        <!-- /.App -->
        
        <!--Scripts -->
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
        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="{{ asset('js/lazyload.min.js') }}" defer></script>
        @stack('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.1.1/gsap.min.js"></script>
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="{{ asset('js/lazyload_users.js') }}"></script>
        <!-- /.Scripts -->
        
    </body>
    <!-- /.Body -->
    
</html>
