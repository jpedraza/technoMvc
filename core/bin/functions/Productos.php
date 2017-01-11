<?php

function Productos(){
	$db 	= new Conexion();
	$sql 	= $db->query("SELECT * FROM productos;");
	if ($db->rows($sql) > 0) {
		while($data = $db->recorrer($sql)) {
			$productos[$data['id']] = $data;
		}
	} else {
		$productos = false;
	}
	
	$db->liberar($sql);
	$db->close();

	return $productos;

}

 ?>