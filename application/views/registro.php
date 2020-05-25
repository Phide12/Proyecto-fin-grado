<main>
  <div class="fullPage-block fondo-portada" style="background-image: url(<?= base_url() . 'recursos/img/full-page/my-life-through-a-lens-bq31L0jQAjU-unsplash.jpg'; ?>)">
  </div>
  <div class="container">
    <div class="contenedor-secundario bg-white">
      ¿Ya estas registrado?
      <a href="<?= base_url() . 'index.php/usuario/vista_login'; ?>">
        <b>Inicia sesión</b>
      </a>
    </div>

    <div class="contenedor-secundario bg-white">
      <div class="form_header">
        <h3>Únete a nuestra comunidad</h3>
      </div>
      <div class="formulario">
        <?= form_open('usuario/insertar_usuario'); ?>
        <input placeholder="Nick" type="text" name="nick" required><br>
        <input placeholder="Contraseña" type="password" name="contrasena" required><br>
        <input placeholder="Nombre" type="text" name="nombre" required><br>
        <input placeholder="Apellidos" type="text" name="apellidos" required><br>
        <input placeholder="E-mail" type="text" name="email" required><br>
        <input type="submit" value="Registrarse">
        </form>
      </div>
    </div>
  </div>
</main>

</body>

</html>