document.addEventListener('DOMContentLoaded', cargarLienzo);
window.addEventListener('resize', cargarLienzo);
var coordenadas = document.getElementById('coordenadas');
var colorActual = '#000000';
var grosorLinea = 1;
var pintarActivo = false;


function cargarLienzo() {
  lienzo = document.getElementById('lienzo');
  lienzoCtx = lienzo.getContext('2d');
  valorAnchura = window.getComputedStyle(lienzo).getPropertyValue("width")
  valorAltura = window.getComputedStyle(lienzo).getPropertyValue("height")
  lienzo.width = valorAnchura.substr(0, valorAnchura.length - 2);
  lienzo.height = valorAltura.substr(0, valorAltura.length - 2);
  lienzo.addEventListener('mousemove', comprobarTrazo);
  lienzo.addEventListener('mouseout', limpiarCoordenadas);

  document.getElementById('boton_limpiar').addEventListener('click', limpiarLienzo);
  limpiarLienzo();
  cargarSelectorColor();
  cargarSelectorGrosor();
}

function comprobarTrazo(evento) {

  posX = Math.round(evento.clientX - lienzo.offsetLeft + window.pageXOffset);
  posY = Math.round(evento.clientY - lienzo.offsetTop + window.pageYOffset);
  coordenadas.innerHTML = '(' + posX + ',' + posY + ')';
  if (evento.buttons == 0 && pintarActivo) {
    lienzoCtx.closePath();
    pintarActivo = false;
  } else if (evento.buttons == 1) {
    if (!pintarActivo) {
      pintarActivo = true;
      lienzoCtx.beginPath();
      lienzoCtx.lineCap = 'round';
      lienzoCtx.lineJoin = 'round';
      lienzoCtx.lineWidth = grosorLinea * 4;
      lienzoCtx.strokeStyle = colorActual;
      lienzoCtx.moveTo(posX, posY);
    }
    lienzoCtx.lineTo(posX, posY);
    lienzoCtx.stroke();
  }
}

function limpiarCoordenadas() {
  pintarActivo = false;
  coordenadas.innerHTML = '(?,?)';
}

function limpiarLienzo() {
  lienzoCtx.beginPath();
  lienzoCtx.fillStyle = 'white';
  lienzoCtx.fillRect(0, 0, lienzo.width, lienzo.height);
  lienzoCtx.fill();

  lienzoCtx.closePath();
}

function cargarSelectorColor() {
  contenedorColores = document.getElementById('contenedor_colores');
  contenedorColores.innerHTML = '';
  arrayColores = [
    //primera fila
    '#ffffff',
    '#c1c1c1',
    '#ef130b',
    '#ff7100',
    '#ffe400',
    '#00cc00',
    '#00b2ff',
    '#231fd3',
    '#a300ba',
    '#d37caa',
    '#a0522d',
    //segunda fila
    '#000000',
    '#4c4c4c',
    '#740b07',
    '#c23800',
    '#e8a200',
    '#005510',
    '#00569e',
    '#0e0865',
    '#550069',
    '#a75574',
    '#63300d'
  ];
  for (let i = 0; i < arrayColores.length; i++) {
    let nuevoColor = document.createElement('div');
    nuevoColor.id = i;
    nuevoColor.className = 'seleccionable';
    nuevoColor.style.backgroundColor = arrayColores[i];
    nuevoColor.addEventListener('click', seleccionarColor);
    contenedorColores.appendChild(nuevoColor);
  }
  seleccionActual();
}

function cargarSelectorGrosor() {
  let listaBotones = document.getElementsByClassName('boton_grosor');
  for (let i = 0; i < listaBotones.length; i++) {
    listaBotones[i].addEventListener('click', seleccionarGrosor);
  }
  mostrarGrosorActual();
}

function seleccionarColor(evento) {
  let indice = evento.target.id;
  colorActual = arrayColores[indice];
  seleccionActual();
}

function seleccionarGrosor(evento) {
  grosorLinea = evento.target.id;
  mostrarGrosorActual();

}

function mostrarGrosorActual() {
  let listaBotones = document.getElementsByClassName('boton_grosor');
  for (let i = 0; i < listaBotones.length; i++) {
    if (listaBotones[i].id == grosorLinea) {
      listaBotones[i].style.border = 'solid 1px #202020';
    } else {
      listaBotones[i].style.border = 'solid 1px #DDDDDD';
    }
  }
}

function seleccionActual() {
  document.getElementById('color_actual').style.backgroundColor = colorActual;
}
