<?php 

class Detalles {
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

	public function See(){
		$this->Errors('?view=detalles&mode=productos&error=');
		$this->db->query(
					"SELECT
						*
					FROM 
						productos
					WHERE 
						id='$this->id';
				");
	}

	
	public function __destruct() {
		$this->db->close();
	}
}


 ?>