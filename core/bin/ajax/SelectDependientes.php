<?php

if(isset($_POST["elegido"]))
 {
    $opciones       = '<option value="0">Elige la Subcategoría</option>';
    $conexion       = new mysqli("localhost","root","","technomvc");
    $strConsulta    = "SELECT id, nombre FROM subcategorias WHERE id_categoria = ".$_POST["elegido"];
    $result         = $conexion->query($strConsulta);
    while ( $fila = $result->fetch_array()) {
       $opciones.='<option value="'.$fila["id"].'">'. strtoupper(substr($fila["nombre"],0,1)). strtolower(substr($fila["nombre"],1)).'</option>';
    } 
     echo $opciones;
 }

?>