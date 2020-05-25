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

cargarCabecera();

/**
 * Aplica efecto de transicion al hacer scroll en los elementos con clase 
 * 'animacion-scroll'
 */
function cargarAnimacionesScroll() {
  window.addEventListener('scroll', cargarEnScroll);
  cargarEnScroll('animacion-scroll');
}

function cargarEnScroll() {
  let listaElementos = (document.getElementsByClassName('animacion-scroll'));

  for (let i = 0; i < listaElementos.length; i++) {
    let elemento = listaElementos[i];
    let alturaCarga = window.pageYOffset + window.innerHeight;
    let alturaElemento = elemento.offsetTop;

    if (alturaCarga >= alturaElemento) {
      elemento.classList.remove("animacion-scroll");
      elemento.classList.add("scroll-visible");
    }
  }
}

cargarAnimacionesScroll();


/**
 * Scroll automatico
 */
function cargarAutoScroll() {
  document.getElementById('click-scroll').addEventListener('click', autoScroll);
  document.getElementById('btn-ver-ahora').addEventListener('click', autoScroll);
}

function autoScroll() {  
  window.scrollTo({top: window.innerHeight - 80, behavior: 'smooth'});
}

cargarAutoScroll();