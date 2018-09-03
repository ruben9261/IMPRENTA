<?php if( ! defined ('BASEPATH')) exit('error al intentar acceder');


class CotizacionesController extends CI_Controller {
	
	
	public function _construct()
	{	parent::_construct();
	}
	
	
	public function index() {
	  $this->load->view("Login");
       // $this->load->view("prueba2");
	}


	public function GetCotizaciones(){

	}


	public function InsertCotizaciones(){

	}
}