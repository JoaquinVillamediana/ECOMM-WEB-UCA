function validateForm() {
    event.preventDefault();
    var name = document.getElementById("product-name").value;
    var errors = false;

    if (name.length > 1) {
        document.getElementById("product-name").style.cssText = 'border: 1px solid #ced4da;';
    } else {
        document.getElementById("product-name").style.cssText = 'border-color: red';
        errors = true;
    }

    if (!errors) {
        window.location.href = "";
    }
}