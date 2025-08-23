// resources/js/relations.js
import { getCsrfToken } from './main';

document.addEventListener('DOMContentLoaded', () => {
  const relationForm = document.getElementById('relation-form');
  if (!relationForm) return;

  let submitting = false;
  relationForm.addEventListener('submit', async (event) => {
    event.preventDefault();
    if (submitting) return;
    submitting = true;

    const submitBtn = relationForm.querySelector('button[type="submit"]');
    const originalBtnHtml = submitBtn?.innerHTML;

    if (submitBtn) {
      submitBtn.disabled = true;
      submitBtn.innerHTML = '<span class="loading loading-spinner"></span> Saving...';
    }

    try {
      // get hidden id if available (for edit mode)
      const idInput = relationForm.querySelector('input[name="id"]');
      const id = idInput ? idInput.value.trim() : null;

      const url = id 
        ? `/dashboard/masters/relations/${id}`   // update
        : `/dashboard/masters/relations`;        // create

      const fd = new FormData(relationForm);
      if (id) fd.append('_method', 'PUT');

      const res = await fetch(url, {
        method: 'POST',
        headers: { 
          'X-CSRF-TOKEN': getCsrfToken(), 
          'Accept': 'application/json' 
        },
        body: fd,
      });

      const data = await res.json().catch(() => ({}));
      if (!res.ok) {
        const msg = data.message || Object.values(data.errors || {}).flat().join('\n');
        throw new Error(msg);
      }

      // success handling
      Swal.fire('Success!', data.message || 'Relation saved successfully.', 'success');

      // close modal & reset form
      document.getElementById('relationModal')?.close();
      relationForm.reset();

      // reload table (simplest way for now)
      location.reload();

    } catch (err) {
      Swal.fire('Error!', err.message || 'Unexpected error occurred while saving relation.', 'error');
    } finally {
      submitting = false;
      if (submitBtn) {
        submitBtn.disabled = false;
        submitBtn.innerHTML = originalBtnHtml;
      }
    }
  });
});
