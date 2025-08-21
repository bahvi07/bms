<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Laravel Vite Assets -->
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
     @vite('resources/css/app.css') 
    {{-- Additional meta tags, CSS --}}
    @include('partials.head')

    {{-- Page-specific styles (if needed) --}}
    @stack('styles')
</head>
<body class="bg-gray-50 text-gray-800">
    <div class="dashboard-container flex">
        
        {{-- Sidebar --}}
        @include('partials.sidebar')

        {{-- Main Content --}}
        <div class="main-content flex-1 md:ml-64 ml-0 transition-all duration-300">
            
            {{-- Header --}}
            @include('partials.header')

            {{-- Page Content --}}
            <main class="content-wrapper p-6">
                @yield('content')
            </main>

            {{-- Footer --}}
            @include('partials.footer')
        </div>
    </div>  

    {{-- Common Scripts --}}
    @include('partials.scripts')

    {{-- Page-specific scripts --}}
    @stack('scripts')
    <div id="toast-container" class="toast toast-top toast-end z-50"></div>
</body>
</html>
