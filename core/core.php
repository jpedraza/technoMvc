<?php
/**
 * NUCLEO DE TODA LA APLICACIÓN
 */

session_start();

#Constantes de la Conexión a BD
define('DB_HOST','localhost'); 		//localhost			lcdesign.com.ve
define('DB_USER','root');			//root				lcdesign_root
define('DB_PASS','');		//					088008quetepasa
define('DB_NAME','technomvc');		//technomvc			lcdesign_techno

#Constantes de la APP
define('HTML_DIR','html/'); //Definimos una constante con un string denominado /html
define('APP_TITLE','| Technotronic Game RK'); //Definimos una constante con un string para los titulos
/*define('APP_COPY','Copyright &copy; '. date('Y',time()). ' Technotronick Game R.K.'); */
define('APP_COPY','Copyright &copy; Technotronick Game R.K.');
define('APP_URL','http://localhost/technoMvc/'); // http://localhost/technoMvc/				http://lcdesign.com.ve/techno/

#Constantes de PHPMailer
define('PHPMAILER_HOST', 'mail.lcdesign.com.ve');
define('PHPMAILER_USER', 'lcandelario@lcdesign.com.ve');
define('PHPMAILER_PASS', '088008');
define('PHPMAILER_PORT', 465);

#Constantes de Formularios
define('LONGITUD_MIN', 100);
define('LONGITUD_MIN_NOM', 5);
define('LONGITUD_MIN_MAR', 3);
define('LONGITUD_MAX_NOM', 50);
define('LONGITUD_MAX_MAR', 30);
define('URL_PRODUCTOS', 'views/images/productos/');
define('PRECIO_MIN_PROD', 350);
define('MONEDA', 'Bs');
define('CANTIDAD_PRODUCTOS', 5);

#Estructura
require('vendor/autoload.php'); //incluye las librerias instaladas por composer
require('core/models/class.Conexion.php');
require('core/bin/functions/Encrypt.php');
require('core/bin/functions/Users.php');
require('core/bin/functions/Categorias.php');
require('core/bin/functions/Subcategorias.php');
require('core/bin/functions/Productos.php');
require('core/bin/functions/EmailTemplate.php');
require('core/bin/functions/LostpassTemplate.php');
require('core/bin/functions/UrlAmigable.php');
require('core/bin/ajax/SelectDependientes.php');

$_users = Users();
$_categorias = Categorias();
$_subcategorias = Subcategorias();
$_productos = Productos();

?>