<?php

function Promociones(){
	$db 	= new Conexion();
	$sql 	= $db->query("SELECT * FROM promociones;");
	if ($db->rows($sql) > 0) {
		while($data = $db->recorrer($sql)) {
			$promociones[$data['id']] = $data;
		}
	} else {
		$promociones = false;
	}
	
	$db->liberar($sql);
	$db->close();

	return $promociones;

}

 ?>