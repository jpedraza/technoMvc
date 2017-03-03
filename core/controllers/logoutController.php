<?php 

$db 	= new Conexion();
$fecha 	= date('d/m/Y h:i a');
$db->query(
	"UPDATE
		users
	SET
		ultima_conexion='$fecha'
	WHERE
		id = '$_SESSION[app_id]';");

$db->close();
unset($_SESSION['app_id']);
unset($_SESSION['carrito']);
header('location: home/')


 ?>