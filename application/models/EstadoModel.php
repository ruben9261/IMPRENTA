<?php if( ! defined ('BASEPATH')) exit('error al intentar acceder');


class EstadoModel extends CI_Model {
		
	public function _construct()
	{
		parent::_construct();
		$this->load->database('default');
    }

    public function ListarEstados(){
		$string = $this->db->get_compiled_select('estado');
        $query  = $this->db->query($string);
        //$numrow = $query->num_rows();
        $result = $query->result();

		return $result;
    }
    
}