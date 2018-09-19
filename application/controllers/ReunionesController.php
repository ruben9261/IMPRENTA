<?php if( ! defined ('BASEPATH')) exit('error al intentar acceder');


class ReunionesController extends CI_Controller {
	
	
	public function _construct()
	{	parent::_construct();
	}
	
	
	public function index() {

      $IdOrden = $_GET["IdOrden"];
      $NroReunion = $_GET["NroReunion"];
	  
	  $this->load->model('EstadoModel','EstadoModel');
	  $ListaEstados=$this->EstadoModel->ListarEstados();

	  $Cotizacion = new stdClass();
	  $Cotizacion->IdCotizacion = 0;
	  $Cotizacion->IdOrden = $IdOrden;
	  $ListaDetalleCotizacion = array();

	//   $this->load->model('CotizacionesModel','CotizacionesModel');
	//   $ListaCotizacion=$this->CotizacionesModel->ListarCotizacion($Cotizacion);
	//   $Cotizacion = $ListaCotizacion != null ? (object)$ListaCotizacion[0] : $Cotizacion;

	//   if($Cotizacion->IdCotizacion!=0){
	// 	$this->load->model('CotizacionesModel','CotizacionesModel');
	//   	$ListaDetalleCotizacion=$this->CotizacionesModel->ListarDetalleCotizacion($Cotizacion);
	//   }

      $data['IdOrden'] = $IdOrden;
      $data['NroReunion'] = $NroReunion;
	  $data['ListaEstados'] = $ListaEstados;
	  $data['Cotizacion'] = $Cotizacion;
	  $data['ListaDetalleCotizacion'] = $ListaDetalleCotizacion;

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


	//  $this->load->view("Reunion",$data);
       // $this->load->view("prueba2");
    }
    
}