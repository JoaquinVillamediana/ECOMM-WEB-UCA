function validateForm() {
    event.preventDefault();
    var name = document.getElementById("product-name").value;
    var errors = false;

    if (!errors) {
        document.getElementById('seachForm').submit();
    }
}