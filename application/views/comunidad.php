<main>
  <link rel="stylesheet" href="<?php echo base_url(); ?>recursos/css/comunidad/estilo.css">

  <div class="hero-image hero_comunidad">
    <div class="hero-text">
      <h1 style="font-size:50px">Comunidad</h1>
      <p>Crea y descubre obras creadas por nuestros usuarios.</p>
      <?php if (isset($_SESSION['nick'])) : ?>
    </div>
  </div>
  <!-- HERRAMIENTA DE DIBUJO -->
  <div class="contenedor-rejilla">

    <!-- lienzo y coordenadas -->
    <div>
      <div class="ocultar_movil" id="coordenadas" style="text-align: center">(?,?)</div>
      <canvas id="lienzo"></canvas>
    </div>

    <!-- herramientas y formulario -->
    <div class="contenedor-secundario" style="margin: auto; width: 360px">

      <div class="contenedor_herramientas">
        <div class="bloque_herramientas">
          <div class="icono_grande" id="color_actual"></div>
        </div>
        <div class="bloque_herramientas" id="contenedor_selector_color">
          <div id="contenedor_colores"></div>
        </div>
        <div class="bloque_herramientas">
          <div class="seleccionable item-bt icono_grande boton_grosor fino" id="1"></div>
          <div class="seleccionable item-bt icono_grande boton_grosor medio" id="3"></div>
          <div class="seleccionable item-bt icono_grande boton_grosor grueso" id="5"></div>
          <div class="seleccionable item-bt icono_grande" id="boton_limpiar"></div>
        </div>
      </div>

      <form method="post" action="<?php echo base_url() . 'index.php/comunidad/insertar_obra'; ?>" enctype="multipart/form-data" onsubmit="imagenFormulario()">
        <label for="titulo">Título <span class="requerido">*</span></label>
        <input type="text" name="titulo" maxlength="35" required><br>
        <input type="hidden" name="datosImagen" id="datosImagen">
        <input type="submit" value="Subir">
      </form>

    </div>
  </div>
  <script src="<?php echo base_url(); ?>recursos/javascript/comunidad/logicaLienzo.js"></script>
  <script src="<?php echo base_url(); ?>recursos/javascript/comunidad/subirImagen.js"></script>


<?php else : ?>
  <br>
  <b><a href="<?php echo base_url() . 'index.php/usuario/vista_login'; ?>">Inicia sesión para comenzar a crear.</a></br>
    </div>
    </div>
  <?php endif; ?>

  <?php
  if (isset($listaObras)) { ?>
    <div class="polygon-wrapper">
      <div class="polygon-text">
        <h1 style="font-size:50px">Colección de obras</h1>
        <p> Descubre todas las imagenes creadas por nuestra comunidad </p>
      </div>
      <div class="polygon-image polygon_comunidad"></div>
    </div>
    <div class="contenedor-secundario contenedor-rejilla">
      <?php
      foreach ($listaObras as $obra) : ?>
        <div class="exposicion_tarjeta obra">
          <div class="exposicion_header">
            <h3 class="exposicion_header_titulo"><?php echo $obra['titulo']; ?></h3>
            <h3 class="exposicion_header_subtitulo"><?php echo $obra['autor']; ?></h3>
          </div>
          <img src="<?php echo base_url() . $obra['ubicacion']; ?>" /><br>
          <?php if (isset($_SESSION['es_Admin'])) : ?>
            <form action="<?php echo base_url() . 'index.php/comunidad/eliminar_obra'; ?>" method="post">
              <input type="hidden" name="id" value="<?php echo $obra['id']; ?>">
              <input type="hidden" name="ubicacion" value="<?php echo $obra['ubicacion']; ?>">
              <input type="submit" value="Eliminar">
            </form>
          <?php endif; ?>
        </div>
    <?php
      endforeach;
      echo '</div>';
    }
    ?>
    </div>
</main>
</body>

</html>