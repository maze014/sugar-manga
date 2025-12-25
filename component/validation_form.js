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

// cek password sudah memenuhi aturan atau tidak
const btn = document.getElementById('submit');
function cek_password(str) {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function () {
        document.getElementById('cek_password').innerHTML = this.responseText;
        // cek isi response
        if (this.responseText != '') {
            btn.disabled = true;
        } else {
            btn.disabled = false;
        }
    }
    xhttp.open("POST", "cek_password.php", true);
    xhttp.setRequestHeader('Content-type', "application/x-www-form-urlencoded");
    xhttp.send("password=" + encodeURIComponent(str));

}

//cek username sudah ada atau belum
function cek_username(str) {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function () {
        document.getElementById('cek_username').innerHTML = this.responseText;
        // cek isi response
        if (this.responseText != '') {
            btn.disabled = true;
        } else {
            btn.disabled = false;
        }
    }
    xhttp.open("POST", "cek_password.php", true);
    xhttp.setRequestHeader('Content-type', "application/x-www-form-urlencoded");
    xhttp.send("username=" + encodeURIComponent(str));
}

//cek username sudah ada atau belum form edit profile
function cek_username_edit(str) {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function () {
        document.getElementById('cek_username_edit').innerHTML = this.responseText;
        // cek isi response
        if (this.responseText != '') {
            btn.disabled = true;
        } else {
            btn.disabled = false;
        }
    }
    xhttp.open("POST", "cek_password.php", true);
    xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhttp.send("usernameEdit=" + encodeURIComponent(str));
}