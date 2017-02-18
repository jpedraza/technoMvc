<?php 

switch (isset($_GET['mode']) ? $_GET['mode'] : null) {
	case 'inv':
		include(HTML_DIR . 'reportes/reportePrd.php');
	break;
	case 'user':
		include(HTML_DIR . 'reportes/reporteUser.php');
	break;
	default:				
		header('location: home/');
	break;
}

?>