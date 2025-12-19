// untuk melihat password
const togglePassword = document.getElementById('togglePassword');
togglePassword.addEventListener('click', () => {
    const type = document.getElementById('password');
    if (type.type === 'password') {
        type.type = 'text';
    } else {
        type.type = 'password';
    }
})