
<?php if( ! defined ('BASEPATH')) exit('error al intentar acceder');


class EmpleadosController extends CI_Controller {

	public function __construct()
	{	parent::__construct();
		$this->load->library('session');
		if (!$this->session->userdata('Loggedin'))
        {
			header('Location: /LoginController');
        }
	}

	public function Empleados(){
		$FiltrosEmpleado = new stdClass();
		$FiltrosEmpleado->Estado = "activo";

		$this->load->model('UsuarioModel');
		$ListaEmpleados=$this->UsuarioModel->ListarUsuarios($FiltrosEmpleado);
		$ListaRoles=$this->UsuarioModel->ListarRoles();

		$data["ListaEmpleados"] = $ListaEmpleados;
		$data["ListaRoles"] = $ListaRoles;

		$this->load->view('Empleados',$data);
	}


	public function ListarEmpleados(){

		$FiltrosEmpleado = $_POST["FiltrosEmpleado"];
		$FiltrosEmpleado = (object)$FiltrosEmpleado;

		$this->load->model('UsuarioModel');
		$ListaEmpleados=$this->UsuarioModel->ListarUsuarios($FiltrosEmpleado);

		$jsonResponse = json_encode($ListaEmpleados);
		
		echo $jsonResponse;
	}

	public function ObtenerEmpleado(){
		//nombre del modelo
		$Usuario = $_POST["Usuario"];
		$Usuario = (object)$Usuario;

		$this->load->model('UsuarioModel','UsuarioModel');
		$Empleado=$this->UsuarioModel->ObtenerUsuario($Usuario);

		$jsonResponse = json_encode($Empleado);

		echo $jsonResponse;

	}

	public function GuardarEmpleado(){
		$Empleado = $_POST["Empleado"];
		$Empleado = (object)$Empleado;

		$this->load->model('UsuarioModel','UsuarioModel');
		if((int)$Empleado->IdUsuario == 0){
			$respuesta=$this->UsuarioModel->InsertarEmpleado($Empleado);
		}else{
			$respuesta=$this->UsuarioModel->ActualizarEmpleado($Empleado);
		}

		$jsonResponse = json_encode($respuesta);

		echo $jsonResponse;
	}

	public function EliminarEmpleado(){

		$Usuario = $_POST["Usuario"];
		$Usuario = (object)$Usuario;

		$this->load->model('UsuarioModel','UsuarioModel');
		$UsuarioRespuesta=$this->UsuarioModel->ObtenerUsuario($Usuario);
		$Usuario = (object)$UsuarioRespuesta[0];

		$this->load->model('UsuarioModel','UsuarioModel');
		$respuesta=$this->UsuarioModel->EliminarEmpleado($Usuario);

		$jsonResponse = json_encode($respuesta);

		echo $jsonResponse;
	}

}