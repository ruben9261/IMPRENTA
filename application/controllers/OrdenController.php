<?php if( ! defined ('BASEPATH')) exit('error al intentar acceder');


class OrdenController extends CI_Controller {
	
	
	public function __construct()
	{	parent::__construct();
		$this->load->library('session');
		if (!$this->session->userdata('Loggedin'))
        {
			header('Location: /LoginController');
		}
		$this->load->model('UsuarioModel','UsuarioModel');
		$this->load->model('ClientesModel','ClientesModel');
		$this->load->model('OrdenModel','OrdenModel');
		$this->load->model('EstadoModel','EstadoModel');
		$this->load->model('ReunionesModel','ReunionesModel');
	}
	
	
	public function index() {
        $this->load->library('session');
        $data['Usuario'] =$this->session->Usuario;

        $ListaUsuarios=$this->UsuarioModel->ListarUsuarios(null);
        $data['ListaUsuarios'] = $ListaUsuarios;

        $ListaClientes=$this->ClientesModel->ListarClientes(null);
        $data['ListaClientes'] = $ListaClientes;

        $ListaOrdenes=$this->OrdenModel->ListarOrdenes(null);

		$ListaEstados=$this->EstadoModel->ListarEstados();
		
		//estado de cotizacion
		foreach($ListaOrdenes as $item){
			if(isset($item->IdEstado)){
				foreach($ListaEstados as $item2){
					if($item->IdEstado==$item2->IdEstado){
						$item->EstadoCotizacion = $item2->EstadoDescripcion;
						if($item->IdEstado==1){
							$item->btnColor = "btn-dark";
						}
						if($item->IdEstado==2){
							$item->btnColor = "btn-info";
						}
						if($item->IdEstado==3){
							$item->btnColor = "btn-warning";
						}
					}
				}
			}else{
				$item->EstadoCotizacion = "Pendiente";
				$item->btnColor = "btn-dark";
			}
		}

		foreach($ListaOrdenes as $orden){
			$orden->EstadoReunion1 = $this->ReunionesModel->ObtenerEstadoReunion($ListaEstados,$orden->IdEstadoReunion1);
			$orden->EstadoReunionColor1 = $this->ReunionesModel->ObtenerEstadoReunionColor($ListaEstados,$orden->IdEstadoReunion1);
			$orden->EstadoReunion2 = $this->ReunionesModel->ObtenerEstadoReunion($ListaEstados,$orden->IdEstadoReunion2);
			$orden->EstadoReunionColor2 = $this->ReunionesModel->ObtenerEstadoReunionColor($ListaEstados,$orden->IdEstadoReunion2);
			$orden->EstadoReunion3 = $this->ReunionesModel->ObtenerEstadoReunion($ListaEstados,$orden->IdEstadoReunion3);
			$orden->EstadoReunionColor3 = $this->ReunionesModel->ObtenerEstadoReunionColor($ListaEstados,$orden->IdEstadoReunion3);
			$orden->EstadoReunion4 = $this->ReunionesModel->ObtenerEstadoReunion($ListaEstados,$orden->IdEstadoReunion4);
			$orden->EstadoReunionColor4 = $this->ReunionesModel->ObtenerEstadoReunionColor($ListaEstados,$orden->IdEstadoReunion4);
		}

        $data['ListaOrdenes'] = $ListaOrdenes;
        $this->load->view('Orden',$data);
	}
	
    
    public function ListarUsuarios(){
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

		$this->load->model('EstadoModel','EstadoModel');
        $ListaEstados=$this->EstadoModel->ListarEstados();
		
		foreach($ListaOrdenes as $item){
			if(isset($item->IdEstado)){
				foreach($ListaEstados as $item2){
					if($item->IdEstado==$item2->IdEstado){
						$item->EstadoCotizacion = $item2->EstadoDescripcion;
						if($item->IdEstado==1){
							$item->btnColor = "btn-dark";
						}
						if($item->IdEstado==2){
							$item->btnColor = "btn-info";
						}
						if($item->IdEstado==3){
							$item->btnColor = "btn-warning";
						}
					}
				}
			}else{
				$item->EstadoCotizacion = "Pendiente";
				$item->btnColor = "btn-dark";
			}
		}

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