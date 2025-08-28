import { setupImport } from "./utils/importHandler";
import { getCsrfToken } from "./main";
setupImport({
    importBtnId: "importRoleBtn",
    importModalId: "importRoleModal",
    importFormId: "importRoleForm",
    importSubmitBtnId: "importRoleSubmitBtn",
    endpoint: "/dashboard/roles/import-roles",
    entityName: "roles"
});

document.addEventListener('DOMContentLoaded', () => {
    const roleForm = document.getElementById('roleForm');
    if (!roleForm) return;

    let submitting = false;
    roleForm.addEventListener('submit', async (event) => {
        event.preventDefault();
        if (submitting) return;
        submitting = true;

        const submitBtn = roleForm.querySelector('button[type="submit"]');
        const originalBtnHtml = submitBtn?.innerHTML;

        if (submitBtn) {
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<span class="loading loading-spinner"></span> Saving...';
        }

        try {
            const id = document.getElementById('role-id').value.trim();
            const url = id ? `/dashboard/roles/update/${id}` : `/dashboard/roles/create/`;
            const fd = new FormData(roleForm);
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

            const role = data.role || data.data || data;
            const tbody = document.querySelector('#roles-table tbody');
            const iterator = tbody.querySelectorAll('tr').length + 1;
            if (id) {
                const row = document.getElementById(`row-${id}`);
                if (row) {
                    row.querySelector('.col-role').textContent = role.role ?? '';
                    row.querySelector('.col-description').textContent = role.description ?? '';
                    row.querySelector('.col-assigned').textContent = role.assigned_staff ?? '-';
                    row.querySelector('.col-status').textContent = role.status == 1 ? 'Active' : 'Inactive';
                }
            } else {
                if (!document.getElementById(`row-${role.id}`)) {
                    const tr = document.createElement('tr');
                    tr.id = `row-${role.id}`;
                    tr.className = 'bg-white border-b text-center';
                    tr.innerHTML = `
                        <td class="px-6 py-4 col-role">${role.role ?? ''}</td>
                        <td class="px-6 py-4 col-description">${role.description ?? ''}</td>
                        <td class="px-6 py-4 col-assigned"><i class="ti ti-users"></i> ${role.assigned_staff ?? '-'}</td>
                        <td class="px-6 py-4 col-status">${role.status == 1 ? '<span class="px-3 py-1 text-xs rounded-full bg-green-100 text-green-600">Active</span>' : '<span class="px-3 py-1 text-xs rounded-full bg-red-100 text-red-600">Inactive</span>'}</td>
                        <td class="px-6 py-4 text-center">
                            <button onclick='roleEditModal(${JSON.stringify(role)})'
                                class="text-white btn bg-green-500 hover:bg-green-600 rounded-lg px-5 border-none">
                                <i class="ti ti-edit"></i>
                            </button>
                            <button onclick="deleteRole(${role.id})"
                                class="text-white btn bg-red-500 hover:bg-red-700 rounded-lg px-5 ml-2 border-none">
                                <i class="ti ti-trash"></i>
                            </button>
                        </td>
                    `;
                    tbody.appendChild(tr);
                }
            }
            location.reload();
            Swal.fire('Success!', data.message || 'Role saved successfully.', 'success');
            document.getElementById('my_modal_1')?.close();
            roleForm.reset();
        } catch (error) {
            Swal.fire('Error!', error.message || 'Unexpected error occurred while saving role.', 'error');
        } finally {
            submitting = false;
            if (submitBtn) {
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalBtnHtml;
            }
        }
    });
});