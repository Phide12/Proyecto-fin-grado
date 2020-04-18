<?php if (isset($_SESSION['es_Admin'])) : ?>
  <div>
    <a href="<?php echo base_url() . 'index.php/exposicion/vista_creacion_exposicion'; ?>">
      <h2>Acceder a la herramienta para crear exposiciones</h2>
    </a>
    <?php endif;

  if (isset($listaExposiciones)) {
    echo '<div>';
    foreach ($listaExposiciones as $exposicion) : ?>
      <div>
        <?php var_dump($exposicion) ?>
      </div>
      <form method="post">
        <input type="hidden" name="id" value="<?php echo $exposicion['id']; ?>"><br>
        Titulo: <input type="text" name="titulo" value="<?php echo $exposicion['titulo']; ?>"><br>
        Descripcion: <input type="text" name="descripcion" value="<?php echo $exposicion['descripcion']; ?>"><br>
        Portada: <input type="text" name="valoracion" value="<?php echo $exposicion['portada']; ?>"><br>
        Autor: <input type="text" name="valoracion" value="<?php echo $exposicion['autor']; ?>"><br>
        Val. Media: <input type="text" name="valoracion" value="<?php echo $exposicion['val_media']; ?>"><br>
        Num. Visitas: <input type="text" name="valoracion" value="<?php echo $exposicion['num_visitas']; ?>"><br>
        <?php if (isset($_SESSION['es_Admin'])) : ?>
          <input type="submit" value="Modificar" formaction="<?php echo base_url() . 'index.php/exposicion/modificar_exposicion'; ?>">
          <input type="submit" value="Eliminar" formaction="<?php echo base_url() . 'index.php/exposicion/eliminar_exposicion'; ?>">
        <?php endif; ?>
      </form>
      <hr>
  <?php
    endforeach;
  }
  ?>
  </div>
  
  </body>

  </html>