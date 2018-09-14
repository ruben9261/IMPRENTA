<?php if( ! defined ('BASEPATH')) exit('error al intentar acceder');


class OrdenModel extends CI_Model {
		
	public function _construct()
	{
		parent::_construct();
		$this->load->database('default');
	}

	public function ListarOrdenes($FiltrosOrden)
	{	
		$this->db->select('o.IdOrden');
		$this->db->select('o.DescripcionOrden');
        $this->db->select('o.FechaRegistro');
        $this->db->select('p.nombre');
        $this->db->select('c.razonsocial');

		$this->db->from('Orden o');
        $this->db->join('usuario u', 'o.IdEmpleado = u.IdUsuario');
		$this->db->join('Personas p', 'u.IdPersona = p.IdPersona');
		$this->db->join('cliente c', 'o.IdCliente = c.IdCliente');
		
		if($FiltrosOrden!=null)
        $this->db->where('p.estado',$FiltrosOrden->Estado);

		$string = $this->db->get_compiled_select();
        $query  = $this->db->query($string);
        //$numrow = $query->num_rows();
        $result = $query->result();

		return $result;
	}

}
