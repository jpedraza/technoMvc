<?php 

if (isset($_SESSION['app_id']) && $_users[$_SESSION['app_id']]['permisos'] >= 2){

	$isset_id = isset($_GET['id']) && is_numeric($_GET['id']) and $_GET['id'] >= 1; //Variable que guardara si es True o False

	require('core/models/class.Subcategorias.php');
	$subcategorias = new Subcategorias();

	switch (isset($_GET['mode']) ? $_GET['mode'] : null) {
		case 'add':
			if ($_POST) {
				$subcategorias->Add();
			} else {
				include(HTML_DIR . 'subcategorias/add_subcategoria.php');
			}			
		break;
		case 'edit':
			if ($isset_id && array_key_exists($_GET['id'],$_categorias)) {
				if ($_POST) {
					$subcategorias->Edit();
				} else {
					include(HTML_DIR . 'subcategorias/edit_subcategoria.php');
				}					
			} else {
				header('location: ?view=subcategorias');	
			}			
		break;
		case 'delete':
			if ($isset_id) {
				$subcategorias->Delete();
			} else {
				header('location: ?view=subcategorias');	
			}	
		break;		
		default:					
			include(HTML_DIR . 'subcategorias/all_subcategoria.php');
		break;
	}
} else{
	header('location: ?view=index');
}
