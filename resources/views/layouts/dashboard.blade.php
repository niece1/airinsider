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

	@stack('styles')

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
				<li class="sub-menu">
					<a href="javascript:void(0)">Board</a>
					<ul>
						<li>
							<a class="sub-item" href="/dashboard/users">Users</a>
						</li>
						<li>
							<a class="sub-item" href="/dashboard/roles">Roles</a>
						</li>
						<li>
							<a class="sub-item" href="/dashboard/permissions">Permissions</a>
						</li>
						<li>
							<a class="sub-item" href="/dashboard/subscriptions">Subscriptions</a>
						</li>
						<li>
							<a class="sub-item" href="/dashboard/posts">Posts</a>
						</li>
						<li>
							<a class="sub-item" href="/dashboard/categories">Categories</a>
						</li>
						<li>
							<a class="sub-item" href="/dashboard/tags">Tags</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="/dashboard/trashed">Trashed posts</a>
				</li>	
				@auth
				<li class="sub-menu">
					<a href="javascript:void(0)">{{ Auth::user()->name }}</a>
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

<body>

	<main>			
		@yield('content')
	</main>    

	<!--Footer-->

	<footer id="dashboard-footer">
		<div class="dashboard-footer-wrapper">
			<p><a href="{{ url('/') }}">Airinsider</a></p>
		</div>
	</footer>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	@stack('scripts')
	<script src="{{ asset('js/app.js') }}" defer></script> 
	@include('sweetalert::alert')

</body>
</html>