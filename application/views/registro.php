<main>

  <div class="contenedor-secundario contenedor-transparente">
    ¿Ya estas registrado?
    <a href="<?php echo base_url() . 'index.php/usuario/vista_login'; ?>">
      <b>Inicia sesión</b>
    </a>
  </div>

  <div class="contenedor-secundario contenedor-blanco">
    <div class="form_header">
      <h3>Únete a nuestra comunidad</h3>
    </div>
    <div class="formulario">
      <?php echo form_open('usuario/insertar_usuario'); ?>
      <input placeholder="Nick" type="text" name="nick" required><br>
      <input placeholder="Contraseña" type="password" name="contrasena" required><br>
      <input placeholder="Nombre" type="text" name="nombre" required><br>
      <input placeholder="Apellidos" type="text" name="apellidos" required><br>
      <input placeholder="E-mail" type="text" name="email" required><br>
      <input type="submit" value="Registrarse">
      </form>
    </div>
  </div>



</main>

</body>

</html>