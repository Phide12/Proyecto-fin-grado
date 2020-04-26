<main>
  <div class="contenedor-secundario contenedor-blanco">
    <a href="<?php echo base_url() . 'index.php/exposicion/vista_general'; ?>">
      <h3>Volver</h3>
    </a>
  </div>

  <div class="contenedor-secundario contenedor-blanco">
    <div class="panel_informacion">
      <h1><?php echo $titulo; ?></h1>

      <?php if (isset($_SESSION['id'])) : ?>
        <form name="cambiarFav" action="<?php echo base_url() . 'index.php/exposicion/switch_favoritos'; ?>" method="post">
          <input type="hidden" name="id_usuario" value="<?php echo $_SESSION['id']; ?>">
          <input type="hidden" name="id_exposicion" value="<?php echo $_GET['id']; ?>">
          <?php
          if (isset($estadoFavoritos)) {
            if ($estadoFavoritos) {
              echo '<input type="submit" value="quitar favoritos" style="display:none">';
              echo '<a class="icono_fav_off item-bt" onclick="document.cambiarFav.submit()"></a>';
            } else {
              echo '<input type="submit" value="insertar favoritos" style="display:none">';
              echo '<a class="icono_fav_on item-bt" onclick="document.cambiarFav.submit()"></a>';
            } ?>
          <?php
          }
          ?>
        </form>

      <?php endif; ?>
    </div>
  </div>

  <div class="contenedor-secundario contenedor-transparente">
    <div class="panel_informacion">
      <p>N. Visitas: <b><?php echo $num_visitas; ?></b></p>
      <p>Val. Media: <b><?php echo $val_media; ?></b></p>
    </div>
  </div>

  <div class="contenedor-secundario contenedor-blanco">
    <div><?php echo $descripcion; ?></div>
    <h2><?php echo $autor; ?></h2>
    <img src="<?php echo base_url() . $portada; ?>" width="360" height="220" /><br>
    <h3><?php echo $num_visitas; ?></h3>
    <h3><?php echo $val_media; ?></h3>
  </div>

  <?php if (isset($_SESSION['es_Admin'])) : ?>
    <!-- AÑADIR CONTENIDOS -->
    <div class="contenedor-secundario contenedor-blanco">
      <div class="formulario">
      <form method="post" enctype="multipart/form-data">
        <input type="hidden" name="id_exposicion" value="<?php echo $id; ?>">
        <label for="contenido">Subir contenido de la exposición <span class="requerido">*</span> (3mb max - solo imágenes: png, jpg y jpeg)</label>
        <input type="file" name="contenido" required><br><br>
        <label for="comentario">Comentario del archivo subido <span class="requerido">*</span></label>
        <textarea name="comentario" cols="30" rows="10" placeholder="texto/descripcion que acompañara al archivo multimedia en la exposicion..."></textarea><br>
        <input type="submit" name="subir" value="Subir" formaction="<?php echo base_url() . 'index.php/exposicion/subir_contenido_exposicion'; ?>">
      </form>
      </div>
    </div>
  <?php endif; ?>

  <!-- CONTENIDOS -->
  <div class="contenedor-secundario contenedor blanco">
    <h2>Contenidos</h2>
    <?php
    if (isset($listaContenidos)) {
      foreach ($listaContenidos as $contenido) {
    ?>
        <img src="<?php echo base_url() . $contenido['ubicacion']; ?>" width="360" height="220" /><br>
        <div>
          <?php echo $contenido['comentario']; ?>
        </div>
        <?php
        if (isset($_SESSION['es_Admin'])) : ?>
          <form action="<?php echo base_url() . 'index.php/exposicion/eliminar_contenido'; ?>" method="post">
            <input type="hidden" name="id_contenido" value="<?php echo $contenido['id']; ?>">
            <input type="hidden" name="id_exposicion" value="<?php echo $_GET['id']; ?>">
            <input type="hidden" name="ubicacion" value="<?php echo $contenido['ubicacion']; ?>">
            <input type="submit" value="Eliminar">
          </form>
    <?php endif;
      }
    }
    ?>
  </div>

  <!-- VALORACIONES -->
  <?php if (isset($_SESSION['nick'])) { ?>
    <!-- CREAR VALORACION -->
    <div class="contenedor-secundario contenedor-blanco">
      <h3>Crear Valoracion</h3>
      <div class="formulario">
      <form action="<?php echo base_url() . 'index.php/exposicion/insertar_valoracion'; ?>" method="post">
        
      <input type="hidden" name="id_exposicion" value="<?php echo $_GET['id']; ?>">
        <label>Puntuacion <span class="requerido">*</span></label>
        <div class="contenedor_puntuacion">
          <input id="star5" name="puntuacion" type="radio" value="5" class="radio-btn hide" />
          <label for="star5">&#9734;</label>
          <input id="star4" name="puntuacion" type="radio" value="4" class="radio-btn hide" />
          <label for="star4">&#9734;</label>
          <input id="star3" name="puntuacion" type="radio" value="3" class="radio-btn hide" />
          <label for="star3">&#9734;</label>
          <input id="star2" name="puntuacion" type="radio" value="2" class="radio-btn hide" />
          <label for="star2">&#9734;</label>
          <input id="star1" name="puntuacion" type="radio" value="1" class="radio-btn hide" />
          <label for="star1">&#9734;</label>
        </div>
        <label for="contenido">Contenido <span class="requerido">*</span></label>
        <textarea placeholder="Escribe tu valoracion" name="contenido" cols="30" rows="10"></textarea><br>
        <input type="submit" name="crear" value="Crear"><br><br>
      </form>
      </div>
      <link rel="stylesheet" href="<?php echo base_url(); ?>recursos/css/exposicion/puntuacion.css">
    </div>
    <br>
  <?php } ?>

  <!-- MOSTRAR VALORACIONES -->
  <div class="contenedor-secundario contenedor-blanco">
    <h2>Valoraciones</h2>
  </div>
    <?php
    if (isset($listaValoraciones)) {
      foreach ($listaValoraciones as $valoracion) { ?>
        <div class="contenedor-secundario contenedor-transparente">
          Puntuacion: <?php echo $valoracion['puntuacion']; ?><br>
          Contenido: <?php echo $valoracion['contenido']; ?><br>
          <?php if (isset($_SESSION['es_Admin'])) : ?>
          <form method="POST" action="<?php echo base_url() . 'index.php/exposicion/eliminar_valoracion'; ?>">
            <input type="hidden" name="id" value="<?php echo $valoracion['id']; ?>">
            <input type="hidden" name="id_exposicion" value="<?php echo $_GET['id']; ?>">
            <input type="submit" value="Eliminar">
          </form>
        <?php endif; ?>
        </div>
    <?php
      };
    }

    ?>
  </div>

</main>
</body>

</html>