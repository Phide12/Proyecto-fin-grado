<?php
class Exposicion_model extends CI_Model
{

	public function __construct()
	{
		$this->load->database();
	}
	
	function buscar_exposicion($titulo = FALSE)
	{
		if ($titulo === FALSE) {
			$query = $this->db->get('exposicion');
			$resultados = $query->result_array();
			$Exposiciones = [];
			foreach ($resultados as $resultado) {
				$Exposiciones[] = $resultado;
			}
			return $Exposiciones;
		}
		$query = $this->db->get_where('exposicion', ['titulo' => $titulo]);
		$resultado = $query->row_array();
		if ($resultado != null) {
			return $resultado;
		}
		return $resultado;
		
	}

	function insertar_exposicion($data = FALSE)
	{
		if ($data != FALSE) {
			return $this->db->insert('exposicion', $data);
		}
		return -1;
	}

	function modificar_exposicion($data = FALSE)
	{
		if ($data != FALSE) {
			$this->db->where('id', $data['id']);
			return $this->db->update('exposicion', $data);
		}
		return -1;
	}

	function eliminar_exposicion($data = FALSE)
	{
		if ($data != FALSE) {
			return $this->db->delete('exposicion', $data);
		}
		return -1;
	}

}
