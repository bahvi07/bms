
// ✅ CSRF helper
function getCsrfToken() {
    return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
}

// ✅ Open Create Modal
function openCreateModal() {
    document.getElementById('garmentForm').reset();
    document.getElementById('garment-id').value = '';
    document.getElementById('modal-title').innerText = '➕ Add New Garment';
    document.getElementById('modal-subtitle').innerText = 'Fill in the details below to create a new garment type.';
    document.getElementById('my_modal_1').showModal();
}

// ✅ Open Edit Modal
function openEditModal(garment) {
    document.getElementById('garment-id').value = garment.id;
    document.getElementById('garment-name').value = garment.name;
    document.getElementById('description').value = garment.description;
    document.getElementById('modal-title').innerText = '✏️ Edit Garment';
    document.getElementById('modal-subtitle').innerText = 'Update garment details below.';
    document.getElementById('my_modal_1').showModal();
}

// ✅ DOM Ready
document.addEventListener("DOMContentLoaded", () => {
    const garmentForm = document.getElementById('garmentForm');
    let isSubmitting = false; // Flag to prevent multiple submissions

    if (garmentForm) {
        // Remove any existing event listeners to prevent duplicates
        const newForm = garmentForm.cloneNode(true);
        garmentForm.parentNode.replaceChild(newForm, garmentForm);
        
        newForm.addEventListener('submit', async function (event) {
            event.preventDefault();
            
            // Prevent multiple submissions
            if (isSubmitting) return;
            isSubmitting = true;
            
            // Disable submit button
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalBtnText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<span class="loading loading-spinner"></span> Saving...';
            
            const id = document.getElementById('garment-id').value;
            const formData = new FormData(this);
            let url = id ? `/dashboard/masters/${id}` : `/dashboard/masters`;

            if (id) formData.append('_method', 'PUT'); // Laravel method spoofing

            try {
                let response = await fetch(url, {
                    method: 'POST',
                    headers: {
                        "X-CSRF-TOKEN": getCsrfToken(),
                        "Accept": "application/json"
                    },
                    body: formData
                });

                let data = await response.json();

                if (!response.ok) {
Swal.fire("Error!", data.message || "Validation failed. Please check your input.", "error");
                    return;
                }

                // ✅ Success
                document.getElementById('my_modal_1').close();
                garmentForm.reset();

               if (id) {
    // Update row
    let row = document.querySelector(`#row-${id}`);
    if (row) {
        row.querySelector('.col-name').innerText = data.garment.name;
        row.querySelector('.col-description').innerText = data.garment.description;
    }
} else {
    // Add new row only if not already exists
    if (!document.querySelector(`#row-${data.garment.id}`)) {
        const tbody = document.querySelector("#garments-table tbody");
        const newRow = document.createElement("tr");
        newRow.id = `row-${data.garment.id}`;
        newRow.className = "bg-white border-b text-center";
        newRow.innerHTML = `
            <td class="px-6 py-4 col-name">${data.garment.name}</td>
            <td class="px-6 py-4 col-description">${data.garment.description ?? ''}</td>
            <td class="px-6 py-4 text-center">
                <button onclick='openEditModal(${JSON.stringify(data.garment)})'
                    class="text-white btn bg-green-500 hover:bg-green-600 rounded-lg px-5">Edit</button>
                <button onclick="deleteGarment(${data.garment.id})"
                    class="text-white btn rounded-lg bg-red-500 hover:bg-red-700 ml-2">
                    Delete
                </button>
            </td>
        `;
        tbody.appendChild(newRow);
    }
}
Swal.fire("Success!", data.message || "Garment saved successfully.", "success");
                document.getElementById('my_modal_1').close();
                garmentForm.reset();
            } catch (err) {
                console.error(err);
               Swal.fire("Error!", "Unexpected error occurred while saving garment.", "error");
            } finally {
                // Re-enable submit button
                isSubmitting = false;
                if (submitBtn) {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalBtnText;
                }
            }
        });
    }
});

// ✅ Delete Garment with SweetAlert2
async function deleteGarment(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "This action cannot be undone!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#16a34a', // Tailwind green
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then(async (result) => {
        if (result.isConfirmed) {
            try {
                let response = await fetch(`/dashboard/masters/${id}`, {
                    method: 'POST',
                    headers: {
                        "X-CSRF-TOKEN": getCsrfToken(),
                        "Accept": "application/json",
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({ _method: 'DELETE' })
                });

                let data = await response.json();

                if (response.ok) {
                    document.querySelector(`#row-${id}`).remove();
                    Swal.fire('Deleted!', data.message || 'Garment deleted successfully.', 'success');
                } else {
                    Swal.fire('Failed!', data.message || 'Failed to delete garment.', 'error');
                }
            } catch (err) {
                console.error(err);
                Swal.fire('Error!', 'Unexpected error during delete.', 'error');
            }
        }
    });
}

