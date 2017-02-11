<?php 

if (isset($_SESSION['app_id']) && $_users[$_SESSION['app_id']]['permisos'] >= 2){

	$isset_id = isset($_GET['id']) && is_numeric($_GET['id']) and $_GET['id'] >= 1; //Variable que guardara si es True o False

	require('core/models/class.Productos.php');
	$productos = new Productos();

	switch (isset($_GET['mode']) ? $_GET['mode'] : null) {
		/*case 'add':
			if ($_POST) {
				$productos->Add();
			} else {
				include(HTML_DIR . 'productos/add_producto.php');
			}			
		break;*/
		case 'edit':
			if ($isset_id && array_key_exists($_GET['id'],$_productos)) {
				if ($_POST) {
					$productos->Edit();
				} else {
					include(HTML_DIR . 'productos/edit_producto.php');
				}					
			} else {
				header('location: ?view=productos');	
			}			
		break;
		case 'delete':
			if ($isset_id) {
				$productos->Delete();
			} else {
				header('location: ?view=productos');	
			}	
		break;		
		default:					
			include(HTML_DIR . 'productos/all_producto.php');
		break;
	}
} else{
	header('location: home/');
}