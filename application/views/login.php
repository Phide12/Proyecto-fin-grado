<main>
  <div class="fullPage-block fondo-portada" style="background-image: url(<?= base_url() . 'recursos/img/full-page/caleb-george-FmMivfgHCiM-unsplash.jpg'; ?>); background-position-x: right">
  </div>
  <div class="contenedor-secundario bg-white">
    ¿No estas registrado todavia?
    <a href="<?= base_url() . 'index.php/usuario/vista_registro'; ?>">
      <b>Regístrate ahora</b>
    </a>
  </div>

  <div class="contenedor-secundario bg-white">
    <div class="form_header">
      <h3>Inicia Sesión para continuar</h3>
    </div>
    <div class="formulario">
      <?= form_open('usuario/comprobar_login'); ?>
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