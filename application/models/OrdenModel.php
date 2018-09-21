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
        $this->db->select('DATE_FORMAT(o.FechaRegistro,"%d-%m-%Y") FechaRegistro');
        $this->db->select('p.nombre');
		$this->db->select('c.razonsocial');
		$this->db->select('cot.IdEstado');
		$this->db->select('case when EXISTS(select IFNULL(IdEstado,0) from reunion reu 
						where reu.IdOrden = o.IdOrden and reu.NroReunion = 1)
						then (select IdEstado from reunion reu where reu.IdOrden = o.IdOrden and reu.NroReunion = 1) 
						else 0 end IdEstadoReunion1');
		$this->db->select('case when EXISTS(select IdEstado from reunion reu 
		where reu.IdOrden = o.IdOrden and reu.NroReunion = 2)
		then (select IdEstado from reunion reu where reu.IdOrden = o.IdOrden and reu.NroReunion = 2) 
		else 0 end IdEstadoReunion2');
		$this->db->select('case when EXISTS(select IdEstado from reunion reu 
		where reu.IdOrden = o.IdOrden and reu.NroReunion = 3)
		then (select IdEstado from reunion reu where reu.IdOrden = o.IdOrden and reu.NroReunion = 3) 
		else 0 end IdEstadoReunion3');
		$this->db->select('case when EXISTS(select IdEstado from reunion reu 
		where reu.IdOrden = o.IdOrden and reu.NroReunion = 4)
		then (select IdEstado from reunion reu where reu.IdOrden = o.IdOrden and reu.NroReunion = 4) 
		else 0 end IdEstadoReunion4');

		$this->db->from('Orden o');
        $this->db->join('usuario u', 'o.IdEmpleado = u.IdUsuario');
		$this->db->join('Personas p', 'u.IdPersona = p.IdPersona');
		$this->db->join('cliente c', 'o.IdCliente = c.IdCliente');
		$this->db->join('Cotizacion cot', 'o.IdOrden = cot.IdOrden', 'left');
		
		
		// if($FiltrosOrden!=null)
        // $this->db->where('p.estado',$FiltrosOrden->Estado);

		$string = $this->db->get_compiled_select();
        $query  = $this->db->query($string);
        //$numrow = $query->num_rows();
        $result = $query->result();

		return $result;
	}

	public function ObtenerOrden($Orden)
	{	
		$this->db->select('o.IdOrden');
		$this->db->select('u.IdUsuario');
		$this->db->select('c.IdCliente');
		$this->db->select('o.DescripcionOrden');
        $this->db->select('DATE_FORMAT(o.FechaRegistro,"%d-%m-%Y") FechaRegistro');
        $this->db->select('p.nombre');
        $this->db->select('c.razonsocial');

		$this->db->from('Orden o');
        $this->db->join('usuario u', 'o.IdEmpleado = u.IdUsuario');
		$this->db->join('Personas p', 'u.IdPersona = p.IdPersona');
		$this->db->join('cliente c', 'o.IdCliente = c.IdCliente');
		
        $this->db->where('o.IdOrden',$Orden->IdOrden);

		$string = $this->db->get_compiled_select();
        $query  = $this->db->query($string);
        //$numrow = $query->num_rows();
        $result = $query->result();

		return $result;
	}

	public function InsertarOrden($Orden){
		$this->db->trans_start();

		$ORDEN = array(
			'DescripcionOrden' => $Orden->DescripcionOrden,
			'FechaRegistro' => date("Y-m-d",strtotime($Orden->FechaRegistro)),
			'IdEmpleado' => $Orden->IdUsuario,
			'IdCliente' => $Orden->IdCliente
		);

		$this->db->insert('Orden', $ORDEN);
		//$string = $this->db->get_compiled_select();
		$IdOrden = $this->db->insert_id();

		// $USUARIO = array(
		// 	'IdPersona' => $IdPersona,
		// 	'IdRol' => $Empleado->IdRol,
		// 	'NombreUsuario' => $Empleado->NombreUsuario,
		// 	'PasswordUsuario' => $Empleado->PasswordUsuario
		// );
		// $this->db->insert('usuario', $USUARIO);
		// $IdUsuario = $this->db->insert_id();


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
			'IdOrden'=> $IdOrden
		);

		return $response;
	}

	public function ActualizarOrden($Orden){
		$this->db->trans_start();

		$ORDEN = array(
			'DescripcionOrden' => $Orden->DescripcionOrden,
			'FechaRegistro' => date("Y-m-d",strtotime($Orden->FechaRegistro)),
			'IdEmpleado' => $Orden->IdUsuario,
			'IdCliente' => $Orden->IdCliente
		);

		$this->db->where('IdOrden', $Orden->IdOrden);
		$this->db->update('Orden', $ORDEN);

		// $USUARIO = array(
		// 	'IdPersona' => $Empleado->IdPersona,
		// 	'IdRol' => $Empleado->IdRol,
		// 	'NombreUsuario' => $Empleado->NombreUsuario,
		// 	'PasswordUsuario' => $Empleado->PasswordUsuario
		// );

		// $this->db->where('IdUsuario', $Empleado->IdUsuario);
		// $this->db->update('usuario', $USUARIO);

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
			'IdOrden'=> $Orden->IdOrden
		);

		return $response;
	}

}
