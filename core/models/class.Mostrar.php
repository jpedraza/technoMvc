<?php 

class Mostrar {
	private $db;
	private $id;
	
	public function __construct() {
		$this->db = new Conexion();
	}

	private function Errors($url){
		try {
		} catch (Exception $error) {
			header('location: '.$url .$error->getMessage());
			exit;
		} 
	}
	
	public function __destruct() {
		$this->db->close();
	}
}


 ?>