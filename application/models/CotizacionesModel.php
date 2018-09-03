<?php if( ! defined ('BASEPATH')) exit('error al intentar acceder');


class CotizacionesModel extends CI_Model {
		
	public function _construct()
	{
		parent::_construct();
		$this->load->database('default');
	}
	
	
	//querybuilder
	public function GetCotizaciones($Usuario)
	{	
		$this->db->select('u.IdUsuario');
		$this->db->select('u.IdPersona');
        $this->db->select('u.IdRol');
        $this->db->select('r.NombreRol');
        $this->db->select('p.nombre');
        $this->db->select('p.dni');
		$this->db->from('Usuario u');
        $this->db->join('Rol r', 'u.IdRol = r.IdRol');
        $this->db->join('Personas p', 'u.IdPersona = p.IdPersona');
        $this->db->where('u.NombreUsuario',$Usuario["NombreUsuario"]);
        $this->db->where('u.PasswordUsuario',$Usuario["PasswordUsuario"]);
		$string = $this->db->get_compiled_select();
        $query  = $this->db->query($string);
        //$numrow = $query->num_rows();
        $result = $query->result();

		return $result;
	}
}