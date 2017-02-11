<?php

function Carritos(){
	$db 	= new Conexion();
	$sql 	= $db->query("SELECT * FROM carrito;");
	if ($db->rows($sql) > 0) {
		while($data = $db->recorrer($sql)) {
			$carritos[$data['id']] = $data;
		}
	} else {
		$carritos = false;
	}
	
	$db->liberar($sql);
	$db->close();

	return $carritos;

}

 ?>