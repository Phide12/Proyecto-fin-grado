<!DOCTYPE html>
<html>

<head>
  <title>proyecto_JorgeM</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?php echo base_url() . "recursos/css/estilo.css"; ?>">
</head>

<body>

  <div>
    <h1>
      <?php echo $titulo; ?>
    </h1>
    <div>
      <a href="<?php echo base_url() . 'index.php/exposicion/vista_general'; ?>">Inicio</a>
      <a href="<?php echo base_url() . 'index.php/comunidad/vista_comunidad'; ?>">Comunidad</a>
      <a href="<?php echo base_url() . 'index.php/otros/vista_sobre_nosotros'; ?>">Sobre Nosotros</a>
      <?php
      if (isset($_SESSION['nick'])) : ?>
        <a href="<?php echo base_url() . 'index.php/usuario/vista_perfil'; ?>">Perfil</a>
        <a href="<?php echo base_url() . 'index.php/usuario/cerrar_sesion'; ?>">Cerrar sesion</a>
        <?php if (isset($_SESSION['es_Admin'])) : ?>
          <a href="<?php echo base_url() . 'index.php/usuario/vista_administracion'; ?>">Administracion</a>
        <?php endif; ?>
      <?php else : ?>
        <a href="<?php echo base_url() . 'index.php/usuario/vista_login'; ?>">Iniciar Sesion</a>
        <a href="<?php echo base_url() . 'index.php/usuario/vista_registro'; ?>">Registrarse</a>

      <?php endif; ?>

    </div>
  </div>