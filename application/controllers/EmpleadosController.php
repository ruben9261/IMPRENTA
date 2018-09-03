
<?php if( ! defined ('BASEPATH')) exit('error al intentar acceder');


class EmpleadosController extends CI_Controller {

	public function _construct()
	{	parent::_construct();
		//$this->load->helper('url');
	    //$this->load->model('LoginModel');
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
		$this->load->model('EmpleadosModel');
		$ObtenEmpleado=$this->Empleadosmodel->ObtenerEmpleado($Usuario);
		$jsonResponse = json_encode($ObtenEmpleado);
		echo $jsonResponse;

	}

	public function GuardarEmpleado($Empleado){

	}

	public function EliminarEmpleado($IdEmpleado){

	}

}