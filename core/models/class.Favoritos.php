<?php 

class Favoritos {
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

	public function Add(){
		$this->Errors('?view=favoritos&mode=add&error=');
		/*$this->db->query(
					"INSERT INTO
						favoritos (nombre)
					VALUES 
						('$this->nombre');
				");
		header('location: ?view=favoritos&mode=add&id='.$this->id.'&success=true');*/
		echo "ingreso el producto al carro";
	}
	
	public function __destruct() {
		$this->db->close();
	}
}


 ?>