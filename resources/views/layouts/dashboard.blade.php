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
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">   

</head>

<header>
            <div class="menu-wrapper">
                <div class="logo">
                    <a href="{{ url('/') }}">авиа<span class="logo-span">инсайдер</span></a>
                </div>
                <nav>



                    <ul>
                        <li>
                            <a href="#">Recycle Bin</a>

                        </li>
                        <li class="sub-menu">
                            <a href="#">User management</a>
<ul>
                                <li>
                                    <a class="sub-item" href="#">Users</a>
                                </li>
                                <li>
                                    <a class="sub-item" href="#">Roles</a>
                                </li>
                                <li>
                                    <a class="sub-item" href="#">Permissions</a>
                                </li>
                                <li>
                                    <a class="sub-item" href="#">Subscriptions</a>
                                </li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="#">Post managment</a>
                            <ul>
                                <li>
                                    <a class="sub-item" href="#">Posts</a>
                                </li>
                                <li>
                                    <a class="sub-item" href="#">Tags</a>
                                </li>
                                <li>
                                    <a class="sub-item" href="#">Categories</a>
                                </li>
                            </ul>
                        </li>
                        
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

<body>

	<main>				
		@yield('content')
	</main>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="{{ asset('js/app.js') }}" defer></script>   
</body>
</html>