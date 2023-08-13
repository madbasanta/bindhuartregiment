const btnMenu = document.querySelector(".btn-menu");
const Menu= document.getElementById("menu_on_click");
const cmenu = document.querySelector("ul.click_menu");
const cross = document.querySelector(".cross");

function show(){
    Menu.style.height = "100vh";
    cmenu.style.display = "inline-grid";
    cmenu.style.opacity = "1";
    cross.style.display = "block"; 
}
function donotshow(){
    Menu.style.height = "0vh";
    cmenu.style.display = "none";
    cmenu.style.opacity = "0";
    cross.style.display = "none";

}


