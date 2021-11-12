function validateFields() {
    event.preventDefault();
    var name = document.querySelector('#name input').value;
    var email = document.querySelector('#email input').value;
    var password = document.querySelector('#password input').value;
    var password_confirm = document.querySelector('#password_confirm input').value;
    var errors = false;

    if (name.length < 3 || name.length > 60) {
        document.querySelector('#name input').style.cssText = 'border-color: red';
        document.querySelector('#name .error').style.cssText = "display: block";
        errors = true;
    } else {
        document.querySelector('#name input').style.cssText = 'border: 1px solid #ced4da;';
        document.querySelector('#name .error').style.cssText = "display: none";

    }

    if (!isEmail(email)) {
        document.querySelector('#email input').style.cssText = 'border-color: red';
        document.querySelector('#email .error').style.cssText = "display: block";
        errors = true;
    } else {
        document.querySelector('#email input').style.cssText = 'border: 1px solid #ced4da;';
        document.querySelector('#email .error').style.cssText = "display: none";

    }

    if (password.length < 8 || password.length > 60) {
        document.querySelector('#password input').style.cssText = 'border-color: red';
        document.querySelector('#password .error').style.cssText = "display: block";
        errors = true;
    } else {
        document.querySelector('#password input').style.cssText = 'border: 1px solid #ced4da;';
        document.querySelector('#password .error').style.cssText = "display: none";

    }
    if (password != password_confirm) {
        document.querySelector('#password_confirm input').style.cssText = 'border-color: red';
        document.querySelector('#password_confirm .error').style.cssText = "display: block";
        errors = true;
    } else {
        document.querySelector('#password_confirm input').style.cssText = 'border: 1px solid #ced4da;';
        document.querySelector('#password_confirm .error').style.cssText = "display: none";

    }

    if (!errors) {
        window.location.href = "./index.html";
    }
}

function isEmail(email) {
    const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}