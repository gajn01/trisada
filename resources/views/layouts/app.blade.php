<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts -->
        @livewireStyles
        @vite(['resources/sass/app.scss'])
        <link href="{{ asset('css/mary-grace.css') }}" rel="stylesheet">

        @stack('custom-styles')
    </head>
    <body class="font-sans antialiased app bg-marygrace">

        <header class="app-header fixed-top d-print-none">
            <!-- Header -->
            <x-header/>
            <!-- Side Panel -->
            <x-side-panel/>
        </header>
        <div class="app-wrapper">
            <div class="app-content pt-3 p-md-3 p-lg-4">
                <div class="container-xl">
                    @if (isset($title))
                        <h1 class="app-page-title">{{ $title }}</h1>
                    @endif
                    <!-- Page Content -->
                    {{ $slot }}
                </div>
            </div>
            <!-- Footer -->
            <x-footer/>
        </div>

        @livewireScripts

        <script src="{{ asset('js/mary-grace.js')}}"></script>

        @vite(['resources/js/app.js'])

        @stack('custom-scripts')
    </body>
</html>
