<?php 

class Carrito {
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
		$this->Errors('?view=carrito&mode=add&error=');
		/*$this->db->query(
					"INSERT INTO
						categorias (nombre)
					VALUES 
						('$this->nombre');
				");
		header('location: ?view=carrito&mode=add&id='.$this->id.'&success=true');*/
		echo "ingreso el producto al carro";
	}
	
	public function __destruct() {
		$this->db->close();
	}
}


 ?>