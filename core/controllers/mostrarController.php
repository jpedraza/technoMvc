<?php 

$isset_id = isset($_GET['id']) && is_numeric($_GET['id']) and $_GET['id'] >= 0; //Variable que guardara si es True o False

require('core/models/class.Detalles.php');
$detalles = new Detalles();

	if ($isset_id) {
		$id_subcategoria = intval($_GET['id']);
		if (array_key_exists($id_subcategoria, $_subcategorias)) {
			$db 				= new Conexion();
			$sql_subcate 		= $db->query(
										"SELECT 
											* 
										FROM 
											productos
										WHERE 
											id_subcategoria ='$id_subcategoria' 
										ORDER BY 
											id 
										ASC;
									");
			include(HTML_DIR . 'mostrar/detalle_subcategoria.php');	
			$db->liberar($sql_subcate);
			$db->close();
		} else {
			header('location: ../index.php?view=error');
		}
	} else {
		header('location: ../index.php?view=index');
	}

?>