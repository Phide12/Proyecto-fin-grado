<main>

  <div class="hero-image hero_exposiciones">
    <div class="hero-text">
      <h1 style="font-size:50px">Exposiciones online</h1>
      <p>Descubre nuestras ultimas exposiciones.</p>
    </div>
  </div>

  <?php if (isset($_SESSION['es_Admin'])) : ?>
    <div class="contenedor-secundario contenedor-transparente">
      <a href="<?php echo base_url() . 'index.php/exposicion/vista_exposicion_creacion'; ?>">
        <h3>Herramienta para crear exposiciones</h3>
      </a>
    <?php endif; ?>
    </div>

    <!-- BARRA DE BUSQUEDA -->
    <div class="contenedor-busqueda panel_informacion">
      <p class="busqueda">
        <input type="text" id="buscar_exposicion" placeholder="Buscar Exposición">
        <a class="item-bt icono_buscar" id="boton_buscar"></a>
      </p>
      <p id="panel_botones">
        <a class="item-bt icono_aleatorio" id="boton_random"></a>
      </p>
    </div>
    <hr class="separador_busqueda"/>

    <div class="contenedor-secundario contenedor-transparente panel_informacion">
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
      <script src="<?php echo base_url(); ?>recursos/javascript/exposicion/listarExposiciones.js"></script>
    <?php } ?>
    <ol class="contenedor-secundario contenedor-blanco contenedor-rejilla" id="catalogo_exposiciones">

    </ol>

</main>


</body>
</html>