document.addEventListener('DOMContentLoaded', function () {
    const importBtn = document.getElementById('importBtn');
    const importModal = document.getElementById('importModal');
    const submitBtn = document.getElementById('importSubmitBtn');

    if (importBtn && importModal) {
        importBtn.addEventListener('click', function () {
            importModal.showModal();
        });
    }

    if (submitBtn) {
        submitBtn.addEventListener('click', async (e) => {
            e.preventDefault();
            const form = document.querySelector('#importForm');
            const formData = new FormData(form);

            if (form.checkValidity()) {
                submitBtn.innerHTML = '<span class="loading loading-spinner"></span> Importing...';
                let url = `/dashboard/masters/import-garments`;

                try {
                    const response = await fetch(url, {
                        method: 'POST',
                        headers: {
                            "X-CSRF-TOKEN": getCsrfToken(),
                            "Accept": "application/json"
                        },
                        body: formData
                    });

                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }

                    const data = await response.json();
                    importModal.close();
                    Swal.fire({
                        icon: 'success',
                        title: 'Import Successful',
                        text: `${data.success} garments imported successfully!`,
                    }).then(() => {
                        // Optionally, you can refresh the page or update the UI
                        location.reload();
                         
                    });
                   
                } catch (error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Import Failed',
                        text: error.message,
                    });
                } finally {
                    submitBtn.innerHTML = 'Import';
                }
            }
        });
    }
});

function getCsrfToken() {
    return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
}
