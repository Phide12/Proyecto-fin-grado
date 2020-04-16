<?php
class Comunidad_model extends CI_Model
{

	public function __construct()
	{
		$this->load->database();
	}

	function insertar_obra($data = FALSE)
	{
		if ($data != FALSE) {
			return $this->db->insert('obra', $data);
		}
		return -1;
	}

	function buscar_obra($titulo = FALSE)
	{
		if ($titulo === FALSE) {
			$query = $this->db->get('obra');
			$resultado['listaObras'] = $query->result_array();
			return $resultado;
		}
		$query = $this->db->get_where('obra', ['titulo' => $titulo]);
		return $query->row_array();
	}

	function eliminar_obra($data = FALSE)
	{
		if ($data != FALSE) {
			return $this->db->delete('obra', $data);
		}
		return -1;
	}

}
