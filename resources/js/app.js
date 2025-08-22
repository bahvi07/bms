import './bootstrap';
import '../css/app.css';
import './toggle-password';

import Alpine from 'alpinejs';
import collapse from '@alpinejs/collapse';
import Swal from 'sweetalert2';

// jQuery + DataTables
import $ from 'jquery';
import DataTable from 'datatables.net';
import 'datatables.net-dt/css/dataTables.dataTables.css';
// import 'datatables.net-bs5/css/dataTables.bootstrap5.css';


// Custom scripts
import './main.js';
import './importExcel.js';
import './garments.js';
import './delete.js';
import './measurements.js';
import './modals.js';
// Alpine setup
Alpine.plugin(collapse);
window.Alpine = Alpine;
Alpine.start();

// SweetAlert2 global
window.Swal = Swal;


document.addEventListener("DOMContentLoaded", function () {
    $('#garments-table').DataTable();
    $('#measurements-table').DataTable();
});
