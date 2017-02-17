<?php 

if (isset($_SESSION['app_id']) && $_users[$_SESSION['app_id']]['permisos'] >= 2){

	$isset_id = isset($_GET['id']) && is_numeric($_GET['id']) and $_GET['id'] >= 1; 

	switch (isset($_GET['mode']) ? $_GET['mode'] : null) {
		case 'add':
				include(HTML_DIR . 'userAdm/add_user.php');
		break;
		case 'edit':
			if ($isset_id && array_key_exists($_GET['id'],$_users)) {
				include(HTML_DIR . 'userAdm/edit_user.php');
			} else {
				header('location: ?view=userAdm');	
			}			
		break;
		case 'delete':
			$db = new Conexion();
			$db->query(
				"DELETE FROM
					users
				WHERE
					id = '$_GET[id]'
				;");
			header('location: ?view=userAdm');	
		break;		
		default:					
			include(HTML_DIR . 'userAdm/all_user.php');
		break;
	}
} else{
	header('location: home/');
}
?>