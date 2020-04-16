  <div>
    <h2>Datos de Perfil</h2>
    <?php echo form_open('usuario/modificar_usuario'); ?>
    Nombre: <input type="text" name="nombre" value="<?php echo $nombre ?>" required><br>
    Apellidos: <input type="text" name="apellidos" value="<?php echo $apellidos ?>" required><br>
    email: <input type="text" name="email" value="<?php echo $email ?>" required><br>
    <input type="submit" value="Modificar">
    </form>
  </div>

  <div>
    <h2>Cambiar Contraseña</h2>
    <?php echo form_open('usuario/modificar_contrasena'); ?>
    Contraseña Antigua: <input type="password" name="contrasena_antigua" required><br>
    Contraseña Nueva: <input type="password" name="contrasena_nueva1" required><br>
    Repetir Nueva: <input type="password" name="contrasena_nueva2" required><br>
    <input type="submit" value="Cambiar Contraseña">
    </form>
  </div>
  </body>

  </html>