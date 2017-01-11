<?php 

class Categorias {
	private $db;
	private $id;
	private $nombre;
	
	public function __construct() {
		$this->db = new Conexion();
	}

	private function Errors($url){
		try {
			if (empty($_POST['nombre'])) {
				throw new Exception(1);				
			} else {
				$this->nombre = $this->db->real_escape_string($_POST['nombre']);
			}

			$sql = $this->db->query("SELECT nombre FROM categorias WHERE nombre='$this->nombre';");
			$nombreBd = $this->db->recorrer($sql)[0];
			if (strtolower($this->nombre) == strtolower($nombreBd)){
				throw new Exception(2);
			} else {
				$this->nombre = $this->db->real_escape_string($_POST['nombre']);
			}
		} catch (Exception $error) {
			header('location: '.$url .$error->getMessage());
			exit;
		} 
	}

	public function Add(){
		$this->Errors('?view=categorias&mode=add&error=');
		$this->db->query(
					"INSERT INTO
						categorias (nombre)
					VALUES 
						('$this->nombre');
				");
		header('location: ?view=categorias&mode=add&id='.$this->id.'&success=true');
	}

	public function Edit(){
		$this->id = intval($_GET['id']);
		$this->Errors('?view=categorias&mode=edit&id=' . $this->id . '&error=');
		$this->db->query(
					"UPDATE 
						categorias
					SET 
						nombre='$this->nombre'
					WHERE 
						id='$this->id';
				");
		header('location: ?view=categorias&mode=edit&id='.$this->id.'&success=true');
	}

	public function Delete(){
		$this->id = intval($_GET['id']);
		//Para borrar una categoria debemos borrar todas las subcategorias. y todos los productos. Haremos multiquerys
		$q = 
			"DELETE FROM
				categorias
			WHERE 
				id='$this->id';
		";
		$q .= 
			"DELETE FROM
				subcategorias
			WHERE 
				id_categoria='$this->id';
		";

		if (!$this->db->multi_query($q)) {
		    echo "Falló la multiconsulta: (" . $this->db->errno . ") " . $this->db->error;
		} do {
		    if ($resultado = $this->db->store_result()) {
			    var_dump($resultado->fetch_all(MYSQLI_ASSOC));
			    $resultado->free();
			}
		} while ($this->db->more_results() && $this->db->next_result());
		header('location: ?view=categorias');
	}



	public function __destruct() {
		$this->db->close();
	}
}


 ?>