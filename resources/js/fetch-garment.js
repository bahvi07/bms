document.addEventListener('DOMContentLoaded', () => {
    document.addEventListener('change', async (e) => {
        if (e.target.classList.contains('garment-type')) {
            let id = e.target.value;

            try {
                const url = `/dashboard/masters/relations/${id}/measurements`;
                const res = await fetch(url, { headers: { 'Accept': 'application/json' } });

                if (!res.ok) {
                    Swal.fire('Error!', 'Some error occurred', 'error');
                    return;
                }

                const data = await res.json();

                // ✅ find container relative to THIS order-item
                const container = e.target.closest('.order-item').querySelector('.measurement-fields');
                container.innerHTML = '';

                data.forEach(m => {
                    const div = document.createElement('div');
                    div.classList.add('mb-2');
                    div.innerHTML = `
                        <label class="block text-sm font-medium text-gray-700">${m.label}*</label>
                        <input type="text" 
                               name="measurements[${id}][${m.id}]" 
                               placeholder="${m.description || ''}" 
                               class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm p-2 m-f" />
                    `;
                    container.appendChild(div);
                });

            } catch (err) {
                Swal.fire('Error!', err.message || 'Unexpected error occurred.', 'error');
            }
        }
    });
});
