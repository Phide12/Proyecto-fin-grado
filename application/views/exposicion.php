<?php if (isset($_SESSION['es_Admin'])) : ?>
  <div>
    <h2>Nueva exposicion</h2>
    
  <?php if (isset($error)) {
    echo $error;
  }?>

    <form method="post" action="<?php echo base_url() . 'index.php/exposicion/insertar_exposicion'; ?>" enctype="multipart/form-data">
      Titulo: <input type="text" name="titulo"><br>
      Descripcion: <input type="text" name="descripcion"><br>
      Selecciona imagen para subir:<br>
      <input type="file" name="fileToUpload" id="fileToUpload"><br>
      Valoracion: <input type="text" name="valoracion"><br>
      <input type="submit" value="Crear">
    </form>
  </div>
  <?php endif;

if (isset($_SESSION['nick']) && isset($listaExposiciones)) {
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
echo '</div>';
?>
</body>

</html>