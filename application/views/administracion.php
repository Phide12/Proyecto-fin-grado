<div>
  <h2>Lista de Usuarios</h2>

  <?php
  if ($_SESSION['es_Admin'] == 1 && isset($listaUsuarios)) {

    foreach ($listaUsuarios as $usuario) : ?>

      <form method="post">
        <input type="hidden" name="id" value="<?php echo $usuario['id']; ?>" ><br>
        Nick: <input type="text" name="nick" value="<?php echo $usuario['nick']; ?>" readonly><br>
        Nombre: <input type="text" name="nombre" value="<?php echo $usuario['nombre']; ?>" ><br>
        Apellidos: <input type="text" name="apellidos" value="<?php echo $usuario['apellidos']; ?>" ><br>
        email: <input type="text" name="email" value="<?php echo $usuario['email']; ?>" ><br>
        <input type="submit" value="modificar" formaction="<?php echo base_url() . 'index.php/usuario/modificar_usuario_admin'; ?>">
        <input type="submit" value="eliminar" formaction="<?php echo base_url() . 'index.php/usuario/eliminar_usuario'; ?>">
      </form>
  <?php
    endforeach;
  }
  ?>

</div>

</body>

</html>