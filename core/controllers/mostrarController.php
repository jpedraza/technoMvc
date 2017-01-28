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
	} else {
			header('location: ../index.php?view=error');
	}
} elseif (!$isset_id and isset($_GET['condicion']) and $_GET['condicion']== 1) {
	$db 			= new Conexion();
	$sql_condicion 	= $db->query(
						"SELECT 
							* 
						FROM 
							productos
						WHERE 
							condicion = 1
						ORDER BY 
							nombre 
						ASC;
					");
	include(HTML_DIR . 'mostrar/detalle_condicion.php');	
	$db->liberar($sql_condicion);

} elseif (!$isset_id and isset($_GET['condicion']) and ($_GET['condicion']== 2)) {
	$db 			= new Conexion();
	$sql_condicion 	= $db->query(
						"SELECT 
							* 
						FROM 
							productos
						WHERE 
							condicion = 2
						ORDER BY 
							nombre 
						ASC;
					");
	include(HTML_DIR . 'mostrar/detalle_condicion.php');	
	$db->liberar($sql_condicion);
} elseif (!$isset_id and isset($_GET['oferta']) and ($_GET['oferta'] == 1)) {
	$db 			= new Conexion();
	$sql_oferta 	= $db->query(
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
	include(HTML_DIR . 'mostrar/detalle_oferta.php');	
	$db->liberar($sql_oferta);
} elseif (!$isset_id and isset($_GET['marca']) and $_GET['marca']) {
	$marca = $_GET['marca'];
	$db 			= new Conexion();
	$sql_marca	 	= $db->query(
						"SELECT 
							* 
						FROM 
							productos
						WHERE 
							marca ='$marca';
					");
	include(HTML_DIR . 'mostrar/detalle_marca.php');	
	$db->liberar($sql_marca);
} else {
	header('location: ../index.php?view=index');
}

?>