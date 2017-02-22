<?php 

if (isset($_SESSION['app_id']) && $_users[$_SESSION['app_id']]['permisos'] >= 2){

	$isset_id = isset($_GET['id']) && is_numeric($_GET['id']) and $_GET['id'] >= 1; 
	
	switch (isset($_GET['mode']) ? $_GET['mode'] : null) {
		case 'add':
			include(HTML_DIR . 'promociones/add_promo.php');
		break;
		case 'edit':
			if ($isset_id && array_key_exists($_GET['id'],$_users)) {
				include(HTML_DIR . 'promociones/edit_promo.php');
			} else {
				header('location: ?view=promociones');	
			}			
		break;
		case 'delete':
			$db = new Conexion();
			$sql = $db->query("SELECT * FROM promociones;");
			$cantidad = $db->rows($sql);
			if ($cantidad > 1) {
				/**
				 * Borramos la imagen de la promoción del Servidor
				 */
				$sql 	= $db->query("SELECT imagen FROM promociones WHERE id='$_GET[id]';");
				$fotoBd = $db->recorrer($sql)[0];
				unlink("views/images/home/promociones/".$fotoBd);
				/**
				 * Borramos la información de la promoción de la BD
				 */
				$db->query(
					"DELETE FROM
						promociones
					WHERE
						id = '$_GET[id]'
					;");
				header('location: ?view=promociones');	
			} else {
				header('location: ?view=promociones&error=true');
			}
		break;		
		default:					
			include(HTML_DIR . 'promociones/all_promo.php');
		break;
	}
} else{
	header('location: home/');
}
?>