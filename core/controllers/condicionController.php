<?php 

$isset_id = isset($_GET['id']) && is_numeric($_GET['id']) and $_GET['id'] >= 0; //Variable que guardara si es True o False

if ($isset_id) {
	$id_subcategoria = intval($_GET['id']);
	if (array_key_exists($id_subcategoria, $_subcategorias)) {
		$db 			= new Conexion();
		$sql_subcate 	= $db->query(
							"SELECT 
								* 
							FROM 
								productos
							WHERE 
								id_subcategoria ='$id_subcategoria' 
							ORDER BY 
								nombre 
							ASC;
						");
		include(HTML_DIR . 'mostrar/detalle_subcategoria.php');	
		$db->liberar($sql_subcate);
		$db->close();
	} else {
			header('location: ../index.php?view=error');
	}
} elseif (!$isset_id and ($_GET['oferta']== 1)) {
	$db 			= new Conexion();
	$sql_subcate 	= $db->query(
						"SELECT 
							* 
						FROM 
							productos
						WHERE 
							oferta = 1
						ORDER BY 
							nombre 
						ASC;
					");
	include(HTML_DIR . 'mostrar/detalle_subcategoria.php');	
	$db->liberar($sql_subcate);
	$db->close();
} else {
	header('location: ../index.php?view=index');
}

?>