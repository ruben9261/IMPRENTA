
<?php if( ! defined ('BASEPATH')) exit('error al intentar acceder');


class EmpleadosController extends CI_Controller {

	public function _construct()
	{	parent::_construct();
		//$this->load->helper('url');
	    //$this->load->model('LoginModel');
	}


	public function ListarEmpleados($FiltrosEmpleado){
		$this->load->model('EmpleadosModel');
		$ListaEmpleados=$this->EmpleadosModel->ListarEmpleados($FiltrosEmpleado);

		$jsonResponse = json_encode($ListaEmpleados);
		
		echo $jsonResponse;
	}

	public function ObtenerEmpleado($IdEmpleado){
		//nombre del modelo 
		$this->load->model('EmpleadosModel');
		$ObtenEmpleado=$this->Empleadosmodel->ObtenerEmpleado($IdEmpleado);
		$jsonResponse = json_encode($ObtenEmpleado);
		echo $jsonResponse;

	}

	public function GuardarEmpleado($Empleado){

	}

	public function EliminarEmpleado($IdEmpleado){

	}

}