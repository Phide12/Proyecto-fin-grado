<?php if (isset($_SESSION['es_Admin'])) : ?>
  <div>
    <a href="<?php echo base_url() . 'index.php/exposicion/vista_exposicion_creacion'; ?>">
      <h2>Acceder a la herramienta para crear exposiciones</h2>
    </a>
  <?php endif; ?>
  </div>

  <!-- BARRA DE BUSQUEDA -->
  <div>
    <form action="<?php echo base_url() . 'index.php/exposicion/vista_general'; ?>" method="get">
      Buscar:
      <?php if (isset($_GET['buscar'])) {
        echo '<input type="text" name="buscar" value="' . $_GET['buscar'] . '">';
      } else {
        echo '<input type="text" name="buscar">';
      } ?>
      <input type="submit" value="Buscar">
    </form>
    <form action="<?php echo base_url() . 'index.php/exposicion/vista_general'; ?>" method="post">
      <?php if (isset($listaFavoritos)) {
        echo '<input type="hidden" name="favoritos" value="ocultar">';
        echo '<input type="submit" value="Ocultar favoritos">';
      } else {
        echo '<input type="hidden" name="favoritos" value="mostrar">';
        echo '<input type="submit" value="Ver favoritos">';
      } ?>

    </form>
  </div>

  <!-- LISTA DE EXPOSICIONES -->
  <?php if (isset($listaExposiciones)) {


    echo '<div>';
    if (isset($listaFavoritos)) {
      echo '<h3>Favoritos</h3>';
    } else {
      echo '<h3>exposiciones</h3>';
    }
    foreach ($listaExposiciones as $exposicion) {
      if (isset($listaFavoritos)) {
        $estaEnFavoritos = false;
        foreach ($listaFavoritos as $favorito) {
          if ($favorito['id_exposicion'] == $exposicion['id']) {
            $estaEnFavoritos = true;
          }
        }
      }
      if (!isset($listaFavoritos) || $estaEnFavoritos) { ?>
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
      }
    }
    echo '</div>';
  }
  ?>

  </body>

  </html>