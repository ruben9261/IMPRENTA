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

	public function InsertarCotizacion($Cotizacion){
		$this->db->trans_start();

		$COTIZACION = array(
			'IdOrden' => $Cotizacion->IdOrden,
			'Codcotizacion' => $Cotizacion->Codcotizacion,
			'Descripcion' => $Cotizacion->Descripcion,
			'FechaCotizacion' => $Cotizacion->FechaCotizacion,
			'ImporteTotal' => $Cotizacion->ImporteTotal,
			'Igv' => $Cotizacion->Igv,
			'IdEstado' => $Cotizacion->IdEstado,
			'Importe' => $Cotizacion->Importe,
		);

		$this->db->insert('cotizacion', $COTIZACION);
		//$string = $this->db->get_compiled_select();
		$IdCotizacion = $this->db->insert_id();

		foreach($Cotizacion->ListaDetalleCotizacion as $item){
			$detallecotizacion = array(
				'IdCotizacion' => $IdCotizacion,
				'DescProducto' => $item["DescProducto"],
				'cantidad' => $item["cantidad"],
				'preciounitario' => $item["preciounitario"],
				'total' => $item["total"],
			);
			$this->db->insert('detallecotizacion',$detallecotizacion);
		}


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
			'IdCotizacion'=> $IdCotizacion
		);

		return $response;
	}

	public function ActualizarCotizacion($Cotizacion){
		$this->db->trans_start();

		$COTIZACION = array(
			'IdOrden' => $Cotizacion->IdOrden,
			'Codcotizacion' => $Cotizacion->Codcotizacion,
			'Descripcion' => $Cotizacion->Descripcion,
			'FechaCotizacion' => $Cotizacion->FechaCotizacion,
			'ImporteTotal' => $Cotizacion->ImporteTotal,
			'Igv' => $Cotizacion->Igv,
			'IdEstado' => $Cotizacion->IdEstado,
			'Importe' => $Cotizacion->Importe
		);

		$this->db->where('IdCotizacion', $Cotizacion->IdCotizacion);
		$this->db->update('cotizacion', $COTIZACION);
		$this->db->delete('detallecotizacion', array('IdCotizacion' => $Cotizacion->IdCotizacion));

		foreach($Cotizacion->ListaDetalleCotizacion as $item){
			$detallecotizacion = array(
				'IdCotizacion' => $Cotizacion->IdCotizacion,
				'DescProducto' => $item["DescProducto"],
				'cantidad' => $item["cantidad"],
				'preciounitario' => $item["preciounitario"],
				'total' => $item["total"],
			);
			$this->db->insert('detallecotizacion',$detallecotizacion);
		}


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
			'IdCotizacion'=> $Cotizacion->IdCotizacion
		);

		return $response;
	}

	public function EliminarCotizacion($Cotizacion){
		$this->db->trans_start();
		
		$this->db->delete('detallecotizacion', array('IdCotizacion' => $Cotizacion->IdCotizacion));
		$this->db->delete('cotizacion', array('IdCotizacion' => $Cotizacion->IdCotizacion));
		$this->db->trans_complete();

		$respuesta = FALSE;
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
			'IdCotizacion'=> $Cotizacion->IdCotizacion
		);

		return $response;
	}

	public function ListarCotizacion($Cotizacion){
		$this->db->select('c.IdCotizacion');
		$this->db->select('c.IdOrden');
		$this->db->select('c.Codcotizacion');
		$this->db->select('c.Descripcion');
		$this->db->select('c.FechaCotizacion');
		$this->db->select('c.ImporteTotal');
		$this->db->select('c.Igv');
		$this->db->select('c.IdEstado');
		$this->db->select('c.Importe');
		$this->db->from('cotizacion c');
		$this->db->join('estado e', 'c.IdEstado = e.IdEstado');
		$this->db->where('c.IdOrden',$Cotizacion->IdOrden);
		$string = $this->db->get_compiled_select();
        $query  = $this->db->query($string);
        //$numrow = $query->num_rows();
        $result = $query->result();

		return $result;
	}

	public function ListarDetalleCotizacion($Cotizacion){
		$this->db->select('dc.IdDetalleCotizacion');
		$this->db->select('dc.IdCotizacion');
		$this->db->select('dc.DescProducto');
		$this->db->select('dc.cantidad');
		$this->db->select('dc.preciounitario');
		$this->db->select('dc.total');
		$this->db->from('detallecotizacion dc');
        $this->db->where('dc.IdCotizacion',$Cotizacion->IdCotizacion);
		$string = $this->db->get_compiled_select();
        $query  = $this->db->query($string);
        //$numrow = $query->num_rows();
        $result = $query->result();

		return $result;
	}
}