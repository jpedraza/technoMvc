<?php 

$isset_id = isset($_GET['id']) && is_numeric($_GET['id']) and $_GET['id'] >= 0; //Variable que guardara si es True o False

switch (isset($_GET['mode']) ? $_GET['mode'] : null) {
	case 'productos':
		include(HTML_DIR . 'detalles/detalle_producto.php');
	break;
	case 'contacto':
		include(HTML_DIR . 'detalles/contacto.php');
	break;		
	default:				
		header('location: home/');
	break;
}

?>