<?php
/**
 * NUCLEO DE TODA LA APLICACIÓN
 */

session_start();


#Establecer el formato de hora de Caracas
date_default_timezone_set('America/Caracas');

#Constantes de la Conexión a BD
define('DB_HOST','localhost'); 		
define('DB_USER','root');			
define('DB_PASS','');		
define('DB_NAME','technomvc');		

/*#Constantes de la Conexión a BD
define('DB_HOST','lcdesign.com.ve'); 		
define('DB_USER','lcdesign_root');			
define('DB_PASS','088008quetepasa');		
define('DB_NAME','lcdesign_techno');*/		

#Constantes de la APP
define('HTML_DIR','html/'); //Definimos una constante con un string denominado /html
define('APP_TITLE','| Technotronic Game RK'); //Definimos una constante con un string para los titulos
define('APP_COPY','Copyright &copy; '. date('Y',time()). ' Technotronick Game R.K.'); 
/*define('APP_COPY','Copyright &copy; Technotronick Game R.K.');*/
define('APP_URL','http://localhost/technoMvc/'); // http://localhost/technoMvc/			http://lcdesign.com.ve/techno/

#Constantes de PHPMailer
define('PHPMAILER_HOST', 'mail.lcdesign.com.ve');
define('PHPMAILER_USER', 'lcandelario@lcdesign.com.ve');
define('PHPMAILER_PASS', '088008');
define('PHPMAILER_PORT', 465);

#Constantes de Formularios
define('LONGITUD_MIN', 100);
define('LONGITUD_MIN_CEDULA', 7);
define('LONGITUD_MAX_CEDULA', 9);
define('LONGITUD_MIN_NOM', 5);
define('LONGITUD_MAX_NOM', 50);
define('LONGITUD_MIN_NOM_1', 3); 	//Se usa cuando separamos el nombre del apellido
define('LONGITUD_MIN_MAR', 3);
define('LONGITUD_MAX_MAR', 30);
define('LONGITUD_MAX_TIT', 25);
define('LONGITUD_MAX_DETALLE', 90);
define('LONGITUD_TELEFONO', 11);
define('LONGITUD_CODIGO_POSTAL', 4);
define('URL_PRODUCTOS', 'views/images/productos/');
define('PRECIO_MIN_PROD', 350);
define('MONEDA', 'Bs');
define('CANTIDAD_PRODUCTOS', 5);
define('CANTIDAD_ARTICULOS', 9);
define('COSTO_ENVIO_LOCAL', 2500);
define('COSTO_ENVIO_NACIONAL', 2900);

#Estructura
require('vendor/autoload.php'); //incluye las librerias instaladas por composer
require('core/models/class.Conexion.php');
require('core/bin/functions/Encrypt.php');
require('core/bin/functions/Users.php');
require('core/bin/functions/Categorias.php');
require('core/bin/functions/Subcategorias.php');
require('core/bin/functions/Productos.php');
require('core/bin/functions/Carritos.php');
require('core/bin/functions/Promociones.php');
require('core/bin/functions/EmailTemplate.php');
require('core/bin/functions/EmailTemplateAdm.php');
require('core/bin/functions/LostpassTemplate.php');
require('core/bin/functions/EditpassTemplate.php');
require('core/bin/functions/UrlAmigable.php');
require('core/bin/ajax/SelectDependientes.php');

#Variables de MercadoPago
require_once ('vendor/mercadopago/sdk/lib/mercadopago.php');
$mp = new MP ("3439322196532533", "j35hpwkhIA1Pf4ARvo88pr03ARllhwyh");

$_users 		= Users();
$_categorias 	= Categorias();
$_subcategorias = Subcategorias();
$_productos 	= Productos();
$_carritos 		= Carritos();
$_promociones	= Promociones();


?>