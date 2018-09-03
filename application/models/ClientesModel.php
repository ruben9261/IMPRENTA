<?php if( ! defined ('BASEPATH')) exit('error al intentar acceder');

class ClientesModel extends CI_Model {
		
	public function _construct()
	{
		parent::_construct();
		$this->load->database('default');
	}
	
}