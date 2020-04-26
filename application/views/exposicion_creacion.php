<?php if (isset($_SESSION['es_Admin'])) : ?>
  <main>
    <div class="contenedor-secundario contenedor-transparente">
      <a href="<?php echo base_url() . 'index.php/exposicion/vista_general'; ?>">
        <h3>Volver a la página general de exposiciones</h3>
      </a>
    </div>

    <div class="contenedor-secundario contenedor-transparente">
      <h3>Crear de nueva exposición</h3>
    </div>

    <?php if (isset($error)) {
      echo '<div class="contenedor-secundario contenedor-transparente">' . $error . '</div>';
    } ?>
    <div class="contenedor-secundario contenedor-blanco formulario">
      <div class="formulario">
        <form method="post" id="crear_exposicion" name="crear_exposicion" enctype="multipart/form-data">
          <label for="titulo">Titulo <span class="requerido">*</span></label>
          <input type="text" name="titulo"><br>
          <label for="autor">Autor de la exposición <span class="requerido">*</span></label>
          <input type="text" name="autor"><br>
          <label for="descripcion">Descripcion breve <span class="requerido">*</span></label>
          <textarea name="descripcion" cols="30" rows="10" placeholder="Escribe un pequeño texto con los puntos principales de la exposición..."></textarea><br>
          <label for="portada">Subir portada de la exposición <span class="requerido">*</span> (3mb max- solo imágenes: png, jpg y jpeg)</label>
          <input type="file" name="portada" required><br><br>
          <h4>Para añadir contenidos a la exposición, hay que ir a la página individual.</h4>
          <input type="submit" name="crear" value="Crear" formaction="<?php echo base_url() . 'index.php/exposicion/insertar_exposicion'; ?>">
        </form>
      </div>
    </div>
  </main>
  <script src="<?php echo base_url(); ?>recursos/javascript/exposicion/crearExposicion.js"></script>
<?php endif; ?>
</body>

</html>