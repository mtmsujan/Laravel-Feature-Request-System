<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data=>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ app('favicon') }}">
    @csrf

    <style>
        .preloader {
            height: 100vh;
            width: 100vw;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }
    </style>
    <title>{{ app('name') }}</title>
    @include('layouts.styles')
    @include('layouts.colors')
    



</head>

<body class="bg-gray-100 dark:bg-gray-900 relative">

    <div class="preloader">
        <x-loader class="w-10 h-10" />
    </div>

    @stack('modals')

    @yield('header')
    @yield('aside')
    @yield('main')

    @yield('footer')
    @yield('alerts')
    @include('layouts.scripts')

    <script>
        window.addEventListener('htmx:load', function() {
            let preloader = document.querySelector('.preloader')
            preloader?.remove()
        })
        window.addEventListener('load', function() {
            let preloader = document.querySelector('.preloader')
            preloader?.remove()
        })
    </script>
</body>

</html>
