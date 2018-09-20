<?php if( ! defined ('BASEPATH')) exit('error al intentar acceder');


class MainController extends CI_Controller {
	
	
	public function __construct()
	{	parent::__construct();
		$this->load->library('session');
		if (!$this->session->userdata('Loggedin'))
		{
			header('Location: /LoginController');
        	}
	}
	
	
	public function index() {
        $data['Usuario'] =$this->session->Usuario;
        $this->load->view('Main',$data);
	}
	
}