<?php if( ! defined ('BASEPATH')) exit('error al intentar acceder');


class EmpleadosModel extends CI_Model {
		
	public function _construct()
	{
		parent::_construct();
		$this->load->database('default');
	}

	public function ListarEmpleados($FiltrosEmpleado){

		$this->db->select('u.IdUsuario');
		$this->db->select('u.IdPersona');
        $this->db->select('u.IdRol');
        $this->db->select('u.NombreUsuario');
        $this->db->select('r.NombreRol');
        $this->db->select('p.nombre');
        $this->db->select('p.dni');
        $this->db->select('p.estado');

		$this->db->from('Usuario u');
        $this->db->join('Rol r', 'u.IdRol = r.IdRol');
        $this->db->join('Personas p', 'u.IdPersona = p.IdPersona');

        $this->db->where('p.estado',$FiltrosEmpleado["estado"]);

		$string = $this->db->get_compiled_select();
        $query  = $this->db->query($string);
        //$numrow = $query->num_rows();
        $result = $query->result();

		return $result;
	}

	public function ObtenerEmpleado($IdEmpleado){

	}

	public function GuardarEmpleado($Empleado){

	}

	public function EliminarEmpleado($IdEmpleado){

	}

}