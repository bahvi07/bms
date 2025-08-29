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
