<!doctype html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <!-- Head -->
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title', config('app.name'))</title>
        <meta name="robots" content="none">
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">           
    </head>
    <!-- /.Head -->

    <!-- Body -->
    <body>
        
        <!-- Header -->
        <header>
            <div class="menu-wrapper">
                <div class="logo">
                    <a href="javascript:void(0)">
                        airways<span class="logo-span">media</span>
                    </a>
                </div>
            </div>
        </header>
        <!-- /.Header -->
        
        <!-- Main -->
        <main>
            @yield('content')
        </main>
        <!-- /.Main -->
        
    </body>
    <!-- /.Body -->

</html>
