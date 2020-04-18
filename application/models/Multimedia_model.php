<?php
class Multimedia_model extends CI_Model
{

  public function __construct()
  {
  }

  public function subir_archivo($archivo, $direccionCarpeta)
  {
    $rutaProyecto = $_SERVER['DOCUMENT_ROOT'] . str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);
    $nombreArchivo = $archivo['name'];

    //comprueba el tamaño del archivo (el maximo permitido son 10mb)
    if ($archivo["size"] > 10000000) {
      echo "El archivo es demasiado grande.";
      return false;
    }

    // Upload file
    $direccionCompleta = $rutaProyecto . $direccionCarpeta . $nombreArchivo;
    if (move_uploaded_file($archivo['tmp_name'], $direccionCompleta)) {
      return $direccionCarpeta . $nombreArchivo;
    } else {
      return false;
    }
  }

  public function subir_canvas($datosImagen)
  {
    //Direccion base de la aplicacion en el servidor
    $direccionSubida = $_SERVER['DOCUMENT_ROOT'] . str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);

    //Le da un nombre a la imagen y guarda la direccion donde se almacenara
    $nombreImagen = 'imagenes/imagenes_comunidad/' . uniqid() . '.png';
    $nombreCampo = $direccionSubida . $nombreImagen;

    //Trata la cadena con la informacion de la imagen
    $datosImagen = str_replace('data:image/png;base64,', '', $datosImagen);
    $datosImagen = str_replace(' ', '+', $datosImagen);

    //intenta crear el archivo a partir de la cadena con datos recibida
    if (!file_exists($nombreCampo)) {
      $resultado = file_put_contents($nombreCampo, base64_decode($datosImagen));
    }
    if ($resultado != false) {
      return $nombreImagen;
    } else {
      return $resultado;
    }
  }

  public function eliminar_imagen($ubicacionArchivo)
  {
    $direccionSubida = $_SERVER['DOCUMENT_ROOT'] . str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);
    if (file_exists($direccionSubida . $ubicacionArchivo)) {
      return unlink($direccionSubida . $ubicacionArchivo);
    }
    return false;
  }
}
