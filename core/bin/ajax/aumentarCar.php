<?php

$db       = new mysqli("localhost","root","","technomvc");
/*$db       = new mysqli("lcdesign.com.ve","lcdesign_root","088008quetepasa","lcdesign_techno");*/
$carro = $_GET['idCar'];
$idPrd = $_GET['id'];

$sql = 
  		"SELECT 
  			cantidad 
  		FROM 
  			carrito 
  		WHERE 
  			id='$carro' 
  		LIMIT 1;";

$result   = $db->query($sql);
$cantcar  = $result->fetch_array();

$sql1 = 
      "SELECT 
        cantidad 
      FROM 
        productos 
      WHERE 
        id ='$idPrd' 
      LIMIT 1;"; 

$res   = $db->query($sql1);
$stock  = $res->fetch_array();


if ($stock[0] > $cantcar[0]) {
  $db->query(
    "UPDATE 
    	carrito 
    SET 
    	cantidad = cantidad + 1 
    WHERE 
    	id='$carro';");
  $db->close();
  header('Location:'. $_SERVER['HTTP_REFERER']);
} else {
  header('Location:'. $_SERVER['HTTP_REFERER']);
}
?>