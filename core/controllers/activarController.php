<?php 

if (isset($_GET['key'],$_SESSION['app_id'])) {
 	$db		= new Conexion();
 	$id 	= $_SESSION['app_id'];
 	$key	= $db->real_escape_string($_GET['key']);
 	$sql	= $db->query(
 						"SELECT 
 							id 
 						FROM 
 							users
 						WHERE 
 							id='$id' AND keyreg='$key'
 						LIMIT 
 							1
 					;");
 	if ($db->rows($sql) > 0) {
 		$db->query(
 				"UPDATE
 					users 
 				SET 
 					activo=1, keyreg=''
 				WHERE 
 					id='$id'
 			;");
 		header('location: ?view=index&success=true');
 	} else {
 		header('location: ?view=index&error=true');
 	}
 	
 	$db->liberar($sql);
 	$db->close();
} else {
 	include ('html/public/logearte.php');;
}
?>