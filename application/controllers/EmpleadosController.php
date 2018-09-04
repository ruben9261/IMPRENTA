
<?php if( ! defined ('BASEPATH')) exit('error al intentar acceder');


class EmpleadosController extends CI_Controller {

	public function _construct()
	{	parent::_construct();
		//$this->load->helper('url');
		//$this->load->model('LoginModel');
		$this->load->model('EmpleadosModel');
	}

	public function Empleados(){
		$FiltrosEmpleado = new stdClass();
		$FiltrosEmpleado->Estado = "activo";

		$this->load->model('EmpleadosModel');
		$ListaEmpleados=$this->EmpleadosModel->ListarEmpleados($FiltrosEmpleado);

		$data["ListaEmpleados"] = $ListaEmpleados;

		$this->load->view('Empleados',$data);
	}


	public function ListarEmpleados(){

		$FiltrosEmpleado = $_POST["FiltrosEmpleado"];
		$FiltrosEmpleado = (object)$FiltrosEmpleado;

		$this->load->model('EmpleadosModel');
		$ListaEmpleados=$this->EmpleadosModel->ListarEmpleados($FiltrosEmpleado);

		$jsonResponse = json_encode($ListaEmpleados);
		
		echo $jsonResponse;
	}

	public function ObtenerEmpleado(){
		//nombre del modelo
		$Usuario = $_POST["Usuario"];
		$Usuario = (object)$Usuario;

		$this->load->model('EmpleadosModel','EmpleadosModel');
		$Empleado=$this->EmpleadosModel->ObtenerEmpleado($Usuario);

		$jsonResponse = json_encode($Empleado);

		echo $jsonResponse;

	}

	public function GuardarEmpleado(){
		$Empleado = $_POST["Empleado"];
		$Empleado = (object)$Empleado;

		$this->load->model('EmpleadosModel','EmpleadosModel');
		if((int)$Empleado->IdUsuario == 0){
			$respuesta=$this->EmpleadosModel->InsertarEmpleado($Empleado);
		}else{
			$respuesta=$this->EmpleadosModel->ActualizarEmpleado($Empleado);
		}

		$jsonResponse = json_encode($respuesta);

		echo $jsonResponse;
	}

	public function EliminarEmpleado(){

		$Usuario = $_POST["Usuario"];
		$Usuario = (object)$Usuario;

		$this->load->model('EmpleadosModel','EmpleadosModel');
		$UsuarioRespuesta=$this->EmpleadosModel->ObtenerEmpleado($Usuario);
		$Usuario = (object)$UsuarioRespuesta[0];

		$this->load->model('EmpleadosModel','EmpleadosModel');
		$respuesta=$this->EmpleadosModel->EliminarEmpleado($Usuario);

		$jsonResponse = json_encode($respuesta);

		echo $jsonResponse;
	}

}