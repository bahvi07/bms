// resources/js/garments.js
import { getCsrfToken } from './main';

document.addEventListener('DOMContentLoaded', () => {
  const garmentForm = document.getElementById('garmentForm');
  if (!garmentForm) return;

  let submitting = false;
  garmentForm.addEventListener('submit', async (event) => {
    event.preventDefault();
    if (submitting) return;
    submitting = true;

    const submitBtn = garmentForm.querySelector('button[type="submit"]');
    const originalBtnHtml = submitBtn?.innerHTML;

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
        headers: { 'X-CSRF-TOKEN': getCsrfToken(), 'Accept': 'application/json' },
        body: fd,
      });

      const data = await res.json().catch(() => ({}));
      if (!res.ok) {
        const msg = data.message || Object.values(data.errors || {}).flat().join('\n');
        throw new Error(msg);
      }

      const garment = data.garment || data.data || data;
      const tbody = document.querySelector('#garments-table tbody');
 const iterator = tbody.querySelectorAll('tr').length + 1;
      if (id) {
        const row = document.getElementById(`row-${id}`);
        if (row) {
          row.querySelector('.col-name').textContent = garment.name ?? '';
          row.querySelector('.col-description').textContent = garment.description ?? '';
        }
      } else {
        if (!document.getElementById(`row-${garment.id}`)) {
          const tr = document.createElement('tr');
          tr.id = `row-${garment.id}`;
          tr.className = 'bg-white border-b text-center';
          tr.innerHTML = `
           <td class="px-6 py-4 col-iteration">${iterator}</td>
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
location.reload();
      Swal.fire('Success!', data.message || 'Garment saved successfully.', 'success');
      document.getElementById('my_modal_1')?.close();
      garmentForm.reset();
    } catch (err) {
      Swal.fire('Error!', err.message || 'Unexpected error occurred while saving garment.', 'error');
    } finally {
      submitting = false;
      if (submitBtn) {
        submitBtn.disabled = false;
        submitBtn.innerHTML = originalBtnHtml;
      }
    }
  });
});
