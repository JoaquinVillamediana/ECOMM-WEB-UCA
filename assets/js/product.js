function btnseleccionado(x) {
    var header = document.getElementById("talles")
    var act = header.getElementsByClassName("active")
    var len = act.length
    if (len != 0) {
        act[0].classList.remove("active")
    }
    var btns = header.getElementsByClassName("btn-talle")
    btns[x].classList.add("active")
}

function currentSlide(x) {
    var current = document.getElementById("images")
    dotselect(x)
    if (x === 1) {
        current.src = "assets/img/pelota1.jpeg"
    } else if (x === 2) {
        current.src = "assets/img/pelota2.jpeg"
    } else if (x === 3) {
        current.src = "assets/img/pelota3.jpeg"
    }
}

function dotselect(x) {
    var header = document.getElementById("dots")
    var act = header.getElementsByClassName("dot-active")
    var len = act.length
    if (len != 0) {
        act[0].classList.remove("dot-active")
    }
    var btns = header.getElementsByClassName("dot")
    btns[(x - 1)].classList.add("dot-active")
}