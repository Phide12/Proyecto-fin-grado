<?php if (isset($_SESSION['es_Admin'])) : ?>
  <div>
    <a href="<?php echo base_url() . 'index.php/exposicion/vista_exposicion_creacion'; ?>">
      <h2>Acceder a la herramienta para crear exposiciones</h2>
    </a>
    <?php endif;

  if (isset($listaExposiciones)) {
    echo '<div>';
    foreach ($listaExposiciones as $exposicion) : ?>
      <a href="<?php echo base_url() . 'index.php/exposicion/vista_exposicion_individual?id=' . $exposicion['id']; ?>">
        <div>
          <img src="<?php echo base_url() . $exposicion['portada']; ?>" width="360" height="220" /><br>
          Titulo: <?php echo $exposicion['titulo']; ?><br>
          Descripcion: <?php echo $exposicion['descripcion']; ?><br>
          Autor: <?php echo $exposicion['autor']; ?><br>
          Val. Media: <?php echo $exposicion['val_media']; ?><br>
          Num. Visitas: <?php echo $exposicion['num_visitas']; ?><br>
        </div>
      </a>
      <?php if (isset($_SESSION['es_Admin'])) : ?>
        <form method="POST" action="<?php echo base_url() . 'index.php/exposicion/eliminar_exposicion'; ?>">
          <input type="hidden" name="id" value="<?php echo $exposicion['id']; ?>">
          <input type="hidden" name="portada" value="<?php echo $exposicion['portada']; ?>">
          <input type="submit" value="Eliminar">
        </form>
      <?php endif; ?>
      <hr>
  <?php
    endforeach;
  }
  ?>
  </div>

  </body>

  </html>