<?php if( ! defined ('BASEPATH')) exit('error al intentar acceder');


class CotizacionesController extends CI_Controller {
	
	
	public function _construct()
	{	parent::_construct();
	}
	
	
	public function index() {

	  $IdOrden = $_GET["IdOrden"];
	  
	  $this->load->model('EstadoModel','EstadoModel');
	  $ListaEstados=$this->EstadoModel->ListarEstados();

	  $Cotizacion = new stdClass();
	  $Cotizacion->IdCotizacion = 0;
	  $Cotizacion->IdOrden = $IdOrden;
	  $ListaDetalleCotizacion = array();

	  $this->load->model('CotizacionesModel','CotizacionesModel');
	  $ListaCotizacion=$this->CotizacionesModel->ListarCotizacion($Cotizacion);
	  $Cotizacion = $ListaCotizacion != null ? (object)$ListaCotizacion[0] : $Cotizacion;

	  if($Cotizacion->IdCotizacion!=0){
		$this->load->model('CotizacionesModel','CotizacionesModel');
	  	$ListaDetalleCotizacion=$this->CotizacionesModel->ListarDetalleCotizacion($Cotizacion);
	  }

	  $data['IdOrden'] = $IdOrden;
	  $data['ListaEstados'] = $ListaEstados;
	  $data['Cotizacion'] = $Cotizacion;
	  $data['ListaDetalleCotizacion'] = $ListaDetalleCotizacion;

	  $this->load->view("Cotizacion",$data);
       // $this->load->view("prueba2");
	}


	public function GuardarCotizacion(){
		$Cotizacion = (object)$_POST["Cotizacion"];
		$this->load->model('CotizacionesModel','CotizacionesModel');
		if((int)$Cotizacion->IdCotizacion==0){
			$respuesta=$this->CotizacionesModel->InsertarCotizacion($Cotizacion);
		}else{
			$respuesta=$this->CotizacionesModel->ActualizarCotizacion($Cotizacion);
		}
		$jsonResponse = json_encode($respuesta);
		
		echo $jsonResponse;
	}

	public function EliminarCotizacion($Cotizacion){
		$Cotizacion = (object)$_POST["Cotizacion"];
		$this->load->model('CotizacionesModel','CotizacionesModel');
		$respuesta=$this->CotizacionesModel->EliminarCotizacion($Cotizacion);

		$jsonResponse = json_encode($respuesta);
		
		echo $jsonResponse;
	}
}