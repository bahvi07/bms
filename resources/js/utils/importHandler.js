// resources/js/utils/importHandler.js

export function setupImport({ 
    importBtnId, 
    importModalId, 
    importFormId, 
    importSubmitBtnId, 
    endpoint, 
    entityName 
}) {
    document.addEventListener('DOMContentLoaded', function () {
        const importBtn = document.getElementById(importBtnId);
        const importModal = document.getElementById(importModalId);
        const submitBtn = document.getElementById(importSubmitBtnId);

        if (importBtn && importModal) {
            importBtn.addEventListener('click', function () {
                importModal.showModal();
            });
        }

        if (submitBtn) {
            submitBtn.addEventListener('click', async (e) => {
                e.preventDefault();
                const form = document.querySelector(`#${importFormId}`);
                const formData = new FormData(form);

                if (form.checkValidity()) {
                    submitBtn.innerHTML = '<span class="loading loading-spinner"></span> Importing...';

                    try {
                        const response = await fetch(endpoint, {
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
                            text: `${data.success} ${entityName} imported successfully!`,
                        }).then(() => location.reload());

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
}

function getCsrfToken() {
    return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
}
