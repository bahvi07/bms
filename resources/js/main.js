// resources/js/main.js
export function getCsrfToken() {
  const el = document.querySelector('meta[name="csrf-token"]');
  return el ? el.getAttribute('content') : '';
}

// Sidebar toggle
document.addEventListener('DOMContentLoaded', () => {
  const sidebar = document.getElementById('hs-sidebar-header');
  const mobileMenuButton = document.getElementById('mobile-menu-button');
  const closeButton = document.getElementById('mobile-close-button');

  if (mobileMenuButton && sidebar) {
    mobileMenuButton.addEventListener('click', () => {
      sidebar.classList.toggle('-translate-x-full');
    });
  }
  if (closeButton && sidebar) {
    closeButton.addEventListener('click', () => {
      sidebar.classList.add('-translate-x-full');
    });
  }
});
