<?php if (isset($_SESSION['es_Admin'])) : ?>
  <main>
    <a href="<?php echo base_url() . 'index.php/exposicion/vista_general'; ?>">
      <h2>Volver a la pagina general de exposiciones</h2>
    </a>

    <h2>Nueva exposicion</h2>

    <?php if (isset($error)) {
      echo '<div>' . $error . '</div>';
    } ?>

    <form method="post" id="crear_exposicion" name="crear_exposicion" enctype="multipart/form-data">
      Titulo: <input type="text" name="titulo"><br>
      Autor de la exposicion: <input type="text" name="autor"><br>
      Descripcion breve: <br>
      <textarea name="descripcion" cols="30" rows="10" placeholder="Escribe un pequeño texto con los puntos principales de la exposición..."></textarea><br>
      Subir portada de la exposicion:<br>
      <input type="file" name="portada" required><br><br>

      Para añadir contenidos a la exposicion ir a la pagina individual.<br>

      <input type="submit" name="crear" value="Crear" formaction="<?php echo base_url() . 'index.php/exposicion/insertar_exposicion'; ?>">
    </form>
  </main>
  <script src="<?php echo base_url(); ?>recursos/javascript/exposicion/crearExposicion.js"></script>
<?php endif; ?>
</body>

</html>