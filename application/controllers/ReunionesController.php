<?php if( ! defined ('BASEPATH')) exit('error al intentar acceder');


class ReunionesController extends CI_Controller {
	
	
	public function __construct()
	{	parent::__construct();
		$this->load->library('session');
		if (!$this->session->userdata('Loggedin'))
        {
			header('Location: /LoginController');
		}
		$this->load->model('EstadoModel','EstadoModel');
		$this->load->model('ReunionesModel','ReunionesModel');
		$this->load->model('ValoresComunes','ValoresComunes');
	}
	
	
	public function index() {

      $IdOrden = $_GET["IdOrden"];
      $NroReunion = $_GET["NroReunion"];
	  
	  $ListaEstados=$this->EstadoModel->ListarEstados();
	  $ListaTipoInteres=$this->ValoresComunes->ListarTipoInteres();
	  $ListaTipoEntrega=$this->ValoresComunes->ListarTipoEntrega();
		
	  $Reunion = new stdClass();
	  $Reunion->IdReunion = 0;
	  $Reunion->IdOrden = $IdOrden;
	  $Reunion->NroReunion = $NroReunion;

	  $ReunionObject=$this->ReunionesModel->ObtenerReunion($Reunion);
	  $Reunion = $ReunionObject != null ? (object)$ReunionObject[0] : $Reunion;

      $data['IdOrden'] = $IdOrden;
      $data['NroReunion'] = $NroReunion;
	  $data['ListaEstados'] = $ListaEstados;
	  $data['ListaTipoInteres'] = $ListaTipoInteres;
	  $data['ListaTipoEntrega'] = $ListaTipoEntrega;
	  $data['Reunion'] = $Reunion;

		if($NroReunion == 1){
			$this->load->view("Reunion",$data);
		}
		if($NroReunion == 2){
			$this->load->view("Reunion2",$data);
		}
		if($NroReunion == 3){
			$this->load->view("Reunion3",$data);
		}
		if($NroReunion == 4){
			$this->load->view("Reunion4",$data);
		}
	}
	
	public function GuardarReunion(){
		$Reunion = (object)$_POST["Reunion"];
		if((int)$Reunion->IdReunion==0){
			$respuesta=$this->ReunionesModel->InsertarReunion($Reunion);
		}else{
			$respuesta=$this->ReunionesModel->ActualizarReunion($Reunion);
		}
		$jsonResponse = json_encode($respuesta);
		
		echo $jsonResponse;
	}

	public function EliminarReunion($Reunion){
		$Reunion = (object)$_POST["Reunion"];

		$respuesta=$this->ReunionesModel->EliminarReunion($Reunion);

		$jsonResponse = json_encode($respuesta);
		
		echo $jsonResponse;
	}
    
}