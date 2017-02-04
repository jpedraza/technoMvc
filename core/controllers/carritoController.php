<?php 

if (isset($_GET['producto']) || (isset($_GET['mode']) && $_GET['mode'] == 'ver')){

	require('core/models/class.Carrito.php');
	$carrito 		= new Carrito();

	switch (isset($_GET['mode']) ? $_GET['mode'] : null) {
		case 'add':
			$db = new Conexion();
			if (!isset($_SESSION['app_id'])) {
				$sql = $db->query("
					SELECT
						id,
						id_usuario,
						id_producto,
						cantidad 
					FROM 
						carrito 
					WHERE 
						id_usuario = '$_SESSION[carrito]' AND id_producto = '$_GET[producto]'
					ORDER BY
						id DESC;");
				$existe 	= $db->rows($sql);
				$cantidad 	= $existe > 0 ? intval($db->recorrer($sql)[3]) : 0; 
				if (isset($cantidad) && $cantidad > 0) {
					$db->query("
					UPDATE
						carrito
					SET
						cantidad = $cantidad + 1
					WHERE
						id_usuario = '$_SESSION[carrito]' AND id_producto = '$_GET[producto]';");
					header('Location:'. $_SERVER['HTTP_REFERER'].'&carro=true');
				} else {
					$db->query(
					"INSERT INTO
							carrito (id_usuario,id_producto,cantidad)
						VALUES 
							('$_SESSION[carrito]','$_GET[producto]',1);
					");
					header('Location:'. $_SERVER['HTTP_REFERER'].'&carro=true');
				}
			} else {
				$sql = $db->query("
					SELECT
						id,
						id_usuario,
						id_producto,
						cantidad 
					FROM 
						carrito 
					WHERE 
						(id_usuario = '$_SESSION[carrito]' OR id_usuario = '$_SESSION[app_id]') AND id_producto = '$_GET[producto]'
					ORDER BY
						id DESC;");
				$existe 	= $db->rows($sql);
				$cantidad 	= $existe > 0 ? intval($db->recorrer($sql)[3]) : 0; 
				
				if (isset($cantidad) && $cantidad > 0) {
					$db->query("
					UPDATE
						carrito
					SET
						cantidad = $cantidad + 1
					WHERE
						(id_usuario = '$_SESSION[carrito]' OR id_usuario = '$_SESSION[app_id]') AND id_producto = '$_GET[producto]';");
					header('Location:'. $_SERVER['HTTP_REFERER'].'&carro=true');
				} else {
					$db->query(
					"INSERT INTO
							carrito (id_usuario,id_producto,cantidad)
						VALUES 
							('$_SESSION[app_id]','$_GET[producto]',1);
					");
					header('Location:'. $_SERVER['HTTP_REFERER'].'&carro=true');
				}
			}
		break;
		case 'ver':
			include(HTML_DIR . 'carrito/carrito.php');			
		break;
		case 'delete':
			$db = new Conexion();
			$db->query(
				"DELETE FROM
					carrito
				WHERE
					id_usuario = '$_GET[usuario]' AND id_producto = '$_GET[producto]'
				;");
			header('Location:'. $_SERVER['HTTP_REFERER']);
		break;		
		default:					
			include(HTML_DIR . 'carrito/carrito.php');
		break;
	}
} else{
	header('location: contacto/');
}
$db->close();
?>