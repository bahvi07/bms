import './bootstrap';
import '../css/app.css';
import './toggle-password';
import Alpine from 'alpinejs';
import collapse from '@alpinejs/collapse';
import Swal from 'sweetalert2';
import '../../public/js/main.js';
import '../../public/js/importExcel.js';
Alpine.plugin(collapse);
window.Alpine = Alpine;
Alpine.start();

// ✅ make SweetAlert2 available globally
window.Swal = Swal;
