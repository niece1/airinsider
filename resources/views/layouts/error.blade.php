<!doctype html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title', config('app.name'))</title>       
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">           
    </head>

    <body>
        <header>
            <div class="menu-wrapper">
                <div class="logo">
                    <a href="javascript:void(0)">авиа<span class="logo-span">инсайдер</span></a>
                </div>
            </div>
        </header>
        <main>
            @yield('content')
        </main>
    </body>

</html>
