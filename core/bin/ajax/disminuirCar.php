<?php
$db       = new mysqli("localhost","root","","technomvc");
/*$db       = new mysqli("lcdesign.com.ve","lcdesign_root","088008quetepasa","lcdesign_techno");*/
$carro = $_GET['idCar'];
$sql = 
  		"SELECT 
  			cantidad 
  		FROM 
  			carrito 
  		WHERE 
  			id='$carro' 
  		LIMIT 1;"; 
$result         = $db->query($sql);
$vector = $result->fetch_array();

if ($vector[0]>1) {
    $db->query(
    	"UPDATE 
    		carrito 
    	SET 
    		cantidad=cantidad-1 
    	WHERE 
    		id='$carro';");
} else {
    if ($vector[0]<=1) {
        $db->query(
        	"DELETE FROM 
        		carrito 
        	WHERE 
        		id='$carro';");
        
    } 
}
$db->close();
header('Location:'. $_SERVER['HTTP_REFERER']);
?>