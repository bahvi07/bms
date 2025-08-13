export function togglePassword() {
    const pswd = document.getElementById('password');
    const toggleEye = document.getElementById('toggleEye');

    if (pswd.type === 'password') {
        pswd.type = 'text';
        toggleEye.classList.remove('fa-eye-slash');
        toggleEye.classList.add('fa-eye');
    } else {
        pswd.type = 'password';
        toggleEye.classList.remove('fa-eye');
        toggleEye.classList.add('fa-eye-slash');
    }
}

document.addEventListener("DOMContentLoaded", () => {
    const toggleEye = document.getElementById("toggleEye");
    if (toggleEye) {
        toggleEye.addEventListener("click", togglePassword);
    }
});
