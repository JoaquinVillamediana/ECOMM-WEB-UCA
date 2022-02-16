function validateFields() {
    event.preventDefault();
    var name = document.getElementById("name-input").value;

    var errors = false;

    if (name.length >= 3 && name.length < 60) {
        document.getElementById("name-input").style.cssText = 'border: 1px solid #ced4da;';
        document.querySelector("#name .error").style.cssText = 'display: none;';
    } else {
        document.getElementById("name-input").style.cssText = 'border-color: red';
        document.querySelector("#name .error").style.cssText = 'display: block;';
        errors = true;
    }

    if (!errors) {
        document.getElementById("createForm").submit();
    }
}