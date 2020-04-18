<?php if (isset($_SESSION['es_Admin'])) : ?>
  <div>
    <a href="<?php echo base_url() . 'index.php/exposicion/vista_general'; ?>">
      <h2>Volver a la pagina general de exposiciones</h2>
    </a>

    <h2>Nueva exposicion</h2>

    <?php if (isset($error)) {
      echo $error;
    } ?>

    <form method="post" id="crear_exposicion" name="crear_exposicion" enctype="multipart/form-data">
      <h3 id="error"></h3>
      Titulo: <input type="text" name="titulo"><br>
      Descripcion breve: <br>
      <textarea name="decripcion" cols="30" rows="10" placeholder="Escribe un pequeño texto con los puntos principales de la exposición..."></textarea><br>
      Subir portada de la exposicion:<br>
      <input type="file" name="portada"><br><br>

      Contenido de la exposicion, para seleccionar varios archivos manten presionado 'ctrl'<br>
      las imagenes se mostraran en el orden de subida:<br>
      <input type="file" name="contenido[]" multiple><br><br>

      <input type="submit" name="crear" value="Crear" formaction="<?php echo base_url() . 'index.php/exposicion/insertar_exposicion'; ?>">
    </form>
    

  </div>
  <script src="<?php echo base_url(); ?>recursos/javascript/exposicion/crearExposicion.js"></script>


<?php endif; ?>
</div>
</body>

</html>