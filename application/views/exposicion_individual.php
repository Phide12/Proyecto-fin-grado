<div>
  <a href="<?php echo base_url() . 'index.php/exposicion/vista_general'; ?>">
    <h2>Volver a la pagina general de exposiciones</h2>
  </a>

  <h2>Vista exposicion indiv</h2>

  <?php if (isset($error)) {
    echo '<div>' . $error . '</div>';
  } ?>

  <div>
    <h1><?php echo $titulo; ?></h1><br>
    <div><?php echo $descripcion; ?></div>
    <h2><?php echo $autor; ?></h2>
    <img src="<?php echo base_url() . $portada; ?>" width="360" height="220" /><br>
    <h3><?php echo $num_visitas; ?></h3>
    <h3><?php echo $val_media; ?></h3>
  </div>
  <?php if (isset($_SESSION['es_Admin'])) : ?>
    <div>
      <form method="post" enctype="multipart/form-data">
        <input type="hidden" name="id_exposicion" value="<?php echo $id; ?>">
        Seleccionar un archivo multimedia que se añadira a la exposicion <br>
        <input type="file" name="contenido" required><br><br>
        Comentario del recurso subido<br>
        <textarea name="comentario" cols="30" rows="10" placeholder="texto/descripcion que acompañara al archivo multimedia en la exposicion..."></textarea><br>
        <input type="submit" name="subir" value="Subir" formaction="<?php echo base_url() . 'index.php/exposicion/subir_contenido_exposicion'; ?>">
      </form>
    </div>

</div>
<script src="<?php echo base_url(); ?>recursos/javascript/exposicion/crearExposicion.js"></script>
<?php endif; ?>

<!-- CONTENIDOS -->
<div>
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
<div>
  <?php if (isset($_SESSION['nick'])) { ?>
    <!-- CREAR VALORACION -->
    <div>
      <h2>Crear Valoracion</h2>
      <form action="<?php echo base_url() . 'index.php/exposicion/insertar_valoracion'; ?>" method="post">
        <input type="hidden" name="id_exposicion" value="<?php echo $_GET['id']; ?>">
        Puntuacion 1-5: <input type="text" name="puntuacion"><br>
        Contenido de la valoracion <input type="text" name="contenido"><br>
        <input type="submit" name="crear" value="Crear"><br><br>
      </form>
    </div>
    <br>
    <?php } ?>

<!-- MOSTRAR VALORACIONES -->
<div>
<h2>Valoraciones</h2>
<?php
  if (isset($listaValoraciones)) {
    /* MOSTRAR VALORACIONES */
    
    foreach ($listaValoraciones as $valoracion) { ?>
      <div>
        Puntuacion: <?php echo $valoracion['puntuacion']; ?><br>
        Contenido: <?php echo $valoracion['contenido']; ?><br>
      </div>
      <?php if (isset($_SESSION['es_Admin'])) : ?>
        <form method="POST" action="<?php echo base_url() . 'index.php/exposicion/eliminar_valoracion'; ?>">
          <input type="hidden" name="id" value="<?php echo $valoracion['id']; ?>">
          <input type="hidden" name="id_exposicion" value="<?php echo $_GET['id']; ?>">
          <input type="submit" value="Eliminar">
        </form>
      <?php endif; ?>
      <hr>
  <?php
    };
  }

  ?>
</div>

</div>
</body>

</html>