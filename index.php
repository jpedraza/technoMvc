<?php

require('core/core.php');
$db  = new Conexion();
/**
 * Muestra los productos en el carrito de una persona que aun no está logeada.
 */
if (!isset($_SESSION['app_id'])) {
	$carrito = isset($_SESSION['carrito']) ? $_SESSION['carrito'] : null;
    $sql = $db->query(
    "SELECT
        id_producto,
        cantidad,
        id
    FROM
        carrito
    WHERE
        id_usuario='$carrito';");
    $cantidadPrd = $db->rows($sql);
    $idCarrito   = $carrito; 
} elseif ($_users[$_SESSION['app_id']]['permisos'] != 2) {
    /**
     * Si la persona esta logeada actualiza su carrito.
     * Esto si la persona agrego productos al carro sin logearse.
     */
    $sql = $db->query(
    "UPDATE
        carrito
    SET
        id_usuario='$_SESSION[app_id]'
    WHERE
        id_usuario='$_SESSION[carrito]';");
    $sql = $db->query(
    "SELECT
        id_producto,
        cantidad,
        id
    FROM
        carrito
    WHERE
        id_usuario='$_SESSION[app_id]';");
    $cantidadPrd = $db->rows($sql);
    $idCarrito   = $_SESSION['app_id'];
} else {
    $db->query("
    DELETE FROM
        carrito
    WHERE
        id_usuario = '$_SESSION[carrito]' OR id_usuario = '$_SESSION[app_id]';");
    $cantidadPrd = 0;
    $idCarrito   = $_SESSION['app_id'];
}


/**
 * Muestra los productos favoritos de una persona que aun no está logeada.
 */
if (!isset($_SESSION['app_id'])) {
	$favoritos = isset($_SESSION['favoritos']) ? $_SESSION['favoritos'] : null;
    $sql = $db->query(
    "SELECT
        id_producto,
        id
    FROM
        favoritos
    WHERE
        id_usuario='$favoritos';");
$cantidadPrd = $db->rows($sql);
$idFavoritos = $favoritos; 
} elseif ($_users[$_SESSION['app_id']]['permisos'] != 2) {
	/**
     * Si la persona esta logeada actualiza sus favoritos.
     * Esto si la persona agrego productos a favoritos sin logearse.
     */
    $sql = $db->query(
    "UPDATE
        favoritos
    SET
        id_usuario='$_SESSION[app_id]'
    WHERE
        id_usuario='$_SESSION[favoritos]';");
    $sql = $db->query(
    "SELECT
        id_producto,
        id
    FROM
        favoritos
    WHERE
        id_usuario='$_SESSION[app_id]';");
$cantidadPrd = $db->rows($sql);
$idFavoritos = $_SESSION['app_id'];
} else {
    $db->query("
    DELETE FROM
        favoritos
    WHERE
        id_usuario = '$_SESSION[favoritos]' OR id_usuario = '$_SESSION[app_id]';");
    $cantidadPrd = 0;
    $idFavoritos = $_SESSION['app_id'];
}


/**
 * La Logica del MVC
 */
if(isset($_GET['view'])) {
  	if(file_exists('core/controllers/' . strtolower($_GET['view']) . 'Controller.php')) {
    	include('core/controllers/' . strtolower($_GET['view']) . 'Controller.php');
  	} else {
    	include('core/controllers/errorController.php');
  	}
} else {
  include('core/controllers/indexController.php');
}

?>
