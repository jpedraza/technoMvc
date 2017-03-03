<?php 

if (isset($_GET['producto']) || isset($_GET['mode'])){

	switch (isset($_GET['mode']) ? $_GET['mode'] : null) {
		case 'add':
			$db = new Conexion();
			if (!isset($_SESSION['app_id'])) {
				$sql = $db->query("
					SELECT
						id,
						id_usuario,
						id_producto
					FROM 
						favoritos 
					WHERE 
						id_usuario = '$_SESSION[favoritos]' AND id_producto = '$_GET[producto]'
					LIMIT
						1;");
				$existe = $db->rows($sql);
				if ($existe > 0) {
					header('Location:'. $_SERVER['HTTP_REFERER']);
				} else {
					$db->query(
					"INSERT INTO
							favoritos (id_usuario,id_producto)
						VALUES 
							('$_SESSION[favoritos]','$_GET[producto]');
					");
					header('Location:'. $_SERVER['HTTP_REFERER']);
				}
			} else {
				$sql = $db->query("
					SELECT
						id,
						id_usuario,
						id_producto
					FROM 
						favoritos 
					WHERE 
						(id_usuario = '$_SESSION[favoritos]' OR id_usuario = '$_SESSION[app_id]') AND id_producto = '$_GET[producto]'
					LIMIT
						1;");
				$existe = $db->rows($sql);
				if ($existe > 0) {
					header('Location:'. $_SERVER['HTTP_REFERER']);
				} else {
					$db->query(
					"INSERT INTO
							favoritos (id_usuario,id_producto)
						VALUES 
							('$_SESSION[app_id]','$_GET[producto]');
					");
					header('Location:'. $_SERVER['HTTP_REFERER']);
				}
			}
			$db->liberar($sql);
			$db->close();
		break;
		case 'delete':
			$db = new Conexion();
			$db->query(
				"DELETE FROM
					favoritos
				WHERE
					id = '$_GET[producto]'
				;");
			$db->close();
			header('Location:'. $_SERVER['HTTP_REFERER']);
			$db->close();
		break;
		default:					
			include(HTML_DIR . 'favoritos/all_favoritos.php');
		break;
	}
} else{
	header('location: home/');
}
?>