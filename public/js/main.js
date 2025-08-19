function getCsrfToken() {
    return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
}

document.addEventListener("DOMContentLoaded", () => {
    const garmentForm = document.getElementById('garmentForm');

    if (garmentForm) {
       garmentForm.addEventListener('submit', async function (event) {
    event.preventDefault();

    const formData = new FormData(this);
    const url = this.getAttribute("action");

    try {
        let response = await fetch(url, {
            method: 'POST',
            headers: {
                "X-CSRF-TOKEN": getCsrfToken(),
                "Accept": "application/json" // 👈 important
            },
            body: formData
        });

        let data = await response.json();
        console.log("Garment added:", data);

        if (data.success) {
            alert(data.message);

            // Optionally close modal
            document.getElementById('my_modal_1').close();

            // Optionally reload or append to table
            location.reload(); // quick solution
        }

    } catch (err) {
        console.error("Error:", err);
    }
});

    }
});
