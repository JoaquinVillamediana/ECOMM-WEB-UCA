function addAttr() {
    event.preventDefault();
    var name = document.getElementById("attr-input").value;

    if (name.length < 1) {
        document.getElementById("attr-input").style.cssText = 'border-color: red';
    } else {
        document.getElementById("attr-input").style.cssText = 'border: 1px solid #ced4da;';
        var input = document.createElement("input");
        var attr_id = document.getElementById("attr-input").getAttribute('data-attr-id');

        input.type = "hidden";
        input.name = "attr[]";
        input.id = "attr-" + (parseInt(attr_id));
        input.value = name;

        document.getElementById("attr-combo").append(input);

        var marker = document.createElement("li");
        var attr_list = document.getElementById("ul-attr");

        marker.innerHTML = name + '<a href="" onclick="delAttr(' + attr_id + ')" id="del-attr-' + attr_id + '" class="del-attr">X</a>';
        attr_list.append(marker);

        document.getElementById("attr-input").value = "";
        document.getElementById("attr-input").setAttribute('data-attr-id', parseInt(attr_id) + 1);
    }

}

function delAttr(id) {
    event.preventDefault();
    var input = document.getElementById("attr-" + id);
    var marker = document.getElementById("del-attr-" + id).parentNode;

    marker.parentNode.removeChild(marker);
    input.parentNode.removeChild(input);
}

function addImage(object) {
    object.style.cssText = 'display: none';

    var img_id = object.id.split('-')[1];
    var input = document.createElement("input");
    var marker = document.createElement("li");
    var img_name = object.value.split(/(\\|\/)/g).pop();
    var img_list = document.getElementById("ul-imgs");

    input.type = "file";
    input.name = "image[]";
    input.id = "img-" + (parseInt(img_id) + 1);
    input.setAttribute("onchange", "addImage(this)");
    object.parentNode.insertBefore(input, object.nextSibling);


    marker.innerHTML = img_name + '<a href="" onclick="delImage(' + img_id + ')" id="del-img-' + img_id + '" class="del-img">X</a>';
    img_list.append(marker);
}

function delImage(id) {
    event.preventDefault();
    var input = document.getElementById("img-" + id);
    var marker = document.getElementById("del-img-" + id).parentNode;

    marker.parentNode.removeChild(marker);
    input.parentNode.removeChild(input);
}


function validateFields() {
    event.preventDefault();
    var name = document.getElementById("name-input").value;
    var price = document.getElementById("price-input").value;
    var details = document.getElementById("details-input");
    var stock = document.getElementById("stock-input").value;
    var discount = document.getElementById("discount-input").value;
    var errors = false;

    if (name.length >= 3 && name.length < 60) {
        document.getElementById("name-input").style.cssText = 'border: 1px solid #ced4da;';
        document.querySelector("#name .error").style.cssText = 'display: none;';
    } else {
        document.getElementById("name-input").style.cssText = 'border-color: red';
        document.querySelector("#name .error").style.cssText = 'display: block;';
        errors = true;
    }

    if (price != '') {
        document.getElementById("price-input").style.cssText = 'border: 1px solid #ced4da;';
        document.querySelector("#price .error").style.cssText = 'display: none;';
    } else {
        document.getElementById("price-input").style.cssText = 'border-color: red';
        document.querySelector("#price .error").style.cssText = 'display: block;';
        errors = true;
    }

    if (parseInt(discount) >= 0 && parseInt(discount) < 100) {
        document.getElementById("discount-input").style.cssText = 'border: 1px solid #ced4da;';
        document.querySelector("#discount .error").style.cssText = 'display: none;';
    } else {
        document.getElementById("discount-input").style.cssText = 'border-color: red';
        document.querySelector("#discount .error").style.cssText = 'display: block;';
        errors = true;
    }

    if (parseInt(stock) >= 0) {
        document.getElementById("stock-input").style.cssText = 'border: 1px solid #ced4da;';
        document.querySelector("#stock .error").style.cssText = 'display: none;';
    } else {
        document.getElementById("stock-input").style.cssText = 'border-color: red';
        document.querySelector("#stock .error").style.cssText = 'display: block;';
        errors = true;
    }

    if (details.textLength > 3 && details.textLength < 1050) {
        document.getElementById("details-input").style.cssText = 'border: 1px solid #ced4da;';
        document.querySelector("#details .error").style.cssText = 'display: none;';
    } else {
        document.getElementById("details-input").style.cssText = 'border-color: red';
        document.querySelector("#details .error").style.cssText = 'display: block;';
        errors = true;
    }

    if (!errors) {
        window.location.href = "./index.php";
    }
}

function isEmail(email) {
    const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}