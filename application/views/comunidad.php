<main>
  <link rel="stylesheet" href="<?php echo base_url(); ?>recursos/css/comunidad/estilo.css">
  <?php if (isset($_SESSION['nick'])) : ?>
    <!-- HERRAMIENTA DE DIBUJO -->
    <div>
      <form method="post" action="<?php echo base_url() . 'index.php/comunidad/insertar_obra'; ?>" enctype="multipart/form-data" onsubmit="imagenFormulario()">
        Dale un titulo a la obra: <input type="text" name="titulo" required><br>
        <div id="coordenadas">(?,?)</div>
        <canvas id="lienzo"></canvas>
        <input type="hidden" name="datosImagen" id="datosImagen"><br>

        <div id="contenedor_selector_color">
          <div class="icono_grande" id="color_actual"></div>
          <div id="contenedor_colores"></div>
          <div class="icono_grande boton_grosor fino" id="1"></div>
          <div class="icono_grande boton_grosor medio" id="3"></div>
          <div class="icono_grande boton_grosor grueso" id="5"></div>
          <div class="icono_grande" id="boton_limpiar"></div>
        </div>
        <br>
        <input type="submit" value="Subir">
      </form>
      <script src="<?php echo base_url(); ?>recursos/javascript/comunidad/logicaLienzo.js"></script>
      <script src="<?php echo base_url(); ?>recursos/javascript/comunidad/subirImagen.js"></script>
    </div>
  <?php endif; ?>

  <div>
    <h2>Obras</h2>
    <?php
    if (isset($listaObras)) {
      $direccionBase = $_SERVER['DOCUMENT_ROOT'] . str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);
      foreach ($listaObras as $obra) {
        echo '<div>';
        echo $obra['titulo'] . '<br>';
        echo $obra['autor'] . '<br>';
        echo '<img src="' . base_url() . $obra['ubicacion'] . '" width="360" height="220"/><br>';
        if (isset($_SESSION['es_Admin'])) : ?>
          <form action="<?php echo base_url() . 'index.php/comunidad/eliminar_obra'; ?>" method="post">
            <input type="hidden" name="id" value="<?php echo $obra['id']; ?>">
            <input type="hidden" name="ubicacion" value="<?php echo $obra['ubicacion']; ?>">
            <input type="submit" value="Eliminar">
          </form>
    <?php
        endif;
        echo '</div><hr>';
      }
    }
    ?>
  </div>
</main>
</body>

</html>