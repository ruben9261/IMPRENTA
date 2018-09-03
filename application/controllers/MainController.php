<?php if( ! defined ('BASEPATH')) exit('error al intentar acceder');


class MainController extends CI_Controller {
	
	
	public function _construct()
	{	parent::_construct();
		//$this->load->helper('url');
	    //$this->load->model('LoginModel');
	}
	
	
	public function index() {
        $this->load->library('session');
        $data['Usuario'] =$this->session->Usuario;
        $this->load->view('Main',$data);
	}
	
	public function Empleados(){
		$this->load->view('Empleados');
	}

	public function Clientes(){
		$this->load->view('Clientes');
	}

	public function Cotizaciones(){
		$this->load->view('Cotizaciones');
	}
	
}