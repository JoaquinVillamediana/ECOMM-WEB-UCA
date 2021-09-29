function btnseleccionado(x){
  var header = document.getElementById("talles")
  var act = header.getElementsByClassName("active")
  var len = act.length
  if (len!=0){
    act[0].classList.remove("active")
  }
  var btns = header.getElementsByClassName("btn-talle")
  btns[x].classList.add("active")
}

