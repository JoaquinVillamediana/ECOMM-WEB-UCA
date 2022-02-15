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
    current.src = imagenes[x-1]
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