import './bootstrap';
import '../css/app.css';
import './toggle-password';

import Alpine from 'alpinejs';
import collapse from '@alpinejs/collapse';
import Swal from 'sweetalert2';
import $ from 'jquery';

// ✅ DataTables (Bootstrap 5 + AutoFill)
import DataTable from 'datatables.net-bs5';
import 'datatables.net-bs5/css/dataTables.bootstrap5.min.css';

import 'datatables.net-autofill-bs5';
import 'datatables.net-autofill-bs5/css/autoFill.bootstrap5.min.css';

// Your custom scripts
import '../../public/js/main.js';
import '../../public/js/importExcel.js';

// Alpine setup
Alpine.plugin(collapse);
window.Alpine = Alpine;
Alpine.start();

// ✅ SweetAlert2 global
window.Swal = Swal;

// ✅ Initialize DataTable with Bootstrap classes
$(document).ready(function () {
    new DataTable('#garments-table', {
        responsive: true,
        pagingType: 'simple_numbers', // cleaner pagination
        language: {
            lengthMenu: "Show _MENU_ entries",
            search: "🔍 Search:",
            paginate: {
                first: "«",
                last: "»",
                next: "›",
                previous: "‹"
            }
        }
    });
});
