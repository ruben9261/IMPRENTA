
<?php if( ! defined ('BASEPATH')) exit('error al intentar acceder');


class ClientesController extends CI_Controller {

	public function __construct()
	{	parent::__construct();
        $this->load->library('session');
		if (!$this->session->userdata('Loggedin'))
        {
			header('Location: /LoginController');
        }
        $this->load->model('ClientesModel');
	}

	public function Clientes(){
		$FiltrosCliente = new stdClass();
        //$FiltrosEmpleado->Estado = "activo";
        
		$ListaClientes=$this->ClientesModel->ListarClientes($FiltrosCliente);
		$ListaRoles=$this->ClientesModel->ListarRoles();

		$data["ListaClientes"] = $ListaClientes;
		$data["ListaRoles"] = $ListaRoles;

		$this->load->view('Clientes',$data);
	}


	public function ListarClientes(){

		$FiltrosCliente = $_POST["FiltrosCliente"];
		$FiltrosCliente = (object)$FiltrosCliente;

		$this->load->model('UsuarioModel');
		$ListaClientes=$this->ClientesModel->ListarClientes($FiltrosCliente);

		$jsonResponse = json_encode($ListaClientes);
		
		echo $jsonResponse;
	}

	public function ObtenerCliente(){
		//nombre del modelo
		$Cliente = $_POST["Cliente"];
		$Cliente = (object)$Cliente;

		$Cliente=$this->ClientesModel->ObtenerCliente($Cliente);

		$jsonResponse = json_encode($Cliente);

		echo $jsonResponse;

	}

	public function GuardarCliente(){
		$Cliente = $_POST["Cliente"];
		$Cliente = (object)$Cliente;

		if((int)$Cliente->IdCliente == 0){
			$respuesta=$this->ClientesModel->InsertarCliente($Cliente);
		}else{
			$respuesta=$this->ClientesModel->ActualizarCliente($Cliente);
		}

		$jsonResponse = json_encode($respuesta);

		echo $jsonResponse;
	}

	public function EliminarCliente(){

		$Cliente = $_POST["Cliente"];
		$Cliente = (object)$Cliente;

		$respuesta=$this->ClientesModel->EliminarCliente($Cliente);

		$jsonResponse = json_encode($respuesta);

		echo $jsonResponse;
	}

}