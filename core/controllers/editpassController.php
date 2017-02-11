<?php 

if (isset($_GET['key'])) {
	$db 		= new Conexion();
	$keypass	= $db->real_escape_string($_GET['key']);
	$sql		= $db->query(
							"SELECT 
								id,new_pass 
							FROM 
								users 
							WHERE 
								keypass='$keypass'
							LIMIT 
								1;
						");
	if($db->rows($sql) > 0){
		$data 		= $db->recorrer($sql);
		$id 		= $data[0];
		$new_pass 	= Encrypt($data[1]);
		$password	= $data [1];	
		$db->query(
				"UPDATE 
					users 
				SET 
					keypass='',new_pass='', pass='$new_pass'
				WHERE 
					id='$id'
				LIMIT 
					1;
			");
		include('html/editpass_mensaje.php');
	} else {
		header('location: home/');
	}

	$db->liberar($sql);
	$db->close();
	
} else {
	header('location: home/');
}


?>