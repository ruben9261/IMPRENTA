<?php if( ! defined ('BASEPATH')) exit('error al intentar acceder');


class ReunionesModel extends CI_Model {
		
	public function _construct()
	{
		parent::_construct();
		$this->load->database('default');
	}

	public function InsertarReunion($Reunion){
		$this->db->trans_start();
        
        $REUNION = array(
			'IdTipoEntrega' => $Reunion->IdTipoEntrega,
			'NombreContacto' => $Reunion->NombreContacto,
			'IdEstado' => $Reunion->IdEstado,
			'FechaVisita' => date("Y-m-d",strtotime($Reunion->FechaVisita)),
			'Observaciones' => $Reunion->Observaciones,
			'IdTipoInteres' => $Reunion->IdTipoInteres,
			'ProximaVisita' => date("Y-m-d",strtotime($Reunion->ProximaVisita)),
			'TelefonoReferencial' => $Reunion->TelefonoReferencial,
			'NroReunion' => $Reunion->NroReunion,
			'IdOrden' => $Reunion->IdOrden
		);


		$this->db->insert('reunion', $REUNION);
		//$string = $this->db->get_compiled_select();
		$IdReunion = $this->db->insert_id();


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
			'IdReunion'=> $IdReunion
		);

		return $response;
	}

	public function ActualizarReunion($Reunion){
		$this->db->trans_start();

		$REUNION = array(
			'IdTipoEntrega' => $Reunion->IdTipoEntrega,
			'NombreContacto' => $Reunion->NombreContacto,
			'IdEstado' => $Reunion->IdEstado,
			'FechaVisita' => date("Y-m-d",strtotime($Reunion->FechaVisita)),
			'Observaciones' => $Reunion->Observaciones,
			'IdTipoInteres' => $Reunion->IdTipoInteres,
			'ProximaVisita' => date("Y-m-d",strtotime($Reunion->ProximaVisita)),
			'TelefonoReferencial' => $Reunion->TelefonoReferencial,
			'NroReunion' => $Reunion->NroReunion,
			'IdOrden' => $Reunion->IdOrden
		);

		$this->db->where('IdReunion', $Reunion->IdReunion);
		$this->db->update('reunion', $REUNION);


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
			'IdReunion'=> $Reunion->IdReunion
		);

		return $response;
	}

	public function EliminarReunion($Reunion){
		$this->db->trans_start();
		
		$this->db->delete('reunion', array('IdReunion' => $Reunion->IdReunion));
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
			'IdReunion'=> $Reunion->IdReunion
		);

		return $response;
	}

	public function ObtenerReunion($Reunion)
	{	
		$this->db->select('r.IdReunion');
        $this->db->select('r.IdTipoEntrega');
		$this->db->select('r.NombreContacto');
		$this->db->select('r.IdEstado');
        $this->db->select('DATE_FORMAT(r.FechaVisita,"%d-%m-%Y") FechaVisita');
        $this->db->select('r.Observaciones');
		$this->db->select('r.IdTipoInteres');
		$this->db->select('DATE_FORMAT(r.ProximaVisita,"%d-%m-%Y") ProximaVisita');
		$this->db->select('r.TelefonoReferencial');
		$this->db->select('r.IdOrden');
		$this->db->select('r.NroReunion');
		$this->db->from('Reunion r');
        $this->db->where('r.IdOrden',$Reunion->IdOrden);
        $this->db->where('r.NroReunion',$Reunion->NroReunion);
		$string = $this->db->get_compiled_select();
        $query  = $this->db->query($string);
        //$numrow = $query->num_rows();
        $result = $query->result();

		return $result;
	}

	public function ListarReunion($FiltrosReunion)
	{	
		$this->db->select('r.IdReunion');
        $this->db->select('r.IdTipoEntrega');
		$this->db->select('r.NombreContacto');
		$this->db->select('r.IdEstado');
        $this->db->select('DATE_FORMAT(r.FechaVisita,"%d-%m-%Y") FechaVisita');
        $this->db->select('r.Observaciones');
		$this->db->select('r.IdTipoInteres');
		$this->db->select('DATE_FORMAT(r.ProximaVisita,"%d-%m-%Y") ProximaVisita');
		$this->db->select('r.TelefonoReferencial');
		$this->db->select('r.IdOrden');
		$this->db->select('r.NroReunion');
		$this->db->from('Reunion r');

		if(isset($FiltrosReunion))
		$this->db->where('r.IdOrden',$FiltrosReunion->IdOrden);
		
		$string = $this->db->get_compiled_select();
        $query  = $this->db->query($string);
        //$numrow = $query->num_rows();
        $result = $query->result();

		return $result;
	}
}