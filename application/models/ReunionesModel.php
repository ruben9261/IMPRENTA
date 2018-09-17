<?php if( ! defined ('BASEPATH')) exit('error al intentar acceder');


class ReunionesModel extends CI_Model {
		
	public function _construct()
	{
		parent::_construct();
		$this->load->database('default');
	}
	
	
	//querybuilder

	public function InsertarReunion($Reunion){
        $this->db->trans_start();
        
        if(isset($Reunion->IdReunionPadre)){
            $REUNION = array(
                'IdOrden' => $Reunion->IdOrden,
                'IdReunionPadre' => $Reunion->IdReunionPadre,
                'Descripcion' => $Reunion->Descripcion,
                'IdEstado' => $Reunion->IdEstado,
                'NroReunion' => $Reunion->NroReunion
            );
        }else{
            $REUNION = array(
                'IdOrden' => $Reunion->IdOrden,
                'Descripcion' => $Reunion->Descripcion,
                'IdEstado' => $Reunion->IdEstado,
                'NroReunion' => $Reunion->NroReunion
            );
        }


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

		if(isset($Reunion->IdReunionPadre)){
            $REUNION = array(
                'IdOrden' => $Reunion->IdOrden,
                'IdReunionPadre' => $Reunion->IdReunionPadre,
                'Descripcion' => $Reunion->Descripcion,
                'IdEstado' => $Reunion->IdEstado,
                'NroReunion' => $Reunion->NroReunion
            );
        }else{
            $REUNION = array(
                'IdOrden' => $Reunion->IdOrden,
                'Descripcion' => $Reunion->Descripcion,
                'IdEstado' => $Reunion->IdEstado,
                'NroReunion' => $Reunion->NroReunion
            );
        }

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

	public function ListarReunion($Reunion)
	{	
        $this->db->select('r.IdReunion');
        $this->db->select('r.IdOrden');
        $this->db->select('r.IdReunionPadre');
        $this->db->select('r.Descripcion');
        $this->db->select('r.IdEstado');
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
}