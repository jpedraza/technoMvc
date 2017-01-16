<?php

function Subcategorias(){
	$db 	= new Conexion();
	$sql 	= $db->query("SELECT * FROM subcategorias ORDER BY id_categoria;");
	if ($db->rows($sql) > 0) {
		while($data = $db->recorrer($sql)) {
			$subcategorias[$data['id']] = $data;
		}
	} else {
		$subcategorias = false;
	}
	
	$db->liberar($sql);
	$db->close();

	return $subcategorias;

}

 ?>