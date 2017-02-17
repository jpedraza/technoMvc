<?php 

$db = new Conexion();

$pass	= Encrypt($_POST['pass']);
$user	= $db->real_escape_string($_POST['user']);
$name	= $db->real_escape_string($_POST['name']);
$email	= $db->real_escape_string($_POST['email']);

$sql	= $db->query(
					"SELECT 
						user 
					FROM 
						users 
					WHERE
						user='$user' OR email='$email'
					LIMIT 
						1
				;");
if ($db->rows($sql) == 0) {
	$keyreg = md5(time()); //Crea un md5 del tiempo actual del usuario al momento de registrarse
	$link	= APP_URL . '?view=activar&key=' . $keyreg;

	$mail = new PHPMailer;
	$mail->CharSet = "UTF-8";							// Colocar que se enviaran caracteres especiales
	$mail->Encoding = "quoted-printable";				// Codificación de caracteres
	
	$mail->isSMTP();									// Establecer el correo electrónico para utilizar SMTP
	$mail->Host = PHPMAILER_HOST; 						// Especificar los servidores principales y de backup de SMTP
	$mail->SMTPAuth = true;								// Habilitar autenticación SMTP 
	$mail->Username = PHPMAILER_USER;					// SMTP nombre de usuario
	$mail->Password = PHPMAILER_PASS;					// SMTP Clave
	$mail->SMTPSecure = 'ssl';							// Habilitar cifrado TLS el cual la encripta, 'SSL' también aceptado
	$mail->SMTPOptions = array(							// Opciones para configurar el envio de mail a cualquier host (Hotmail)
      		'ssl' => array(
          	'verify_peer' => false,
          	'verify_peer_name' => false,
          	'allow_self_signed' => true
    	  	)
	  	); 
	$mail->Port = PHPMAILER_PORT;						// Puerto TCP para conectarse

	$mail->setFrom(PHPMAILER_USER, APP_TITLE);			// Quien manda el correo	

	$mail->addAddress($email, $user);					// A quien le llega

	$mail->isHTML(true);								// Establecer el formato de correo electrónico en HTML

	$mail->Subject = 'Activación de tu cuenta';
	$mail->Body    = EmailTemplateAdm($name,$link);
	$mail->AltBody = 'Hola ' . $name . ' para activar tu cuenta accede al siguiente enlace: ' . $link;

	if(!$mail->send()) {
	    $HTML = 
	    '<div class="alert alert-dismissible alert-danger">
			<button type="button" class="close" data-dismiss="alert">x</button>
			<strong>ERROR: </strong>' . $mail->ErrorInfo . 
		'</div>'
		;
	} else {
	    $db->query(
			"INSERT INTO 
				users (user,name,email,pass,keyreg,permisos) 
			VALUES
				('$user', '$name', '$email', '$pass', '$keyreg',2)
		;");
		$sql_2 = $db->query(
					"SELECT 
						MAX(id) 
					AS 
						id 
					FROM 
						users
				;");
		$_SESSION['app_id'] = $db->recorrer($sql_2)[0];
		$db->liberar($sql_2);
		$HTML = 1;
	}	
} else {
	$usuario = $db->recorrer($sql)[0];
	if (strtolower($user) == strtolower($usuario)){
		$HTML = 
		'<div class="alert alert-dismissible alert-danger">
			<button type="button" class="close" data-dismiss="alert">x</button>
			<strong>ERROR:</strong> El usuario ingresado ya existe.
		</div>'
		;
	} else {
		$HTML = 
		'<div class="alert alert-dismissible alert-danger">
			<button type="button" class="close" data-dismiss="alert">x</button>
			<strong>ERROR:</strong> El email ingresado ya existe.
		</div>'
		;
	}	
}

$db->liberar($sql);
$db->close();

echo $HTML;
?>