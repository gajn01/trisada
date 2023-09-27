<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Scripts -->
        @livewireStyles
        @vite(['resources/sass/app.scss'])

        <link href="{{ asset('css/report.css')}}" rel="stylesheet">
    </head>
    <body class="font-sans antialiased app bg-white">
            <div class="container-fluid">
                {{ $slot }}
            </div>
        </div>
        @livewireScripts
        @vite(['resources/js/app.js'])

        @stack('custom-scripts')
    </body>
</html>
