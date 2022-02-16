function validateInput() {
    event.preventDefault();
    var img = document.getElementById("image").value;
    var errors = false;

    if (img == "") {
        document.getElementById("image").style.cssText = 'border-color: red';
        errors = true;
    } else {
        document.getElementById("image").style.cssText = 'border: 1px solid rgba(14, 54, 201, .5);';
    }

    if (!errors) {
        document.getElementById("bannerForm").submit();
    }
}