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
  filtroOscuro.style.transition = '0.5s'
}

function abrirMenu() {
  sideNav.style.left = '0';
  document.body.style.left = anchura;
  filtroOscuro.style.opacity = 1;
  filtroOscuro.style.pointerEvents = 'auto';
}
function cerrarMenu() {
  sideNav.style.left = '-' + anchura;
  document.body.style.left = '0';
  filtroOscuro.style.opacity = 0;  
  filtroOscuro.style.pointerEvents = 'none';

}