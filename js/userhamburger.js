const hamburger= document.getElementById("hamburger");
const menu_overlay=document.getElementById("menu-overlay");

hamburger.addEventListener('click', showMenu);
menu_overlay.addEventListener('click', hideMenu);

function showMenu(){
    document.getElementById("menu").style.width = "14rem";
    document.getElementById("menu-overlay").style.display = "block";
}
function hideMenu(){
    document.getElementById("menu").style.width = "0";

    setTimeout(function() {
        document.getElementById("menu-overlay").style.display = "none";
    },500);
     

}