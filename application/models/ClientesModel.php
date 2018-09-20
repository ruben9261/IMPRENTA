<?php if( ! defined ('BASEPATH')) exit('error al intentar acceder');


class ClientesModel extends CI_Model {
		
	public function _construct()
	{
		parent::_construct();
		$this->load->database('default');
	}

	public function ObtenerCliente($Cliente){
		$this->db->select('c.IdCliente');
		$this->db->select('c.razonsocial');
		$this->db->select('c.ruc');
		$this->db->select('c.tipo_negocio');
		$this->db->select('c.direccion');
		$this->db->select('c.telefono');
		$this->db->select('c.tipo_cliente');

		$this->db->from('Cliente c');

        $this->db->where('c.IdCliente',$Cliente->IdCliente);

		$string = $this->db->get_compiled_select();
        $query  = $this->db->query($string);
        $result = $query->result();

		return $result;
	}

	public function ListarRoles(){
        $this->db->select('r.IdRol');
        $this->db->select('r.NombreRol');
        $this->db->from('Rol r');

		$string = $this->db->get_compiled_select();
        $query  = $this->db->query($string);
        $result = $query->result();

		return $result;
	}
	
	public function ListarClientes($FiltrosClientes){

		$this->db->select('c.IdCliente');
		$this->db->select('c.razonsocial');
		$this->db->select('c.ruc');
		$this->db->select('c.tipo_negocio');
		$this->db->select('c.direccion');
		$this->db->select('c.telefono');
		$this->db->select('c.tipo_cliente');

		$this->db->from('Cliente c');
		
		// if($FiltrosClientes!=null)
        // $this->db->where('p.estado',$FiltrosClientes->Estado);

		$string = $this->db->get_compiled_select();
        $query  = $this->db->query($string);
        //$numrow = $query->num_rows();
        $result = $query->result();

		return $result;
	}

	public function InsertarCliente($Cliente){
		$this->db->trans_start();

		$CLIENTE = array(
			'razonsocial' => $Cliente->razonsocial,
			'ruc' => $Cliente->ruc,
			'tipo_negocio' => $Cliente->tipo_negocio,
			'direccion' => $Cliente->direccion,
			'telefono' => $Cliente->telefono,
			'tipo_cliente' => $Cliente->tipo_cliente
		);

		$this->db->insert('cliente', $CLIENTE);
		//$string = $this->db->get_compiled_select();
		$IdCliente = $this->db->insert_id();


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
			'IdCliente'=> $IdCliente
		);

		return $response;
	}

	public function ActualizarCliente($Cliente){
		$this->db->trans_start();

		$CLIENTE = array(
			'razonsocial' => $Cliente->razonsocial,
			'ruc' => $Cliente->ruc,
			'tipo_negocio' => $Cliente->tipo_negocio,
			'direccion' => $Cliente->direccion,
			'telefono' => $Cliente->telefono,
			'tipo_cliente' => $Cliente->tipo_cliente
		);

		$this->db->where('IdCliente', $Cliente->IdCliente);
		$this->db->update('cliente', $CLIENTE);

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
			'IdCliente'=> $Cliente->IdCliente
		);

		return $response;
	}

	public function EliminarCliente($Cliente){
		$this->db->trans_start();
		
		$this->db->delete('cliente', array('IdCliente' => $Cliente->IdCliente));

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