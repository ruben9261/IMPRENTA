<?php if( ! defined ('BASEPATH')) exit('error al intentar acceder');

class ClientesModel extends CI_Model {
		
	public function _construct()
	{
		parent::_construct();
		$this->load->database('default');
	}
	

	public function ListarClientes()
	{
		$string = $this->db->get_compiled_select("cliente");
        $query  = $this->db->query($string);
        $result = $query->result();

		return $result;
	}
}