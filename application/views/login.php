<main>
  <?php echo form_open('usuario/comprobar_login'); ?>
  <h1>Iniciar Sesion</h1>
  <br>
  <br>
  Nick: <input type="text" name="nick" required><br>
  Contraseña: <input type="password" name="contrasena" required><br>
  <input type="submit" value="Iniciar Sesion">
  </form>
  <br>
  ¿No estas registrado todavia?
  <a href="<?php echo base_url() . 'index.php/usuario/vista_registro'; ?>">
    <b>Registrate ahora</b>
  </a>
</main>


</body>

</html>