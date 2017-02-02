<?php 

if (isset($_SESSION['app_id']) && $_users[$_SESSION['app_id']]['permisos'] == 1 && isset($_GET['producto'])){

	$isset_id = isset($_GET['id']) && is_numeric($_GET['id']) and $_GET['id'] >= 1; //Variable que guardara si es True o False

	require('core/models/class.Carrito.php');
	$carrito 		= new Carrito();
	$productoCarro	= $_GET['producto'];

	if ($_SESSION['carrito']) {
		echo "existe el carro";
	} else {
		echo "no existe el carro";
	}
	
} else{
	if (isset($_GET['mode']) and $_GET['mode'] == 'ver'){
		include(HTML_DIR . 'carrito/carrito.php');
	} else {
		if (!isset($_SESSION['carrito'])) {
			$_SESSION['carrito'] 			= "existe";
			$_SESSION['cantidadProducto'] 	= 1;
			$_SESSION['carritoProducto'] 	= $_GET['producto'];/*
			unset($_SESSION['carrito']);
			unset($_SESSION['cantidadProducto']);
			unset($_SESSION['carritoProducto']);*/
			header("Location:" . $_SERVER['HTTP_REFERER']);
		} else {
			$prdCarro           = $_SESSION['carritoProducto'];
            $carro              = explode("/", $prdCarro);
           	$cantidadPrd        = count($carro);
           	$bandera = false;
           	for ($i=0; $i < $cantidadPrd ; $i++) { 
           		if ($carro[$i] == $_GET['producto']){
           			$i = $cantidadPrd;
           			$bandera = true;
           		}
           	}
           	if ($bandera == true) {
           		header("Location:" . $_SERVER['HTTP_REFERER']);
				die();
           	} else {
				$_SESSION['carritoProducto'] 	.= "/" . $_GET['producto'];
				$_SESSION['cantidadProducto'] 	+= 1;/*
				unset($_SESSION['carrito']);
				unset($_SESSION['cantidadProducto']);
				unset($_SESSION['carritoProducto']);*/
				header("Location:" . $_SERVER['HTTP_REFERER']);
				die();
			}
		} 
	}

	/*require('core/models/class.Carrito.php');
	$carrito 		= new Carrito();
	$productoCarro	= $_GET['producto'];
	$carrito->Add();*/
}