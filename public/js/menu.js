const menu=document.getElementsByClassName('menu_all')
const show_close=document.getElementById('show__close'),
      show_menu=document.getElementById('show__menu')

function show_menu_f()
{
    show_menu.style.display = "none";
    show_close.style.display = "flex";
    menu.style.display = "flex";

}
function close_menu_f()
{
    show_close.style.display = "none";
    show_menu.style.display = "flex";
    menu.style.display = "none";


}
