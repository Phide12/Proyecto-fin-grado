document.addEventListener('DOMContentLoaded', cargarLista);

function cargarLista() {
  if (typeof listaFavoritos !== 'undefined') {
    cargarBotonFavoritos();
  }
  document.getElementById('boton_buscar').addEventListener('click', mostrarListadoExposiciones);
  document.getElementById('boton_resetear').addEventListener('click', resetearBusqueda);
  document.getElementById('boton_random').addEventListener('click', redirigirExposicionRandom);
  mostrarListadoExposiciones();
}

function resetearBusqueda() {
  document.getElementById('buscar_exposicion').value = '';
  botonFavoritos.innerHTML = 'Ver Favoritos';
  mostrandoFavoritos = false;
  mostrarListadoExposiciones();
}

function mostrarListadoExposiciones() {
  document.getElementById('catalogo_exposiciones').innerHTML = '';
  numeroResultadosBusqueda = 0;
  /* FILTRADO DE EXPOSICIONES QUE SE MOSTRARAN */
  if (typeof listaFavoritos !== 'undefined' && mostrandoFavoritos) {
    for (let i = 0; i < listaExposiciones.length; i++) {
      if (comprobarFavoritos(listaExposiciones[i].id) && comprobarBusqueda(listaExposiciones[i].titulo)) {
        listarExposicion(listaExposiciones[i]);
        numeroResultadosBusqueda++;
      }
    }
  } else {
    for (let i = 0; i < listaExposiciones.length; i++) {
      if (comprobarBusqueda(listaExposiciones[i].titulo)) {
        listarExposicion(listaExposiciones[i]);
        numeroResultadosBusqueda++;
      }
    }
  }
  mostrarDatos();
}

function comprobarFavoritos(idExposicion) {
  for (let j = 0; j < listaFavoritos.length; j++) {
    if (listaFavoritos[j].id_exposicion == idExposicion) {
      return true;
    }
  }
  return false;
}

function comprobarBusqueda(tituloExposicion) {
  let valorBusqueda = document.getElementById('buscar_exposicion').value;
  if (valorBusqueda != null && valorBusqueda != "") {
    return tituloExposicion.includes(valorBusqueda);
  }
  return true;
}

function listarExposicion(exposicion) {
  /* CREACION DE LA VISTA PREVIA PARA CADA EXPOSICION  */

  let titulo = document.createElement('h3');    /* titulo */
  titulo.className = 'exposicion_header_titulo';
  titulo.innerHTML = exposicion.titulo;

  let subtitulo = document.createElement('h3');   /* subtitulo */
  subtitulo.className = 'exposicion_header_subtitulo';
  subtitulo.innerHTML = exposicion.autor;

  let headerExposicion = document.createElement('div');   /* contenedor header */
  headerExposicion.className = 'exposicion_header';
  headerExposicion.appendChild(titulo);
  headerExposicion.appendChild(subtitulo);

  let imagenPortada = new Image(360, 240);    /* imagen portada */
  imagenPortada.src = rutaServidor + exposicion.portada;

  let tarjetaExposicion = document.createElement('li');   /* contenedor */
  tarjetaExposicion.className = 'exposicion_tarjeta';
  tarjetaExposicion.appendChild(headerExposicion);
  tarjetaExposicion.appendChild(imagenPortada);

  let enlaceBloque = document.createElement('a');   /* enlace */
  enlaceBloque.href = rutaServidor + 'index.php/exposicion/vista_exposicion_individual?id=' + exposicion.id;
  enlaceBloque.appendChild(tarjetaExposicion);

  /* una vez creada la vista previa de la exposicion se añade a la lista */
  document.getElementById('catalogo_exposiciones').appendChild(enlaceBloque);
}

function mostrarDatos() {
  document.getElementById('mostrar_resultados_totales').innerHTML = listaExposiciones.length;
  document.getElementById('mostrar_resultados_busqueda').innerHTML = numeroResultadosBusqueda;
}

function cargarBotonFavoritos() {
  botonFavoritos = document.createElement('button');
  botonFavoritos.className = 'icono_favoritos';
  botonFavoritos.innerHTML = 'Ver Favoritos';
  document.getElementById('panel_botones').appendChild(botonFavoritos);
  botonFavoritos.addEventListener('click', cambiarModoFavoritos)
  mostrandoFavoritos = false;
}

function cambiarModoFavoritos() {
  if (mostrandoFavoritos) {
    botonFavoritos.innerHTML = 'Ver Favoritos';
    mostrandoFavoritos = false;
  } else {
    botonFavoritos.innerHTML = 'Ocultar Favoritos';
    mostrandoFavoritos = true;
  }
  mostrarListadoExposiciones();
}

function redirigirExposicionRandom() {
  if (typeof listaExposiciones !== 'undefined') {
      let id_exposicion = listaExposiciones[Math.floor(Math.random() * listaExposiciones.length)].id;
      window.location.replace(rutaServidor + 'index.php/exposicion/vista_exposicion_individual?id=' + id_exposicion);
  }
}