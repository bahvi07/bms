import { setupImport } from "./utils/importHandler";
import { getCsrfToken } from "./main";
setupImport({
    importBtnId: "importFabricBtn",
    importModalId: "importFabricModal",
    importFormId: "importFabricForm",
    importSubmitBtnId: "importFabricSubmitBtn",
    endpoint: "/dashboard/masters/import-fabrics",
    entityName: "fabrics"
});

// Create or update Fabric
document.addEventListener('DOMContentLoaded', () => {
const fabricForm = document.getElementById('fabricForm');
if (!fabricForm) return;
let submitting = false;

fabricForm.addEventListener('submit', async (event) => {
    event.preventDefault();

    if (submitting) return;
    submitting = true;

    const submitBtn = fabricForm.querySelector('button[type="submit"]');
    const originalBtnHtml = submitBtn?.innerHTML;
    if (submitBtn) {
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span class="loading loading-spinner"></span> Saving...';
    }

    try{
        const id=document.getElementById('fabric-id').value.trim();
        const url=id ? `/dashboard/masters/update-fabric/${id}`:`/dashboard/masters/create-fabric`;
        const fd=new FormData(fabricForm);
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

      const fabric=data.fabric||data.data||data;
      const tbody = document.querySelector('#fabric-table tbody');
      const iterator = tbody.querySelectorAll('tr').length + 1;
      if (id) {
        const row = document.getElementById(`row-${id}`);
        if (row) {
          row.querySelector('.col-fabric').textContent = fabric.fabric ?? '';
          row.querySelector('.col-description').textContent = fabric.description ?? '';
        }
      } else {
        if (!document.getElementById(`row-${fabric.id}`)) {
          const tr = document.createElement('tr');
          tr.id = `row-${fabric.id}`;
          tr.className = 'bg-white border-b text-center';
          tr.innerHTML = `
            <td class="px-6 py-4 col-iteration">${iterator}</td>
            <td class="px-6 py-4 col-fabric">${fabric.fabric ?? ''}</td>
            <td class="px-6 py-4 col-description">${fabric.description ?? ''}</td>
            <td class="px-6 py-4 text-center">
              <button onclick='fabricEditModal(${JSON.stringify(fabric)})'
                class="text-white btn bg-green-500 hover:bg-green-600 rounded-lg px-5 border-none">
                <i class="ti ti-edit"></i>
              </button>
              <button onclick="deletefabric(${fabric.id})"
                class="text-white btn bg-red-500 hover:bg-red-700 rounded-lg px-5 ml-2 border-none">
                <i class="ti ti-trash"></i>
              </button>
            </td>
          `;
          tbody.appendChild(tr);
        }
      }
location.reload();
      Swal.fire('Success!', data.message || 'fabric saved successfully.', 'success');
      document.getElementById('my_modal_1')?.close();
      fabricForm.reset();
    } catch (err) {
      Swal.fire('Error!', err.message || 'Unexpected error occurred while saving fabric.', 'error');
    } finally {
      submitting = false;
      if (submitBtn) {
        submitBtn.disabled = false;
        submitBtn.innerHTML = originalBtnHtml;
      }
    }
  });
});
