document.addEventListener('DOMContentLoaded', cargarCabecera); 

function cargarCabecera() {
  sideNav = document.getElementById("sideNav");
  filtroOscuro = document.getElementById('filtro_oscuro');
  filtroOscuro.style.position = 'fixed';
  filtroOscuro.style.height = screen.height + 'px';  
  filtroOscuro.addEventListener('click', cerrarMenu);
  document.getElementById('boton_abrir_menu').addEventListener('click', abrirMenu);
  document.getElementById('boton_cerrar_menu').addEventListener('click', cerrarMenu);
  anchura = window.getComputedStyle(sideNav).getPropertyValue('width');
  cerrarMenu();
}

function abrirMenu() {
  sideNav.style.left = '0';
  document.body.style.left = anchura;
  filtroOscuro.style.display = 'block';
}
function cerrarMenu() {
  sideNav.style.left = '-' + anchura;
  document.body.style.left = '0';
  filtroOscuro.style.display = 'none';

}