<?php if( ! defined ('BASEPATH')) exit('error al intentar acceder');


class OrdenModel extends CI_Model {
		
	public function _construct()
	{
		parent::_construct();
		$this->load->database('default');
	}
	
	

	public function ObtenerCotizacion()
	{	
		$this->db->select('o.IdOrden');
		$this->db->select('o.IdCliente');
		$this->db->select('o.IdEmpleado');
		$this->db->select('o.IdEmpresa');
		$this->db->from('orden o');
		$this->db->join('proveedor p', 'os.COD_PROVEEDOR = p.COD_PROV');
		//$string = $this->db->get_compiled_select();
		$query  = $this->db->get();
		$result = $query->result();

		return $result;
	}

	public function obt_totpaginas($Filtros){
		$TotalPaginas = 0;
		$this->db->select('dc.COD_DOC_PAGO,prov.NOMBRE, prov.NRO_DOCUMENTO, u.COD_USU, u.NOM_USU,c.DESC_CAJA,tp.NOM_TIPOPAGO');
		$this->db->from('doc_pago dc');
		$this->db->join('Proveedor prov', 'dc.COD_PROV = prov.COD_PROV');
		$this->db->join('usuario u', 'dc.COD_USU = u.COD_USU');
		$this->db->join('caja c', 'dc.COD_CAJA = c.COD_CAJA');
		$this->db->join('tipo_pago tp', 'dc.COD_TIPOPAGO = tp.COD_TIPOPAGO');
		$this->db->where("((".$Filtros["COD_PROV"]."=0) or(dc.COD_PROV=".$Filtros["COD_PROV"]."))");
		$this->db->where("((".$Filtros["COD_USU"]."=0) or(u.COD_USU=".$Filtros["COD_USU"]."))");
		$this->db->where("((".$Filtros["COD_TIPOPAGO"]."=0) or(dc.COD_TIPOPAGO=".$Filtros["COD_TIPOPAGO"]."))");
		$this->db->where("(('".$Filtros["COD_DOC_PAGO"]."'='') or(dc.COD_DOC_PAGO='".$Filtros["COD_DOC_PAGO"]."'))");
		$this->db->where("(('".$Filtros["DOC_PAGO_FECHA"]."'='') or(date(dc.DOC_PAGO_FECHA)='".$Filtros["DOC_PAGO_FECHA"]."'))");
		//$string = $this->db->get_compiled_select();
		$query  = $this->db->get();
		$result = $query->result();
		//$error = $this->db->error_message();
		$TotalRegistros = $this->db->count_all_results()+1;
		$TotalPaginas = round($TotalRegistros/10)+1;
		return $TotalPaginas;
	}

	public function obt_Usuarios()
	{	$query  = $this->db->get("usuario");
		$result = $query->result();
		return $result;
	}

	public function obt_lista($Filtros){

		$P_numpagina = $Filtros["numpagina"] - 1;
		$filasxpagina = 10;
		$inicio = round($P_numpagina/$filasxpagina);

				$this->db->select('dc.COD_DOC_PAGO,prov.NOMBRE, prov.NRO_DOCUMENTO, u.COD_USU, u.NOM_USU,c.DESC_CAJA,tp.NOM_TIPOPAGO');
				$this->db->from('doc_pago dc');
				$this->db->join('Proveedor prov', 'dc.COD_PROV = prov.COD_PROV');
				$this->db->join('usuario u', 'dc.COD_USU = u.COD_USU');
				$this->db->join('caja c', 'dc.COD_CAJA = c.COD_CAJA');
				$this->db->join('tipo_pago tp', 'dc.COD_TIPOPAGO = tp.COD_TIPOPAGO');
				$this->db->where("((".$Filtros["COD_PROV"]."=0) or(dc.COD_PROV=".$Filtros["COD_PROV"]."))");
				$this->db->where("((".$Filtros["COD_USU"]."=0) or(u.COD_USU=".$Filtros["COD_USU"]."))");
				$this->db->where("((".$Filtros["COD_TIPOPAGO"]."=0) or(dc.COD_TIPOPAGO=".$Filtros["COD_TIPOPAGO"]."))");
				$this->db->where("(('".$Filtros["COD_DOC_PAGO"]."'='') or(dc.COD_DOC_PAGO='".$Filtros["COD_DOC_PAGO"]."'))");
				$this->db->where("(('".$Filtros["DOC_PAGO_FECHA"]."'='') or(date(dc.DOC_PAGO_FECHA)='".$Filtros["DOC_PAGO_FECHA"]."'))");
				$this->db->limit($filasxpagina,$inicio);
				//$string = $this->db->get_compiled_select();
				$query  = $this->db->get();
				$result = $query->result();

		return $result;
	}

	public function GuardarDocPago($DocPago)
	{	
		$this->db->trans_start();
		//$FECHA_OPERACION = "1900-10-10";
		date_default_timezone_set('America/Lima');
		$DOC_PAGO_FECHA = date('Y/m/d', time());
		$FECHA_OPERACION = date('Y/m/d', time());
		$COD_DOC_PAGO = 0;

		$doc_pago = array(
				'COD_OFI' => $DocPago["COD_OFI"],
				'DOC_PAGO_FECHA' => $DOC_PAGO_FECHA,
				'COD_CAJA' => $DocPago["COD_CAJA"],
				'COD_PROV' => $DocPago["COD_PROV"],
				'NRO_DOCUMENTO' => $DocPago["NRO_DOCUMENTO"],
				'NUMERO_CUENTA' => $DocPago["NUMERO_CUENTA"],
				'COD_TIPO_DOC' => $DocPago["COD_TIPO_DOC"],
				'FECHA_OPERACION' => $DocPago["FECHA_OPERACION"] == "Invalid date"?$FECHA_OPERACION:$DocPago["FECHA_OPERACION"],
				'NUMERO_OPERACION' => $DocPago["NUMERO_OPERACION"],
				'OBSERVACION' => $DocPago["OBSERVACION"],
				'COD_USU' => $DocPago["COD_USU"],
				'IGV' => 0,
				'MONTO_TOTAL' => $DocPago["MONTO_TOTAL"],
				'MONTO_NETO' => $DocPago["MONTO_NETO"],
				'COD_TIPOPAGO' => $DocPago["COD_TIPOPAGO"]
		);
		
		$this->db->insert('doc_pago', $doc_pago);
		//$string = $this->db->get_compiled_select();
		$COD_DOC_PAGO = $this->db->insert_id();
		
		foreach($DocPago["listDocPagoDet"] as $item){
			$doc_pago_detalle = array(
				'COD_DOC_PAGO' => $COD_DOC_PAGO,
				'COD_ORDEN_S' => $item["COD_ORDEN_S"],
				'SUB_TOTAL' => $item["SUB_TOTAL"]
			);
			$this->db->insert('doc_pago_detalle',$doc_pago_detalle);
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
			'COD_DOC_PAGO'=> $COD_DOC_PAGO
		);

		return $response;
	}

	public function updateDocPago($DocPago)
	{	
		$this->db->trans_start();

		date_default_timezone_set('America/Lima');
		$doc_pago_FECHA = date('Y/m/d', time());
		$COD_DOC_PAGO = $DocPago['COD_DOC_PAGO'];
		$FECHA_OPERACION = date('Y/m/d', time());
		$doc_pago = array(
				'COD_OFI' => $DocPago["COD_OFI"],
				'doc_pago_FECHA' => $doc_pago_FECHA,
				'COD_CAJA' => $DocPago["COD_CAJA"],
				'COD_PROV' => $DocPago["COD_PROV"],
				'NRO_DOCUMENTO' => $DocPago["NRO_DOCUMENTO"],
				'NUMERO_CUENTA' => $DocPago["NUMERO_CUENTA"],
				'COD_TIPO_DOC' => $DocPago["COD_TIPO_DOC"],
				'FECHA_OPERACION' => $DocPago["FECHA_OPERACION"] == "Invalid date"?$FECHA_OPERACION:$DocPago["FECHA_OPERACION"],
				'NUMERO_OPERACION' => $DocPago["NUMERO_OPERACION"],
				'OBSERVACION' => $DocPago["OBSERVACION"],
				'COD_USU' => $DocPago["COD_USU"],
				'IGV' => 0,
				'MONTO_TOTAL' => $DocPago["MONTO_TOTAL"],
				'MONTO_NETO' => $DocPago["MONTO_NETO"],
				'COD_TIPOPAGO' => $DocPago["COD_TIPOPAGO"]
		);

		$this->db->where('COD_DOC_PAGO', $COD_DOC_PAGO);
		$this->db->update('doc_pago', $doc_pago);
		$this->db->delete('doc_pago_detalle', array('COD_DOC_PAGO' => $COD_DOC_PAGO));

		foreach($DocPago["listDocPagoDet"] as $item){
			$doc_pago_detalle = array(
				'COD_DOC_PAGO' => $COD_DOC_PAGO,
				'COD_ORDEN_S' => $item["COD_ORDEN_S"],
				'SUB_TOTAL' => $item["SUB_TOTAL"]
			);
			$this->db->insert('doc_pago_detalle',$doc_pago_detalle);
		}

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
			'COD_DOC_PAGO'=> $COD_DOC_PAGO,
			
		);

		return $response;
	}

	public function eliminar($COD_DOC_PAGO){
		$this->db->trans_start();
		
		$this->db->delete('doc_pago', array('COD_DOC_PAGO' => $COD_DOC_PAGO));
		$this->db->delete('doc_pago_detalle', array('COD_DOC_PAGO' => $COD_DOC_PAGO));

		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return FALSE;
		} 
		else {
			$this->db->trans_commit();
			return TRUE;
		}
	}
	
}
