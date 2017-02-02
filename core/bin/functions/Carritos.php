<?php

function Carritos($idUsuario){
	$db 	= new Conexion();
	$sql 	= $db->query("SELECT * FROM carrito WHERE id_usuario='$idUsuario';");
	if ($db->rows($sql) > 0) {
		while($data = $db->recorrer($sql)) {
			$carrito[$data['id']] = $data;
		}
	} else {
		$carrito = false;
	}
	
	$db->liberar($sql);
	$db->close();

	return $carrito;

}

 ?>