<?php 

switch (isset($_GET['mode']) ? $_GET['mode'] : null) {
	case 'productos':
		include(HTML_DIR . 'detalles/detalle_producto.php');
	break;
	case 'contacto':
		include(HTML_DIR . 'detalles/contacto.php');
	break;	
	case 'checkout':
		include(HTML_DIR . 'detalles/checkout.php');
	break;	
	case 'checkoutConfirm':
		include(HTML_DIR . 'detalles/checkConfirm.php');
	break;	
	default:				
		header('location: home/');
	break;
}

?>