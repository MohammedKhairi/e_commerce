// $(document).ready(function () {
  
//     $('ul.navbar-nav > li').click(function (e) {
//         $('ul.navbar-nav > li')
//             .removeClass('active');
//         $(this).addClass('active');
//     });
// });
// function dodajAktywne(elem) {
//     console.log(elem);
//     //alert(elem);
//     // get all 'a' elements
//     var a = document.getElementsByTagName('a');
//     // loop through all 'a' elements
//     for (i = 0; i < a.length; i++) {
//         // Remove the class 'active' if it exists
//         a[i].classList.remove('active')
//     }
//     // add 'active' classs to the element that was clicked
//     elem.classList.add('active');
// }

const cuurentlocation=location.href;
const menuitem=document.querySelectorAll('a.getactive');
const menulenth=menuitem.length;

for(let i=0;i<menulenth;i++)
{
    menuitem[i].classList.remove('active2')
    if(menuitem[i].href==cuurentlocation)
    {
        menuitem[i].className="active2";
    }
}