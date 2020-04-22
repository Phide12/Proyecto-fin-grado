<?php
class Usuario_model extends CI_Model
{

	public function __construct()
	{
		$this->load->database();
		$this->load->library('encriptador');
	}

	function descifrar_usuario($usuario)
	{
		$usuario['nick'] = $this->encriptador->descifrar($usuario['nick']);
		$usuario['nombre'] = $this->encriptador->descifrar($usuario['nombre']);
		$usuario['apellidos'] = $this->encriptador->descifrar($usuario['apellidos']);
		$usuario['email'] = $this->encriptador->descifrar($usuario['email']);
		if (isset($usuario['es_Admin'])) {
			$usuario['es_Admin'] = $this->encriptador->descifrar($usuario['es_Admin']);
		}
		return $usuario;
	}

	function cifrar_usuario($usuario)
	{
		$usuario['nick'] = $this->encriptador->cifrar($usuario['nick']);
		$usuario['nombre'] = $this->encriptador->cifrar($usuario['nombre']);
		$usuario['apellidos'] = $this->encriptador->cifrar($usuario['apellidos']);
		$usuario['email'] = $this->encriptador->cifrar($usuario['email']);
		if (isset($usuario['es_Admin'])) {
			$usuario['es_Admin'] = $this->encriptador->cifrar($usuario['es_Admin']);
		}
		return $usuario;
	}


	function buscar_usuario($nick = FALSE)
	{
		if ($nick === FALSE) {
			$query = $this->db->get('usuario');
			$resultados = $query->result_array();
			$Exposiciones = [];
			foreach ($resultados as $resultado) {
				$Exposiciones[] = $this->descifrar_usuario($resultado);
			}
			return $Exposiciones;
		}
		$query = $this->db->get_where('usuario', ['nick' => $this->encriptador->cifrar($nick)]);
		$resultado = $query->row_array();
		if ($resultado != null) {
			return $this->descifrar_usuario($resultado);
		} else {
			return null;
		}
	}

	function insertar_usuario($data = FALSE)
	{
		if ($data != FALSE) {
			$data['contrasena'] = $this->encriptador->hashear($data['contrasena']);
			return $this->db->insert('usuario', $this->cifrar_usuario($data));
		}
		return -1;
	}

	function modificar_usuario($data = FALSE)
	{
		if ($data != FALSE) {
			$usuario = $this->cifrar_usuario($data);
			$this->db->where('nick', $usuario['nick']);
			unset($usuario['nick']);
			return $this->db->update('usuario', $usuario);
		}
		return -1;
	}

	function eliminar_usuario($data = FALSE)
	{
		if ($data != FALSE) {
			$data['nick'] = $this->encriptador->cifrar($data['nick']);
			return $this->db->delete('usuario', $data);
		}
		return -1;
	}

	function cambiar_contrasena($nick = FALSE, $contrasena = FALSE)
	{
		if ($nick != FALSE) {
			$data['contrasena'] = $this->encriptador->hashear($contrasena);
			$this->db->where('nick', $this->encriptador->cifrar($nick));
			return $this->db->update('usuario', $data);
		}
		return -1;
	}

	function insertar_favorito($data = FALSE)
	{
		if ($data != FALSE) {
			return $this->db->insert('favoritos', $data);
		}
		return -1;
	}

	function eliminar_favorito($data = FALSE)
	{
		if ($data != FALSE) {
			return $this->db->delete('favoritos', $data);
		}
		return -1;
	}
}
