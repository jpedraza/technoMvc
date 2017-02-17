<?php 

if (isset($_GET['mode']) and $_GET['mode'] == 'search') {
	include(HTML_DIR . 'mostrar/busqueda.php');
} else {
	header('location: home/');
}

?>