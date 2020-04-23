<?php
class Exposicion_model extends CI_Model
{

	public function __construct()
	{
		$this->load->database();
	}

	function buscar_exposicion($id = FALSE)
	{
		if ($id === FALSE) {
			$query = $this->db->get('exposicion');
			return $query->result_array();
		}
		$query = $this->db->get_where('exposicion', ['id' => $id]);
		return $query->row_array();
	}

	function buscar_exposicion_por_titulo($titulo = FALSE)
	{
		if ($titulo != FALSE) {
			$this->db->like('titulo', $titulo);
			$query = $this->db->get('exposicion');
			return $query->result_array();
		} else {
			return null;
		}
	}

	function insertar_exposicion($data = FALSE)
	{
		if ($data != FALSE) {
			return $this->db->insert('exposicion', $data);
		}
		return -1;
	}

	function incrementar_visitas($id = FALSE, $num_visitas = FALSE)
	{
		if ($id != FALSE) {
			$this->db->where('id', $id);
			return $this->db->update('exposicion', ['num_visitas' => $num_visitas + 1]);
		}
	}

	function eliminar_exposicion($data = FALSE)
	{
		if ($data != FALSE) {
			return $this->db->delete('exposicion', $data);
		}
		return -1;
	}

	function insertar_contenido_exposicion($data = FALSE)
	{
		if ($data != FALSE) {
			return $this->db->insert('multimedia', $data);
		}
		return -1;
	}

	function eliminar_todo_contenido_exposicion($data = FALSE)
	{
		if ($data != FALSE) {
			$this->db->where('id_exposicion', $data['id']);
			return $this->db->delete('multimedia');
		}
		return -1;
	}

	function eliminar_contenido_exposicion($data = FALSE)
	{
		if ($data != FALSE) {
			$this->db->where('id', $data['id']);
			return $this->db->delete('multimedia');
		}
		return -1;
	}

	function buscar_contenido($id = FALSE)
	{
		if ($id === FALSE) {
			$query = $this->db->get('multimedia');
			$resultado = $query->result_array();
			return $resultado;
		}
		$query = $this->db->get_where('multimedia', ['id_exposicion' => $id]);
		$resultado = $query->result_array();
		return $resultado;
	}

	function buscar_valoracion($id = FALSE)
	{
		if ($id === FALSE) {
			$query = $this->db->get('valoracion');
			$resultado = $query->result_array();
			return $resultado;
		}
		$query = $this->db->get_where('valoracion', ['id_exposicion' => $id]);
		$resultado = $query->result_array();
		return $resultado;
	}

	function insertar_valoracion($data = FALSE)
	{
		if ($data != FALSE) {
			$resultado = $this->db->insert('valoracion', $data);
			$this->db->select('puntuacion');
			$listadoPuntuacion = $this->db->get_where('valoracion', ['id_exposicion' => $data['id_exposicion']])->result_array();

			/* Se calcula la puntuacion media y se registra en la exposicion*/
			$total = 0;
			foreach ($listadoPuntuacion as $puntuacion) {
				$total += $puntuacion['puntuacion'];
			}
			$puntuacionMedia = $total / count($listadoPuntuacion);
			$this->db->update('exposicion', ['val_media' => $puntuacionMedia], ['id' => $data['id_exposicion']]);
			return $resultado;
		}
		return -1;
	}

	function eliminar_valoracion($data = FALSE)
	{
		if ($data != FALSE) {
			$this->db->where('id', $data['id']);
			return $this->db->delete('valoracion');
		}
		return -1;
	}

	function eliminar_valoraciones_exposicion($data = FALSE)
	{
		if ($data != FALSE) {
			$this->db->where('id_exposicion', $data['id']);
			return $this->db->delete('valoracion');
		}
		return -1;
	}

	function buscar_valoracion_por_usuario($id_usuario)
	{
		if (isset($id_usuario)) {
			$this->db->select('id');
			$query = $this->db->get_where('valoracion', ['id_usuario' => $id_usuario]);
			return $query->row_array();
		}
		return -1;
	}

	function buscar_favoritos_por_usuario($id_usuario)
	{
		if (isset($id_usuario)) {
			$this->db->select('id_exposicion');
			$query = $this->db->get_where('favoritos', ['id_usuario' => $id_usuario]);
			return $query->result_array();
		} else {
			return null;
		}
	}
}
