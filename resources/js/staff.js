import { getCsrfToken } from './main.js';

const DEFAULT_IMG = "https://avatar.iran.liara.run/public"; //  placeholder

// Helper function to convert DD-MM-YYYY to YYYY-MM-DD
function convertDateFormat(dateString) {
    if (!dateString) return '';
    
    // Check if it's already in YYYY-MM-DD format
    if (/^\d{4}-\d{2}-\d{2}$/.test(dateString)) {
        return dateString;
    }
    
    // Convert from DD-MM-YYYY to YYYY-MM-DD
    const parts = dateString.split('-');
    if (parts.length === 3) {
        const day = parts[0];
        const month = parts[1];
        const year = parts[2];
        
        // Validate date parts
        if (day && month && year && day.length === 2 && month.length === 2 && year.length === 4) {
            return `${year}-${month}-${day}`;
        }
    }
    
    return dateString; // Return as is if conversion fails
}

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

    staffForm.addEventListener('submit', async function (e) {
        e.preventDefault();
        
        if (submitting) return;
        submitting = true;

        const submitBtn = staffForm.querySelector('button[type="submit"]');
        const originalBtnHtml = submitBtn?.innerHTML;

        if (submitBtn) {
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<span class="loading loading-spinner"></span> Saving Staff...';
        }

        try {
            const formData = new FormData(staffForm);
            
            // Convert date format before sending
            const joiningDate = formData.get('joining_date');
            if (joiningDate) {
                formData.set('joining_date', convertDateFormat(joiningDate));
            }
            
            // Rename fields to match controller
            if (formData.has('member_name')) {
                formData.set('full_name', formData.get('member_name'));
                formData.delete('member_name');
            }
            
            if (formData.has('member_email')) {
                formData.set('email', formData.get('member_email'));
                formData.delete('member_email');
            }
            
            if (formData.has('roles')) {
                formData.set('role_id', formData.get('roles'));
                formData.delete('roles');
            }
            
            if (formData.has('start_time')) {
                formData.set('shift_start_time', formData.get('start_time'));
                formData.delete('start_time');
            }
            
            if (formData.has('end_time')) {
                formData.set('shift_end_time', formData.get('end_time'));
                formData.delete('end_time');
            }
            
            if (formData.has('photo')) {
                formData.set('profile_picture', formData.get('photo'));
                formData.delete('photo');
            }

            // Log form data for debugging
            console.log('Form data being sent:');
            for (let [key, value] of formData.entries()) {
                console.log(`${key}:`, value);
            }

            const url = `/dashboard/staff/store`;
            
            const res = await fetch(url, {
                method: 'POST',
                headers: { 
                    'X-CSRF-TOKEN': getCsrfToken(), 
                    'Accept': 'application/json' 
                },
                body: formData,
            });

            const data = await res.json().catch(() => ({}));

            if (!res.ok) {
                const msg = data.message || Object.values(data.errors || {}).flat().join('\n');
                throw new Error(msg);
            }

            // Handle success
            Swal.fire('Success!', 'Staff member saved successfully!', 'success');
            staffForm.reset();
            
            // Reset profile preview
            const profilePreview = document.getElementById('profilePreview');
            if (profilePreview) {
                profilePreview.src = DEFAULT_IMG;
            }
            
            // Reset file name displays
            document.querySelectorAll('.file-name, .file-name-id').forEach(span => {
                span.textContent = '';
                span.classList.add('hidden');
            });
            document.querySelectorAll('.upload-instructions, .upload-instructions-id').forEach(div => {
                div.classList.remove('hidden');
            });

        } catch (error) {
            console.error('Error saving staff:', error);
            Swal.fire('Error!', error.message || 'Unexpected error occurred while saving staff.', 'error');
        } finally {
            submitting = false;
            if (submitBtn) {
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalBtnHtml;
            }
        }
    });
});