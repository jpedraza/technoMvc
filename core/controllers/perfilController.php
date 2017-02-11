<?php

if(isset($_SESSION['app_id']) and array_key_exists($_SESSION['app_id'],$_users)) {
  $id_usuario = intval($_SESSION['app_id']);
  $db = new Conexion();
  $sql = $db->query(
  				"SELECT 
  					COUNT(id) 
  				FROM 
  					carrito 
  				WHERE 
  					id_usuario='$id_usuario';
  				");
  include(HTML_DIR . 'perfil/perfil.php');
  $db->liberar($sql);
  $db->close();
} else {
  header('location: home/');
}

?>
