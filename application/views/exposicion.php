<?php if (isset($_SESSION['es_Admin'])) : ?>
  <div>
    <a href="<?php echo base_url() . 'index.php/exposicion/vista_exposicion_creacion'; ?>">
      <h2>Acceder a la herramienta para crear exposiciones</h2>
    </a>
  <?php endif; ?>
  </div>

  <!-- BARRA DE BUSQUEDA -->
  <div>
    <input type="text" id="buscar_exposicion">
    <div id="panel_botones">
      <button class="icono_buscar" id="boton_buscar">Buscar</button>
      <button class="icono_resetear" id="boton_resetear">Resetear Busqueda</button>
    </div>
    <div id="panel_informacion">
      <span>Resultados Totales: <span id="mostrar_resultados_totales"></span></span>
      <span>Resultados Busqueda: <span id="mostrar_resultados_busqueda"></span></span>
    </div>
  </div>

  <!-- LISTA DE EXPOSICIONES -->
  <?php if (isset($listaExposiciones)) {
    echo '<script>';
    echo 'var rutaServidor = "' . base_url() . '";';
    echo 'var listaExposiciones = ' . json_encode($listaExposiciones) . ';';
    if (isset($listaFavoritos)) {
      echo 'var listaFavoritos = ' . json_encode($listaFavoritos) . ';';
    } else {
      echo 'var listaFavoritos = null;';
    }
    echo '</script>';
  ?>
    <script src="<?php echo base_url(); ?>recursos/javascript/exposicion/listarExposiciones.js"></script>
  <?php
  }
  ?>
  <ol id="catalogo_exposiciones">

  </ol>
  </body>

  </html>