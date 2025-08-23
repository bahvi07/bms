import { setupImport } from './utils/importHandler';
import { getCsrfToken } from './main';
setupImport({
    importBtnId: "importMeasurementBtn",
    importModalId: "importMeasurementModal",
    importFormId: "importMeasurementForm",
    importSubmitBtnId: "importMeasurementSubmitBtn",
    endpoint: "/dashboard/masters/import-measurements",
    entityName: "measurements"
});


//  create or update Measurement

document.addEventListener('DOMContentLoaded', () => {
  const measurementForm = document.getElementById('measurementForm');
  if (!measurementForm) return;

  let submitting = false;
  measurementForm.addEventListener('submit', async (event) => {
    event.preventDefault();
    if (submitting) return;
    submitting = true;

    const submitBtn = measurementForm.querySelector('button[type="submit"]');
    const originalBtnHtml = submitBtn?.innerHTML;

    if (submitBtn) {
      submitBtn.disabled = true;
      submitBtn.innerHTML = '<span class="loading loading-spinner"></span> Saving...';
    }

    try {
      const id = document.getElementById('measurement-id').value.trim();
      const url = id  ? `/dashboard/masters/update-measurement/${id}` : `/dashboard/masters/create-measurement/`;
      const fd = new FormData(measurementForm);
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

      const measurement = data.measurement || data.data || data;
      const tbody = document.querySelector('#measurements-table tbody');
      const iterator = tbody.querySelectorAll('tr').length + 1;
      if (id) {
        const row = document.getElementById(`row-${id}`);
        if (row) {
          row.querySelector('.col-label').textContent = measurement.label ?? '';
          row.querySelector('.col-description').textContent = measurement.description ?? '';
          row.querySelector('.col-unit').textContent = measurement.unit?? '';
        }
      } else {
        if (!document.getElementById(`row-${measurement.id}`)) {
          const tr = document.createElement('tr');
          tr.id = `row-${measurement.id}`;
          tr.className = 'bg-white border-b text-center';
          tr.innerHTML = `
            <td class="px-6 py-4 col-iteration">${iterator}</td>
            <td class="px-6 py-4 col-label">${measurement.label ?? ''}</td>
            <td class="px-6 py-4 col-description">${measurement.description ?? ''}</td>
             <td class="px-6 py-4 col-unit">${measurement.unit ?? ''}</td>
            <td class="px-6 py-4 text-center">
              <button onclick='measurementEditModal(${JSON.stringify(measurement)})'
                class="text-white btn bg-green-500 hover:bg-green-600 rounded-lg px-5 border-none">
                <i class="ti ti-edit"></i>
              </button>
              <button onclick="deleteMeasurement(${measurement.id})"
                class="text-white btn bg-red-500 hover:bg-red-700 rounded-lg px-5 ml-2 border-none">
                <i class="ti ti-trash"></i>
              </button>
            </td>
          `;
          tbody.appendChild(tr);
        }
      }
location.reload();
      Swal.fire('Success!', data.message || 'measurement saved successfully.', 'success');
      document.getElementById('my_modal_1')?.close();
      measurementForm.reset();
    } catch (err) {
      Swal.fire('Error!', err.message || 'Unexpected error occurred while saving measurement.', 'error');
    } finally {
      submitting = false;
      if (submitBtn) {
        submitBtn.disabled = false;
        submitBtn.innerHTML = originalBtnHtml;
      }
    }
  });
});
