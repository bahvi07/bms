/* ================================
   main.js — FULL CRUD + Modals + Import
   Works with your index.blade.php IDs
   ================================ */


// --- Helpers ---
function getCsrfToken() {
  const el = document.querySelector('meta[name="csrf-token"]');
  return el ? el.getAttribute('content') : '';
}

// Expose helpers if you need in console
window.getCsrfToken = getCsrfToken;

// --- Modal helpers (same single <dialog id="my_modal_1"> for add & edit) ---
function openCreateModal() {
  const modal = document.getElementById('my_modal_1');
  if (!modal) return console.error('Modal #my_modal_1 not found');

  // Titles
  document.getElementById('modal-title').innerText = '➕ Add New Garment';
  document.getElementById('modal-subtitle').innerText = 'Fill in the details below.';

  // Clear form
  const form = document.getElementById('garmentForm');
  if (form) form.reset();

  const idInput = document.getElementById('garment-id');
  if (idInput) idInput.value = '';

  modal.showModal?.();
}

function openEditModal(garment) {
  const modal = document.getElementById('my_modal_1');
  if (!modal) return console.error('Modal #my_modal_1 not found');

  // Titles
  document.getElementById('modal-title').innerText = '✏️ Edit Garment';
  document.getElementById('modal-subtitle').innerText = 'Update the garment details below.';

  // Fill form
  document.getElementById('garment-id').value = garment.id ?? '';
  document.getElementById('garment-name').value = garment.name ?? '';
  document.getElementById('description').value = garment.description ?? '';

  modal.showModal?.();
}

// Make them callable from Blade inline onclick=""
window.openCreateModal = openCreateModal;
window.openEditModal = openEditModal;

// --- Delete with SweetAlert2 + fetch (uses FormData for Laravel method spoofing) ---
async function deleteGarment(id) {
  if (!window.Swal) {
    // fallback if Swal wasn't loaded for some reason
    if (!confirm('Delete this garment?')) return;
  }

  const confirmResult = await Swal.fire({
    title: 'Are you sure?',
    text: 'This action cannot be undone!',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#16a34a',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, delete it!',
  });

  if (!confirmResult.isConfirmed) return;

  try {
    const url = `/dashboard/masters/${id}`;
    const fd = new FormData();
    fd.append('_method', 'DELETE');

    const res = await fetch(url, {
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': getCsrfToken(),
        'Accept': 'application/json',
      },
      body: fd,
    });

    const data = await res.json().catch(() => ({}));

    if (!res.ok) {
      throw new Error(data.message || 'Failed to delete garment.');
    }

    // Remove row
    const row = document.getElementById(`row-${id}`);
    if (row) row.remove();

    Swal.fire('Deleted!', data.message || 'Garment deleted successfully.', 'success');
  } catch (err) {
    console.error(err);
    Swal.fire('Error!', err.message || 'Unexpected error during delete.', 'error');
  }
}
window.deleteGarment = deleteGarment;

// --- One-time DOM bindings (guarded for HMR) ---
(function bindOnce() {
  if (window.__BM_MAIN_BOUND__) return;
  window.__BM_MAIN_BOUND__ = true;

  document.addEventListener('DOMContentLoaded', () => {
    // Sidebar toggles
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

    // Import Excel: open modal
    const importBtn = document.getElementById('importBtn');
    const importModal = document.getElementById('importModal');
    if (importBtn && importModal) {
      importBtn.addEventListener('click', () => importModal.showModal?.());
    }

    // Import Excel: submit
    const importForm = document.getElementById('importForm');
    const importSubmitBtn = document.getElementById('importSubmitBtn');

    if (importForm) {
      importForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        if (!importForm.checkValidity()) return;

        if (importSubmitBtn) {
          importSubmitBtn.disabled = true;
          const original = importSubmitBtn.innerHTML;
          importSubmitBtn.dataset._original = original;
          importSubmitBtn.innerHTML = '<span class="loading loading-spinner"></span> Importing...';
        }

        try {
          const url = `/dashboard/masters/import`;
          const formData = new FormData(importForm);

          const res = await fetch(url, {
            method: 'POST',
            headers: {
              'X-CSRF-TOKEN': getCsrfToken(),
              'Accept': 'application/json',
            },
            body: formData,
          });

          const data = await res.json().catch(() => ({}));
          if (!res.ok) throw new Error(data.message || 'Import failed.');

          Swal.fire({
            icon: 'success',
            title: 'Import Successful',
            text: data.success ? `${data.success} garments imported successfully!` : 'Imported successfully!',
          });

          importModal?.close();
          importForm.reset();
        } catch (err) {
          console.error(err);
          Swal.fire({ icon: 'error', title: 'Import Failed', text: err.message || 'Unexpected error.' });
        } finally {
          if (importSubmitBtn) {
            importSubmitBtn.disabled = false;
            importSubmitBtn.innerHTML = importSubmitBtn.dataset._original || 'Import';
          }
        }
      });
    }

    // Create/Edit: single form submit handler (AJAX)
    const garmentForm = document.getElementById('garmentForm');
    if (garmentForm) {
      let submitting = false;

      garmentForm.addEventListener('submit', async (event) => {
        event.preventDefault();
        if (submitting) return;
        submitting = true;

        const submitBtn = garmentForm.querySelector('button[type="submit"]');
        const originalBtnHtml = submitBtn ? submitBtn.innerHTML : null;
        if (submitBtn) {
          submitBtn.disabled = true;
          submitBtn.innerHTML = '<span class="loading loading-spinner"></span> Saving...';
        }

        try {
          const id = document.getElementById('garment-id').value.trim();
          const url = id ? `/dashboard/masters/${id}` : `/dashboard/masters`;
          const fd = new FormData(garmentForm);
          if (id) fd.append('_method', 'PUT');

          const res = await fetch(url, {
            method: 'POST',
            headers: {
              'X-CSRF-TOKEN': getCsrfToken(),
              'Accept': 'application/json',
            },
            body: fd,
          });

          const data = await res.json().catch(() => ({}));
          if (!res.ok) {
            // Laravel validation format: { errors: { field: [..] } }
            const msg =
              data.message ||
              (data.errors && Object.values(data.errors).flat().join('\n')) ||
              'Validation failed. Please check your input.';
            throw new Error(msg);
          }

          const garment = data.garment || data.data || data; // be flexible with backend shape

          // Update table
          const tbody = document.querySelector('#garments-table tbody');
          if (!tbody) throw new Error('Table body not found');

          if (id) {
            // update row
            const row = document.getElementById(`row-${id}`);
            if (row) {
              const nameCell = row.querySelector('.col-name');
              const descCell = row.querySelector('.col-description');
              if (nameCell) nameCell.textContent = garment.name ?? '';
              if (descCell) descCell.textContent = garment.description ?? '';
              // refresh edit button payload
              const editBtn = row.querySelector('button[onclick^="openEditModal"]');
              if (editBtn) {
                editBtn.setAttribute('onclick', `openEditModal(${JSON.stringify(garment)})`);
              }
            }
          } else {
            // create new row (only if it doesn't exist)
            if (!document.getElementById(`row-${garment.id}`)) {
              const tr = document.createElement('tr');
              tr.id = `row-${garment.id}`;
              tr.className = 'bg-white border-b text-center';
              tr.innerHTML = `
                <td class="px-6 py-4 col-name">${garment.name ?? ''}</td>
                <td class="px-6 py-4 col-description">${garment.description ?? ''}</td>
                <td class="px-6 py-4 text-center">
                  <button onclick='openEditModal(${JSON.stringify(garment)})'
                    class="text-white btn bg-green-500 hover:bg-green-600 rounded-lg px-5 border-none">
                    <i class="ti ti-edit"></i>
                  </button>
                  <button onclick="deleteGarment(${garment.id})"
                    class="text-white btn bg-red-500 hover:bg-red-700 rounded-lg px-5 ml-2 border-none">
                    <i class="ti ti-trash"></i>
                  </button>
                </td>
              `;
              tbody.appendChild(tr);

            }
          }

          Swal.fire('Success!', data.message || 'Garment saved successfully.', 'success');
          // Close + reset
          document.getElementById('my_modal_1')?.close();
          garmentForm.reset();
          // reset titles to Add (optional)
          document.getElementById('modal-title').innerText = '➕ Add New Garment';
          document.getElementById('modal-subtitle').innerText = 'Fill in the details below.';
        } catch (err) {
          console.error(err);
          Swal.fire('Error!', err.message || 'Unexpected error occurred while saving garment.', 'error');
        } finally {
          submitting = false;
          if (submitBtn) {
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalBtnHtml;
          }
        }
      });
    }
  });
})();
