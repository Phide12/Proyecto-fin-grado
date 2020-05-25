<main>
  <div class="hero-img-full" style="background-image: url(<?= base_url() . 'recursos/img/nicolas-olivares-G7_Um0dk-9Y-unsplash.jpg'; ?>)">
    <div class="hero-text">
      <h1>Exposiciones online</h1>
      <br>
      <h3>Descubre nuestras ultimas exposiciones.</h3>
      <br>
      <a class="btn btn-principal" id="btn-ver-ahora">Ver ahora</a>
      <br>
    </div>
  </div>

  <div class="clip-container-start" id="click-scroll">
    <div class="clip-start">
      <div class="scroll-down-arrow">
      </div>
    </div>
  </div>

  <div class="container-seccion">
    <div class="body-seccion container animacion-scroll">
      <div class="contenido-seccion">
        <div class="header-seccion">
          <h1>Explora las exposiciones</h1>
        </div>
        <div class="texto-seccion">
          Cientos de exposiciones estan esperandote en nuestra web, podras descubrir y disfrutar todo tipo de exposiciones. Nuestro equipo se esfuerza en crear
          las mejores exposiciones posibles para el disfrute de nuestra comunidad.
          <br><br>
          <span class="texto-color"></span>
          Siempre encontraras alguna exposición para ti, tambien podras registrarte y guardar facilmente las exposiciones que te gusten en favoritos
          para volver a visitarlas
          <br><br>
          <a class="btn btn-principal"> Ver Exposiciones</a>
        </div>
      </div>
      <div class="img-seccion img-seccion-exposicion" style="background-image: url(<?= base_url() . 'recursos/img/seccion/ross-sneddon-TG2L70rowAU-unsplash.jpg'; ?>)"></div>
    </div>
  </div>

  <div class="clip-container-end">
    <div class="clip-end">
    </div>
  </div>
  
  <div class="hero-img banner-seccion" style="background-image: url(<?= base_url() . 'recursos/img/yann-allegre-q9XgBcv1pA8-unsplash.jpg'; ?>)">
    <div class="banner-content">
      <div class="banner-text">
        <h1>Cloud Gallery<h1>
            <h2>Listado de Exposiciones</h2>
            <?php if (isset($_SESSION['es_Admin'])) : ?>
              <a class="btn btn-secundario" href="<?= base_url() . 'index.php/exposicion/vista_exposicion_creacion'; ?>">
                Herramienta para crear exposiciones
              </a>
            <?php endif; ?>
      </div>
    </div>
  </div>

  <!-- BARRA DE BUSQUEDA -->
  <div class="contenedor-busqueda container">
    <span class="busqueda">
      <div class="icono_buscar"></div>
      <input type="text" id="buscar_exposicion" placeholder="Buscar Exposición">
      <p id="panel_botones">
        <a class="item-bt icono_aleatorio" id="boton_random"></a>
      </p>
    </span>
  </div>
  <div class="contenedor-secundario bg-white container panel_informacion">
    <p>
      <span id="mostrar_resultados_busqueda"></span>
      de <span id="mostrar_resultados_totales"></span> exposiciones
      <span id="indicador_favoritos"></span>
    </p>
    <a class="item-bt icono_resetear" id="boton_resetear"></a>
  </div>




  <!-- LISTA DE EXPOSICIONES -->
  <?php if (isset($listaExposiciones)) {
    echo '<script>';
    echo 'var rutaServidor = "' . base_url() . '";';
    echo 'var listaExposiciones = ' . json_encode($listaExposiciones) . ';';
    if (isset($listaFavoritos)) {
      echo 'var listaFavoritos = ' . json_encode($listaFavoritos) . ';';
    }
    echo '</script>';
  ?>
    <script src="<?= base_url(); ?>recursos/javascript/exposicion/listarExposiciones.js"></script>
  <?php } ?>
  <ol class="contenedor-secundario contenedor-rejilla" id="catalogo_exposiciones">

  </ol>


</main>


</body>

</html>