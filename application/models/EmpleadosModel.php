<?php if( ! defined ('BASEPATH')) exit('error al intentar acceder');


class EmpleadosModel extends CI_Model {
		
	public function _construct()
	{
		parent::_construct();
		$this->load->database('default');
	}

	public function ObtenerEmpleado($Usuario){
		$this->db->select('u.IdUsuario');
		$this->db->select('u.IdPersona');
        $this->db->select('u.IdRol');
        $this->db->select('u.NombreUsuario');
        $this->db->select('r.NombreRol');
        $this->db->select('p.Nombre');
		$this->db->select('p.Dni');
		$this->db->select('p.Cargo');
		$this->db->select('p.Telefono');
		$this->db->select('p.Direccion');

		$this->db->from('Usuario u');
        $this->db->join('Rol r', 'u.IdRol = r.IdRol');
        $this->db->join('Personas p', 'u.IdPersona = p.IdPersona');

        $this->db->where('u.IdUsuario',$Usuario->IdUsuario);

		$string = $this->db->get_compiled_select();
        $query  = $this->db->query($string);
        $result = $query->result();

		return $result;
	}
	
	public function ListarEmpleados($FiltrosEmpleado){

		$this->db->select('u.IdUsuario');
		$this->db->select('u.IdPersona');
        $this->db->select('u.IdRol');
        $this->db->select('u.NombreUsuario');
        $this->db->select('r.NombreRol');
        $this->db->select('p.Nombre');
		$this->db->select('p.Dni');
		$this->db->select('p.Cargo');
		$this->db->select('p.Telefono');
		$this->db->select('p.Direccion');

		$this->db->from('Usuario u');
        $this->db->join('Rol r', 'u.IdRol = r.IdRol');
        $this->db->join('Personas p', 'u.IdPersona = p.IdPersona');

        $this->db->where('p.estado',$FiltrosEmpleado->Estado);

		$string = $this->db->get_compiled_select();
        $query  = $this->db->query($string);
        //$numrow = $query->num_rows();
        $result = $query->result();

		return $result;
	}

	public function InsertarEmpleado($Empleado){
		$this->db->trans_start();

		$PERSONAS = array(
			'Nombre' => $Empleado->Nombre,
			'Dni' => $Empleado->Dni,
			'Cargo' => $Empleado->Cargo,
			'Telefono' => $Empleado->Telefono,
			'Direccion' => $Empleado->Direccion,
			'Estado' => 'activo',
		);

		$this->db->insert('personas', $PERSONAS);
		//$string = $this->db->get_compiled_select();
		$IdPersona = $this->db->insert_id();

		$USUARIO = array(
			'IdPersona' => $IdPersona,
			'IdRol' => $Empleado->IdRol,
			'NombreUsuario' => $Empleado->NombreUsuario,
			'PasswordUsuario' => $Empleado->PasswordUsuario
		);
		$this->db->insert('usuario', $USUARIO);
		$IdUsuario = $this->db->insert_id();


		$respuesta = FALSE;
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$respuesta =  FALSE;
		} 
		else {
			$this->db->trans_commit();
			$respuesta =  TRUE;
		}

		
		$response = array(
			'respuesta' => $respuesta,
			'IdUsuario'=> $IdUsuario,
			'IdPersona'=> $IdPersona
		);

		return $response;
	}

	public function ActualizarEmpleado($Empleado){
		$this->db->trans_start();

		$PERSONAS = array(
			'Nombre' => $Empleado->Nombre,
			'Dni' => $Empleado->Dni,
			'Cargo' => $Empleado->Cargo,
			'Telefono' => $Empleado->Telefono,
			'Direccion' => $Empleado->Direccion,
			'Estado' => 'activo',
		);

		$this->db->where('IdPersona', $Empleado->IdPersona);
		$this->db->update('personas', $PERSONAS);

		$USUARIO = array(
			'IdPersona' => $IdPersona,
			'IdRol' => $Empleado->IdRol,
			'NombreUsuario' => $Empleado->NombreUsuario,
			'PasswordUsuario' => $Empleado->PasswordUsuario
		);

		$this->db->where('IdUsuario', $Empleado->IdUsuario);
		$this->db->update('usuario', $USUARIO);

		$this->db->trans_complete();

		$respuesta = false;
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$respuesta = FALSE;
		} 
		else {
			$this->db->trans_commit();
			$respuesta = TRUE;
		}
		
		$response = array(
			'respuesta' => $respuesta,
			'IdUsuario'=> $IdUsuario,
			'IdPersona'=> $IdPersona
		);

		return $response;
	}

	public function EliminarEmpleado($Empleado){
		$this->db->trans_start();
		
		$this->db->delete('usuario', array('IdUsuario' => $Empleado->IdUsuario));
		$this->db->delete('personas', array('IdPersona' => $Empleado->IdPersona));

		$this->db->trans_complete();

		$respuesta = false;
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$respuesta =  FALSE;
		} 
		else {
			$this->db->trans_commit();
			$respuesta =  TRUE;
		}

		$response = array(
			'respuesta' => $respuesta
		);

		return $response;
	}

}