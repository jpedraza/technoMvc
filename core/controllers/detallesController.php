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

?>