<script src="//unpkg.com/alpinejs" defer></script>
@vite('resources/js/app.js')
<script src="{{asset('js/main.js')}}"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const sidebar = document.getElementById('hs-sidebar-header');
    const mobileMenuButton = document.getElementById('mobile-menu-button');

    const hidesidebar=document.getElementById('hs-header');
    mobileMenuButton.addEventListener('click', function () {
        sidebar.classList.toggle('-translate-x-full'); // Show/hide sidebar
    });

    const closeButton = document.getElementById('mobile-close-button');
    closeButton.addEventListener('click', function () {
        sidebar.classList.add('-translate-x-full'); // Hide sidebar
    });
});
</script>
