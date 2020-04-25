<main>

  <div class="contenedor-secundario contenedor-transparente">
    <h3>Datos de usuario</h3>
    En esta página podras modificar tus datos de perfil.
  </div>

  <div class="contenedor-secundario contenedor-blanco">
  <?php echo form_open('usuario/modificar_usuario'); ?>
    <label for="nombre">Nombre <span class="requerido">*</span></label>
    <input type="text" name="nombre" value="<?php echo $nombre ?>" required><br>
    <label for="apellidos">Apellidos <span class="requerido">*</span></label>
    <input type="text" name="apellidos" value="<?php echo $apellidos ?>" required><br>
    <label for="email">E-mail <span class="requerido">*</span></label>
    <input type="text" name="email" value="<?php echo $email ?>" required><br>
    <input type="submit" value="Modificar">
    </form>
  </div>

  <div class="contenedor-secundario contenedor-blanco">
    <?php echo form_open('usuario/modificar_contrasena'); ?>
    <label for="contrasena_antigua">Contraseña Actual <span class="requerido">*</span></label>
    <input type="password" name="contrasena_antigua" required><br>
    <label for="contrasena_nueva1">Contraseña Nueva <span class="requerido">*</span></label>
    <input type="password" name="contrasena_nueva1" required><br>
    <label for="contrasena_nueva2">Confirmar Nueva <span class="requerido">*</span></label>
    <input type="password" name="contrasena_nueva2" required><br>
    <input type="submit" value="Cambiar Contraseña">
    </form>
  </div>
</main>

</body>

</html>