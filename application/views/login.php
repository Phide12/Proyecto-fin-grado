<main>

  <div class="contenedor-secundario contenedor-transparente">
    ¿No estas registrado todavia?
    <a href="<?php echo base_url() . 'index.php/usuario/vista_registro'; ?>">
      <b>Registrate ahora</b>
    </a>
  </div>

  <div class="contenedor-secundario contenedor-blanco">
    <div class="form_header">
      <h3>Inicia Sesión para continuar</h3>
    </div>
    <div class="formulario">
      <?php echo form_open('usuario/comprobar_login'); ?>
      <input placeholder="Nick" type="text" name="nick" required><br>
      <input placeholder="Contraseña" type="password" name="contrasena" required><br>
      <input type="submit" value="Iniciar Sesion">
      </form>
    </div>
    <br>

  </div>



</main>


</body>

</html>