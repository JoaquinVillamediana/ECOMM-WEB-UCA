let links = document.getElementsByClassName("links")[0]
function toggleHamburguesa(){
    if (links.classList.contains("visible")){
        links.classList.remove("visible")
    }
    else{
        links.classList.add("visible")
    }
}