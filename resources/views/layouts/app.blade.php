<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    {{-- Vite CSS & JS --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
@vite('resources/css/main.css')
     
    @include('partials.head')
    @stack('styles')
</head>
<body class="bg-gray-50 text-gray-800">
    <div class="dashboard-container flex">
        @include('partials.sidebar')
        <div class="main-content flex-1 md:ml-64 ml-0 transition-all duration-300">
            @include('partials.header')

            <main class="content-wrapper p-6">
                @yield('content')
            </main>

            @include('partials.footer')
        </div>
    </div>

    @include('partials.scripts')
    @stack('scripts')
    <div id="toast-container" class="toast toast-top toast-end z-50"></div>
</body>
</html>
