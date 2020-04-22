<div>
  <h2>Lista de Usuarios</h2>

  <?php
  if ($_SESSION['es_Admin'] == 1 && isset($listaUsuarios)) : ?>
    <form method="post" action="<?php echo base_url() . 'index.php/usuario/eliminar_usuario'; ?>">
      <select name="nick">
        <?php foreach ($listaUsuarios as $usuario) : ?>
          <?php if ($usuario['es_Admin'] != 1) : ?>
            <option value="<?php echo $usuario['nick'] ?>"><?php echo $usuario['id'] ?> - <?php echo $usuario['nick'] ?></option>
        <?php endif;
        endforeach; ?>
      </select>
      <input type="submit" value="eliminar">
    </form>

  <?php endif; ?>

</div>
<div>
  <h2>Lista de Exposiciones</h2>

  <?php
  if ($_SESSION['es_Admin'] == 1 && isset($listaExposiciones)) : ?>
    Titulo:
    <?php foreach ($listaExposiciones as $exposicion) : ?>
      <form method="POST" action="<?php echo base_url() . 'index.php/exposicion/eliminar_exposicion'; ?>">
        <input type="hidden" name="id" value="<?php echo $exposicion['id']; ?>">
        <input type="hidden" name="portada" value="<?php echo $exposicion['portada']; ?>">
        <?php echo $exposicion['titulo'] ?>
        <input type="submit" value="Eliminar">
      </form>
    <?php endforeach; ?>
    </select>
  <?php endif; ?>

</div>

</body>

</html>