document.addEventListener('DOMContentLoaded', cargarCabecera); 

function cargarCabecera() {
  sideNav = document.getElementById("sideNav");
  document.getElementById('boton_abrir_menu').addEventListener('click', abrirMenu);
  document.getElementById('boton_cerrar_menu').addEventListener('click', cerrarMenu);
  anchura = window.getComputedStyle(sideNav).getPropertyValue('width');
  cerrarMenu();
}

function abrirMenu() {
  sideNav.style.left = '0';
  document.body.style.left = anchura;
}
function cerrarMenu() {
  sideNav.style.left = '-' + anchura;
  document.body.style.left = '0';

}