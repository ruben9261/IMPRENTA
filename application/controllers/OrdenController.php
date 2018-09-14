<?php if( ! defined ('BASEPATH')) exit('error al intentar acceder');


class OrdenController extends CI_Controller {
	
	
	public function _construct()
	{	parent::_construct();
		//$this->load->helper('url');
	    //$this->load->model('LoginModel');
	}
	
	
	public function index() {
        $this->load->library('session');
        $data['Usuario'] =$this->session->Usuario;

        $this->load->model('UsuarioModel','UsuarioModel');
        $ListaUsuarios=$this->UsuarioModel->ListarUsuarios(null);
        $data['ListaUsuarios'] = $ListaUsuarios;

        $this->load->model('ClientesModel','ClientesModel');
        $ListaClientes=$this->ClientesModel->ListarClientes();
        $data['ListaClientes'] = $ListaClientes;

        $this->load->model('OrdenModel','OrdenModel');
        $ListaOrdenes=$this->OrdenModel->ListarOrdenes(null);
        $data['ListaOrdenes'] = $ListaOrdenes;
        
        $this->load->view('Orden',$data);
    }
    
    public function ListarUsuarios(){
        $this->load->model('UsuarioModel','UsuarioModel');
		$ListaUsuarios=$this->UsuarioModel->ListarUsuarios(null);

		$jsonResponse = json_encode($ListaUsuarios);

		echo $jsonResponse;
    }

    public function ListarClientes(){
        $this->load->model('ClientesModel','ClientesModel');
		$ListaClientes=$this->ClientesModel->ListarClientes();

		$jsonResponse = json_encode($ListaClientes);

		echo $jsonResponse;
    }

    public function ListarOrdenes(){

		$FiltrosOrden = $_POST["FiltrosOrden"];
		$FiltrosOrden = (object)$FiltrosOrden;

		$this->load->model('OrdenModel','OrdenModel');
		$ListaOrdenes=$this->OrdenModel->ListarOrdenes($FiltrosOrden);

		$jsonResponse = json_encode($ListaOrdenes);
		
		echo $jsonResponse;
	}

    public function GuardarOrden(){
		$Orden = $_POST["Orden"];
		$Orden = (object)$Orden;

		$this->load->model('OrdenModel','OrdenModel');
		if((int)$Orden->IdOrden == 0){
			$respuesta=$this->OrdenModel->InsertarOrden($Orden);
		}else{
			$respuesta=$this->OrdenModel->ActualizarOrden($Orden);
		}

		$jsonResponse = json_encode($respuesta);

		echo $jsonResponse;
	}

	public function ObtenerOrden(){
		$Orden = $_POST["Orden"];
		$Orden = (object)$Orden;

		$this->load->model('OrdenModel','OrdenModel');
		$Orden=$this->OrdenModel->ObtenerOrden($Orden);

		$jsonResponse = json_encode($Orden);

		echo $jsonResponse;

	}
	
}