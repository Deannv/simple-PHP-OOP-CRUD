

function prevImage() {
    const formFile = document.getElementById('upload');
    const [file] = formFile.files;
    console.table(file)
    if (file) {
        document.getElementById('prevImg').src = URL.createObjectURL(file)
    }
}


const form = document.theForm;
const namaError = document.getElementById('namaError');
const passwordError = document.getElementById('passwordError');
const retypePasswordError = document.getElementById('retypePasswordError');
const emailError = document.getElementById('emailError');
const alamatError = document.getElementById('alamatError');
const kotaError = document.getElementById('kotaError');
const telpError = document.getElementById('telpError');


retypePasswordError.style.visibility = 'hidden';
namaError.style.visibility = 'hidden';

function checkRetypePass(e) {
    if (form.password.value == '') {
        passwordError.innerHTML = 'Please fill the password first.';
        passwordError.style.visibility = 'visible';
        return false;
    }
    else {
        passwordError.innerHTML = '‎';
        passwordError.style.visibility = 'hidden';
    }
    if (e.value != form.password.value && form.password.value != '') {
        retypePasswordError.innerHTML = 'Password must be the same.';
        retypePasswordError.style.visibility = 'visible';
        return false;
    } else {
        retypePasswordError.innerHTML = '‎';
        retypePasswordError.style.visibility = 'hidden';
    }
    return true;
}


function checkPassword() {
    checkRetypePass(form.retypePassword)
    const pf = form.password.value;
    result = false;
    if (pf.length < 8 || !(/\d/.test(pf))) result = false;
    if (/\d/.test(pf) && pf.length >= 8) result = true

    if (!result) {
        passwordError.innerHTML = 'Password must have a number or 8 chr long.';
        passwordError.style.visibility = 'visible';
        return false;
    }
    else {
        passwordError.innerHTML = '‎';
        passwordError.style.visibility = 'hidden';
    }
    return true;
}

function checkName(e) {
    if (e.value.length < 5) {
        namaError.innerHTML = 'Name must be atleast 5 chars.';
        namaError.style.visibility = 'visible';
    }
    else {
        namaError.innerHTML = '‎';
        namaError.style.visibility = 'hidden';
    }
}

function checkEmail(e) {
    const regex = /^[a-zA-Z0-9-]+@[a-zA-Z0-9-]+(?:\.[a-z0-9-]+)*$/;
    if (!e.value.match(regex)) {
        emailError.innerHTML = 'Invalid email format.';
        emailError.style.visibility = 'visible';
        return false;
    }
    else {
        emailError.innerHTML = '‎';
        emailError.style.visibility = 'hidden';
    }
    return true;
}

function validateSubmit() {
    if (!checkEmail(form.email)) form.email.value = '';
    if (!checkPassword()) form.password.value = '';
    if (!checkRetypePass(form.retypePassword)) {
        form.password.value = '';
        form.retypePassword.value = '';
    }

    return false;
}