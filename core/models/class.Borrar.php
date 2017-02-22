<?php 

/*class promociones {
	private $db;
	private $id;
	private $titulo;
	private $detale_promo;
	private $imagen;
	private $oferta;
	
	public function __construct() {
		$this->db = new Conexion();
	}

	private function Errors($url){
		try {
			if (empty($_POST['titulo']) && empty($_POST['detale_promo']) && empty($_POST['imagen']) && (!isset($_POST['oferta']) || $_POST['oferta'] == "")) {
				throw new Exception(1);				
			} else {
				$this->titulo 		= $this->db->real_escape_string($_POST['titulo']);
				$this->detale_promo = $this->db->real_escape_string($_POST['detale_promo']);
				$this->detale_promo = str_replace(
					array('<script>','</script>','<script src', '<script type='), 
					'',
					$this->detale_promo);
				$this->imagen 		= $this->db->real_escape_string($_FILES['imagen']['name']);
				$this->oferta		= intval($_POST['oferta']);
			}

			$sql = $this->db->query("SELECT titulo FROM promociones WHERE titulo='$this->titulo';");
			$nombreBd = $this->db->recorrer($sql)[0];
			if (strtolower($this->titulo) == strtolower($nombreBd)){
				throw new Exception(2);
			} else {
				$this->titulo = $this->db->real_escape_string($_POST['titulo']);
			}
		} catch (Exception $error) {
			header('location: '.$url .$error->getMessage());
			exit;
		} 
	}

	public function Add(){
		$this->Errors('?view=promociones&mode=add&error=');
		$this->db->query(
					"INSERT INTO
						promociones (titulo)
					VALUES 
						('$this->titulo');
				");
		header('location: ?view=promociones&mode=add&id='.$this->id.'&success=true');
	}

	public function Edit(){
		$this->id = intval($_GET['id']);
		$this->Errors('?view=promociones&mode=edit&id=' . $this->id . '&error=');
		$this->db->query(
					"UPDATE 
						promociones
					SET 
						titulo='$this->titulo',
						detalle='$this->detale_promo',
						imagen='$this->imagen',
						oferta='$this->oferta'
					WHERE 
						id='$this->id';
				");
		header('location: ?view=promociones&mode=edit&id='.$this->id.'&success=true');
	}

	public function __destruct() {
		$this->db->close();
	}
}*/


 ?>