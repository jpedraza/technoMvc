<?php 

class Productos {
	private $db;
	private $id;
	private $nombre;
	private $precio;
	private $cantidad;
	private $descripcion;
	private $condicion;
	private $categoria;
	private $subcategoria;
	private $marca;
	private $oferta;
	private $precio_oferta;
	private $foto1;
	private $foto2;
	private $foto3;
	private $estatus;
	
	public function __construct() {
		$this->db = new Conexion();
	}

	private function Errors($url){
		try {
			
			if (empty($_POST['nombre']) or empty($_POST['precio']) or empty($_POST['cantidad']) or empty($_POST['descripcion']) or empty($_POST['condicion']) or empty($_POST['categoria']) or empty($_POST['subcategoria']) or empty($_POST['marca']) or empty($_POST['oferta']) or empty($_FILES['foto1']['name'])) {
				throw new Exception(1);				
			} else {
				$this->nombre = $this->db->real_escape_string($_POST['nombre']);
				$this->marca = $this->db->real_escape_string($_POST['marca']);
				$this->foto1 = $this->db->real_escape_string($_POST['foto1']);
				$this->descripcion = $this->db->real_escape_string($_POST['descripcion']);
				$this->descripcion 	= str_replace(
					array('<script>','</script>','<script src', '<script type='), 
					'',
					$this->descripcion
					);

				if ($_POST['condicion'] == 2) {
					$this->condicion = 2;
				} else {
					$this->condicion = 1;
				}

				if ($_POST['oferta'] == 1) {
					$this->oferta = 1;
				} else {
					$this->oferta = 0;
				}
				
			}
			
			if (!is_numeric($_POST['precio']) or !is_numeric($_POST['cantidad'])) {
				throw new Exception(2);
			} else {
				$this->precio = floatval($_POST['precio']);
				$this->cantidad = intval($_POST['cantidad']);
			}

			
			if ($_POST['oferta'] == 1 and (empty($_POST['precio_oferta']) and !is_numeric($_POST['precio_oferta']))) {
				throw new Exception(3);
			} else {
				$this->precio = floatval($_POST['precio_oferta']);
			}
			
			
			$sql = $this->db->query(
								"SELECT 
									id 
								FROM 
									productos
								WHERE 
									foto1='$this->foto1' OR foto2='$this->foto1' OR foto3='$this->foto1'
								LIMIT 
									1
								;"
							);
			if ($db->rows($sql) > 0){
				throw new Exception(4);
			} else {
				$this->foto1 = $this->db->real_escape_string($_POST['foto1']);
			}

			
			if ($_POST['cantidad'] <= 0) {
				throw new Exception(5);
			} else {
				$this->cantidad = intval($_POST['cantidad']);
			}

			
			$archivo = $_FILES['foto1']['name'];
			$temporal = $_FILES['foto1']['tmp_name'];
            $tipo = getimagesize($temporal);
            if ($tipo[2] != 1 || $tipo[2] != 2 || $tipo[2] != 3){
            	throw new Exception(6);
            } else {
				$this->foto1 = $this->db->real_escape_string($_FILES['foto1']['name']);
			}

			
			if (strlen($_POST['descripcion']) < LONGITUD_MIN) {
				throw new Exception(7);
			} else {
				$this->descripcion = $this->db->real_escape_string($_POST['descripcion']);
				$this->descripcion 	= str_replace(
					array('<script>','</script>','<script src', '<script type='), 
					'',
					$this->descripcion
				);
			}
		} catch (Exception $error) {
			header('location: '.$url .$error->getMessage());
			exit;
		} 
	}

	public function Delete(){
		$this->id = intval($_GET['id']);
		//Para borrar una categoria debemos borrar todos los productos. Haremos multiquerys
		$sql_fto = $this->db->query(
					"SELECT 
						foto1,foto2,foto3
					FROM 
						productos
					WHERE 
						id='$this->id';
				");
		$fotoBd = $this->db->recorrer($sql_fto);
		if($fotoBd[0] != "default.jpg") { unlink("views/images/productos/".$fotoBd[0]); }
		if($fotoBd[1] != "default.jpg") { unlink("views/images/productos/".$fotoBd[1]); }
		if($fotoBd[2] != "default.jpg") { unlink("views/images/productos/".$fotoBd[2]); }
		
		$q = $this->db->query(
			"DELETE FROM
				productos
			WHERE 
				id='$this->id';
		");		
		header('location: ?view=productos');

	}
	public function __destruct() {
		$this->db->close();
	}
}


 ?>