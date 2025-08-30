const DEFAULT_IMG = "https://avatar.iran.liara.run/public"; //  placeholder

document.querySelectorAll(".staff-file-upload-input").forEach(input => {
    const extraOutline = input.closest(".extraOutline");
    const fileNameSpan = extraOutline.querySelector(".file-name");
    const instructions = extraOutline.querySelector(".upload-instructions");
    const preview = document.getElementById("profilePreview");
    // Add remove button logic (if you want the file name itself clickable)
    fileNameSpan.addEventListener("click", function () {
        input.value = "";
        preview.src = DEFAULT_IMG;
        fileNameSpan.textContent = "";
        fileNameSpan.classList.add("hidden");
        instructions.classList.remove("hidden");
    });

    input.addEventListener("change", function () {
        const file = this.files[0]; // Get the selected file
        // Update image preview
        if (file) {
            preview.src = URL.createObjectURL(file);
        }
        // Update file name display
        if (this.files.length > 0) {
            fileNameSpan.textContent = this.files[0].name;
            fileNameSpan.classList.remove("hidden");
            instructions.classList.add("hidden");
        } else {
            fileNameSpan.textContent = "";
            fileNameSpan.classList.add("hidden");
            instructions.classList.remove("hidden");
        }
    });
});

document.querySelectorAll(".staff-id-upload-input").forEach(input => {
    const extraOutline = input.closest(".extraOutline-id");
    const fileNameSpan = extraOutline.querySelector(".file-name-id");
    const instructions = extraOutline.querySelector(".upload-instructions-id");

    // Show file name and hide instructions on file select
    input.addEventListener("change", function () {
        const file = this.files[0];
        if (file) {
            fileNameSpan.textContent = file.name;
            fileNameSpan.classList.remove("hidden");
            instructions.classList.add("hidden");
        } else {
            fileNameSpan.textContent = "";
            fileNameSpan.classList.add("hidden");
            instructions.classList.remove("hidden");
        }
    });

    // Allow clicking file name to clear and reselect
    fileNameSpan.addEventListener("click", function () {
        input.value = "";
        fileNameSpan.textContent = "";
        fileNameSpan.classList.add("hidden");
        instructions.classList.remove("hidden");
        input.click(); // Open file dialog again
    });
});


// Form Submission Handling
document.addEventListener('DOMContentLoaded', () => {

    const staffForm = document.getElementById('staff-info');
    if (!staffForm) return;
    let submitting = false;

    staffForm.addEventListener('submit', async (event) => {
        event.preventDefault();
        if (submitting) return;  // Prevent double submit
        submitting = true;

        const submitBtn = staffForm.querySelector('button[type="submit"]');
        const originalBtnHtml = submitBtn?.innerHTML;

        if (submitBtn) {
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<span class="loading loading-spinner"></span> Saving...';
        }

        try {
            const id = document.getElementById('staff-id').value.trim();
            const url = `/dashboard/staff/store/`;
            const fd = new FormData(staffForm);

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

            const staff = data.staff || data.data || data;
            const tbody = document.querySelector('#staff-table tbody');
            if (tbody && staff) {
                // append or update row
            }

            Swal.fire('Success!', 'Staff member saved.', 'success');
            staffForm.reset();
            // Optionally: window.location.href = '/dashboard/staff';

        } catch (error) {
            Swal.fire('Error!', error.message || 'Unexpected error occurred.', 'error');
        } finally {
            submitting = false;
            if (submitBtn) {
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalBtnHtml;
            }
        }
    });

});


const btn=document.getElementById('submit-staff');
btn.addEventListener('click',function(e){e.preventDefault();document.getElementById('staff-info').submit();});