<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
    </head>
    <body class="welcome-page">
        <header class="welcome-header">
            @if (Route::has('login'))
                <nav class="welcome-nav">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="nav-link">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="nav-link">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="nav-link">Register</a>
                        @endif
                    @endauth
                </nav>
            @endif
        </header>
        <div class="welcome-content-wrapper">
            <main class="welcome-main">
                <h1>Let's get started</h1>
                <p>Laravel has an incredibly rich ecosystem. We suggest starting with the following.</p>
                <ul class="welcome-links">
                    <li><a href="https://laravel.com/docs" target="_blank" rel="noopener noreferrer">Documentation</a></li>
                    <li><a href="https://laracasts.com" target="_blank" rel="noopener noreferrer">Laracasts</a></li>
                </ul>
            </main>
        </div>
    </body>
</html>
