{{-- Load app.js through Vite (includes Alpine, SweetAlert, DataTables, custom scripts, etc.) --}}
@vite('resources/js/app.js')

{{-- Extra scripts pushed from Blade views --}}
@stack('scripts')
