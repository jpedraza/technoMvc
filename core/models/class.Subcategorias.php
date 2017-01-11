<?php 

class Subcategorias {
	private $db;
	private $id;
	private $nombre;
	private $id_categoria;
	
	public function __construct() {
		$this->db = new Conexion();
	}

	private function Errors($url){
		try {
			if (empty($_POST['nombre']) and empty($_POST['id_categoria'])) {
				throw new Exception(1);				
			} else {
				$this->nombre = $this->db->real_escape_string($_POST['nombre']);
			}

			if ($_POST['id_categoria'] == 0) {
				throw new Exception(2);
			} else {
				$this->id_categoria = intval($_POST['id_categoria']);
			}			

			$sql = $this->db->query("SELECT nombre FROM subcategorias WHERE nombre='$this->nombre';");
			$nombreBd = $this->db->recorrer($sql)[0];
			if (strtolower($this->nombre) == strtolower($nombreBd)){
				throw new Exception(3);
			} else {
				$this->nombre = $this->db->real_escape_string($_POST['nombre']);
			}
		} catch (Exception $error) {
			header('location: '.$url .$error->getMessage());
			exit;
		} 
	}

	public function Add(){
		$this->Errors('?view=subcategorias&mode=add&error=');
		$this->db->query(
					"INSERT INTO
						subcategorias (nombre,id_categoria)
					VALUES 
						('$this->nombre','$this->id_categoria');
				");
		header('location: ?view=subcategorias&mode=add&id='.$this->id.'&success=true');
	}

	public function Edit(){
		$this->id = intval($_GET['id']);
		$this->Errors('?view=subcategorias&mode=edit&id=' . $this->id . '&error=');
		$this->db->query(
					"UPDATE 
						subcategorias
					SET 
						nombre='$this->nombre',
						id_categoria='$this->id_categoria'
					WHERE 
						id='$this->id';
				");
		header('location: ?view=subcategorias&mode=edit&id='.$this->id.'&success=true');
	}

	public function Delete(){
		$this->id = intval($_GET['id']);
		//Para borrar una categoria debemos borrar todos los productos. Haremos multiquerys
		$p = 
			"DELETE FROM
				subcategorias
			WHERE 
				id='$this->id';
		";
		$p .= 
			"DELETE FROM
				productos
			WHERE 
				id_subcategoria='$this->id';
		";
		if (!$this->db->multi_query($p)) {
		    echo "Falló la multiconsulta: (" . $this->db->errno . ") " . $this->db->error;
		} do {
		    if ($resultado = $this->db->store_result()) {
			    var_dump($resultado->fetch_all(MYSQLI_ASSOC));
			    $resultado->free();
			}
		} while ($this->db->more_results() && $this->db->next_result());
		header('location: ?view=subcategorias');
	}



	public function __destruct() {
		$this->db->close();
	}
}


 ?>