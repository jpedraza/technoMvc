<?php 

$isset_id = isset($_GET['id']) && is_numeric($_GET['id']) and $_GET['id'] >= 0; //Variable que guardara si es True o False

require('core/models/class.Detalles.php');
	$detalles = new Detalles();

	switch (isset($_GET['mode']) ? $_GET['mode'] : null) {
		case 'productos':
			if ($_POST) {
				$detalles->See();
			} else {
				include(HTML_DIR . 'detalles/detalle_producto.php');
			}
		break;		
		default:				
			header('location: ?view=index');
		break;
	}

	/*if ($isset_id) {
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
			include(HTML_DIR . 'detalles/detalle_subcategoria.php');	
			$db->liberar($sql_subcate);
			$db->close();
		} else {
			header('location: ../index.php?view=error');
		}
	} else {
		header('location: ../index.php?view=index');
	}*/