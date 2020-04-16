<?php
class Multimedia_model extends CI_Model
{

	public function __construct()
	{

	}

	public function subir_imagen($datosImagen)
	{
		$direccionSubida = $_SERVER['DOCUMENT_ROOT'] . str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);
		$datosImagen = str_replace('data:image/png;base64,', '', $datosImagen);
		$datosImagen = str_replace(' ', '+', $datosImagen);
		$nombreImagen = 'imagenes/imagenes_comunidad/' . uniqid() . '.png';
		$nombreArchivo = $direccionSubida . $nombreImagen;
		$resultado = file_put_contents($nombreArchivo, base64_decode($datosImagen));
		if ($resultado != false) {
			return $nombreImagen;
		} else {
			return $resultado;
		}
	}

	public function eliminar_imagen($ubicacionArchivo)
	{
		$direccionSubida = $_SERVER['DOCUMENT_ROOT'] . str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);
		return unlink($direccionSubida . $ubicacionArchivo);
	}

}
