<!doctype html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    
    <!-- Head -->
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title', config('app.name'))</title>
        <!-- Fontawesome -->
        <script src="https://kit.fontawesome.com/0f7f320048.js" crossorigin="anonymous"></script>
        @stack('styles')
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <!-- /.Head -->

    <!-- Body -->
    <body>
        
        <!-- App -->
        <div id="app"></div>
        
        <!-- Header -->
        <header>
            <div class="menu-wrapper">
                <div class="logo">
                    <a href="{{ url('/') }}">
                        авиа<span class="logo-span">инсайдер</span>
                    </a>
                </div>
                <!-- Navigation -->
                <nav>
                    <ul>
                        <li class="sub-menu">
                            <a href="javascript:void(0)">User board</a>
                            <ul>
                                @can('user_access')
                                <li>
                                    <a href="/dashboard/users" class="sub-item">
                                        <span>Users</span>
                                    </a>
                                </li>
                                @endcan
                                @can('role_access')
                                <li>
                                    <a href="/dashboard/roles" class="sub-item">
                                        <span>Roles</span>
                                    </a>
                                </li>
                                @endcan
                                @can('permission_access')
                                <li>
                                    <a href="/dashboard/permissions" class="sub-item">
                                        <span>Permissions</span>
                                    </a>
                                </li>
                                @endcan
                                @can('subscription_access')
                                <li>
                                    <a href="/dashboard/subscriptions" class="sub-item">
                                        <span>Subscriptions</span>
                                    </a>
                                </li>
                                @endcan
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:void(0)">Post board</a>
                            <ul>
                                @can('dashboard_access')
                                <li>
                                    <a href="/dashboard/posts" class="sub-item">
                                        <span>Posts</span>
                                    </a>
                                </li>
                                @endcan
                                @can('category_access')
                                <li>
                                    <a href="/dashboard/categories" class="sub-item">
                                        <span>Categories</span>
                                    </a>
                                </li>
                                @endcan
                                @can('tag_access')
                                <li>
                                    <a href="/dashboard/tags" class="sub-item">
                                        <span>Tags</span>
                                    </a>
                                </li>
                                @endcan
                                @can('comment_access')
                                <li>
                                    <a href="/dashboard/comments" class="sub-item">
                                        <span>Comments</span>
                                    </a>
                                </li>
                                @endcan
                            </ul>
                        </li>
                        @can('post_trash_list')
                        <li>
                            <a href="/dashboard/trash">Trash</a>
                        </li>
                        @endcan
                        @auth
                        <li class="sub-menu">
                            <a href="javascript:void(0)">{{ Auth::user()->name }}</a>
                            <ul>
                                <li>
                                    <a href="{{ route('logout') }}" class="sub-item" onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                        <span>{{ __('Logout') }}</span>
                                    </a>
                                    <form action="{{ route('logout') }}" method="POST"  id="logout-form" style="display: none;">
                                        @csrf
                                    </form>
                                </li>
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
            <!-- Search_overlay -->
            <div class="search-overlay">
                <span class="close-search">&times;</span>
                <form action="{{ route('search') }}" method="GET"  class="search-input" autocomplete="off">
                    <input type="text" name="keyword" value="{{ request()->input('keyword') }}" placeholder="Search..." required>
                </form>
            </div>
            <!-- /.Search_overlay -->
        </header>
        <!-- /.Header -->
        
        <!-- Main -->
        <main>
            @yield('content')
        </main>
        <!-- /.Main -->

        <!-- Footer -->
        <footer id="dashboard-footer">
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
            <div class="dashboard-footer-wrapper">
                <p>
                    <a href="{{ url('/') }}">Airinsider.</a>
                    Made with
                    <button class="iconbutton">
                        <svg class="icon icon--heart">
                        <use xlink:href="#icon-heart"></use>
                        </svg>
                    </button>
                    for a better web.
                </p>
            </div>
        </footer>
         <!-- /.Footer-->
         
         <!--Scripts -->
        <script src="{{ asset('js/jquery3.4.1.min.js') }}"></script>
        @stack('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.1.1/gsap.min.js"></script>
        <script src="{{ asset('js/app.js') }}" defer></script>
        @include('sweetalert::alert')
        <!-- /.Scripts -->
        
    </body>
    <!-- /.Body -->

</html>
