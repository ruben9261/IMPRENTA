<?php if( ! defined ('BASEPATH')) exit('error al intentar acceder');


class ValoresComunes extends CI_Model {
		
	public function _construct()
	{
		parent::_construct();
		$this->load->database('default');
	}

	public function ListarTipoInteres()
	{	
		$this->db->select('t.IdTipoInteres');
        $this->db->select('t.DescTipoInteres');
		$this->db->from('TipoInteres t');
		
		$string = $this->db->get_compiled_select();
        $query  = $this->db->query($string);
        //$numrow = $query->num_rows();
        $result = $query->result();

		return $result;
    }
    
    public function ListarTipoEntrega()
	{	
		$this->db->select('t.IdTipoEntrega');
        $this->db->select('t.DescTipoEntrega');
		$this->db->from('TipoEntrega t');
		
		$string = $this->db->get_compiled_select();
        $query  = $this->db->query($string);
        //$numrow = $query->num_rows();
        $result = $query->result();

		return $result;
	}
}