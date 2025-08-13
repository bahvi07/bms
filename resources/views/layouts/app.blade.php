<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    @include('partials.head') <!-- Additional meta tags, CSS links -->
</head>
<body>
    <div class="dashboard-container">
        @include('partials.sidebar')

        <div class="main-content md:ml-64 ml-0 ">
            @include('partials.header')

            <div class="content-wrapper px-6">
                @yield('content') <!-- Page-specific content -->
            </div>

            @include('partials.footer')
        </div>
    </div>  

    @include('partials.scripts') <!-- All JS imports -->
</body>
</html>
