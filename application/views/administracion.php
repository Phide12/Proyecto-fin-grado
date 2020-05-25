<?php if (isset($_SESSION['es_Admin'])) : ?>
  <main>
    <div class="fullPage-block fondo-portada" style="background-image: url(<?= base_url() . 'recursos/img/daniele-levis-pelusi-ENdi1TkM1QQ-unsplash.jpg'; ?>)">
    </div>
    <div class="fullPage-block">
      <div class="contenedor-secundario bg-white">
        <h3>Panel de administración</h3>
        En esta sección se permite al administrador borrar usuarios y exposiciones.<br>
        ¡Cuidado, los elementos se eliminaran de forma permanente, actua con precaución!
      </div>

      <?php
      if (isset($listaUsuarios)) : ?>
        <div class="contenedor-secundario bg-white">
          <div class="formulario">
            <form method="post" action="<?= base_url() . 'index.php/usuario/eliminar_usuario'; ?>">
              <label for="nick">Seleccionar un usuario de la lista para eliminarlo</label>
              <select name="nick">
                <?php foreach ($listaUsuarios as $usuario) : ?>
                  <?php if ($usuario['es_Admin'] != 1) : ?>
                    <option value="<?= $usuario['nick'] ?>"><?= $usuario['id'] ?> - <?= $usuario['nick'] ?></option>
                <?php endif;
                endforeach; ?>
              </select>
              <input type="submit" value="Eliminar">
            </form>
          </div>
        </div>

      <?php endif; ?>

      <?php
      if (isset($listaExposiciones)) : ?>
        <div class="contenedor-secundario bg-white">
          <div class="formulario">
            <form method="POST" action="<?= base_url() . 'index.php/exposicion/eliminar_exposicion'; ?>">
              <label for="exposicion">Seleccionar una exposición de la lista para eliminarla</label>
              <select name="exposicion">
                <?php foreach ($listaExposiciones as $exposicion) {
                  $valorOption = json_encode(['id' => $exposicion['id'], 'portada' => $exposicion['portada']]);
                  echo '<option value=' . $valorOption . '>' . $exposicion['titulo'] . '</option>';
                } ?>
              </select>
              <input type="submit" value="Eliminar">
            </form>
          <?php endif; ?>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </main>

  </body>

  </html>