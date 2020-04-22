document.addEventListener('DOMContentLoaded', cargarLista);

function cargarLista() {
  anchura = 360;
  altura = 240;
  if (listaFavoritos != null) {
    cargarBotonFavoritos();
  } else {
    mostrandoFavoritos = false;
  }
  document.getElementById('boton_buscar').addEventListener('click', mostrarListadoExposiciones);
  document.getElementById('boton_resetear').addEventListener('click', resetearBusqueda);
  
  
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
  if (listaFavoritos != null && mostrandoFavoritos) {
    for (let i = 0; i < listaExposiciones.length; i++) {      
      if (comprobarFavoritos(listaExposiciones[i].id) && comprobarBusqueda(listaExposiciones[i].titulo)) {
        console.log(listaExposiciones);
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
  if (valorBusqueda != null) {
    return tituloExposicion.includes(valorBusqueda);
  }
  return true;
}

function listarExposicion(exposicion) {
  /* CREACION DE LA VISTA PREVIA PARA CADA EXPOSICION  */
  /* header de la vista previa */
  let titulo = document.createElement('h2');    /* titulo */
  titulo.className = 'exposicion_header_titulo';
  titulo.innerHTML = exposicion.titulo;

  let subtitulo = document.createElement('h2');   /* subtitulo */
  subtitulo.className = 'exposicion_header_subtitulo';
  subtitulo.innerHTML = exposicion.autor;

  let headerExposicion = document.createElement('div');   /* contenedor header */
  headerExposicion.className = 'exposicion_header';
  headerExposicion.appendChild(titulo);
  headerExposicion.appendChild(subtitulo);

  /* portada */
  let imagenPortada = new Image(anchura, altura);
  imagenPortada.src = rutaServidor + exposicion.portada;

  let tarjetaExposicion = document.createElement('li');
  tarjetaExposicion.className = 'exposicion_tarjeta';
  tarjetaExposicion.appendChild(headerExposicion);
  tarjetaExposicion.appendChild(imagenPortada);

  let enlaceBloque = document.createElement('a');
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