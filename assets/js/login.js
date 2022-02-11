function validateFields() {
    event.preventDefault();
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;
    var errors = false;

    if (!isEmail(email)) {
        document.getElementById("email").style.cssText = 'border-color: red';
        document.getElementById("error").style.cssText = "display: block";
        errors = true;
    } else {
        document.getElementById("email").style.cssText = 'border: 1px solid #ced4da;';

    }

    if (password.length < 3) {
        document.getElementById("password").style.cssText = 'border-color: red';
        document.getElementById("error").style.cssText = "display: block";
        errors = true;
    } else {
        document.getElementById("password").style.cssText = 'border: 1px solid #ced4da;';
    }

    if (!errors) {
        document.getElementById('LoginForm').submit();
    }
}

function isEmail(email) {
    const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}