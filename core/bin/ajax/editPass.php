<?php 

$db 	 = new Conexion();
$id 	 = $_SESSION['app_id'];
$passOld = Encrypt($_POST['pass_bd']);
$passEn	 = Encrypt($_POST['pass']);
$pass	 = $_POST['pass'];
$sql 	 = $db->query(
				"SELECT 
					id,
					user,
					pass,
					email
				FROM 
					users 
				WHERE 
					id='$id'
				LIMIT 
					1
			;");
if ($db->rows($sql) > 0) {
	$data 		= $db->recorrer($sql);
	$id 		= $data[0];
	$user 		= $data[1];
	$passBd 	= $data[2];
	$email  	= $data[3];
	if ($passOld == $passBd) {
		if ($passEn != $passBd) {
			$keypass	= md5(time());
			$new_pass 	= $pass;
			$link		= APP_URL . '?view=editpass&key=' . $keypass;


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

			$mail->Subject = 'Cambio de contraseña';
			$mail->Body    = EditpassTemplate($user,$link);
			$mail->AltBody = 'Hola ' . $user . ' para confirmar tu cambio de clave debes ir a este enlace: ' . $link . ', si no has solicitado este cambio de contraseña, has caso omiso a este mensaje.';

			if(!$mail->send()) {
			    $HTML = '<div class="alert alert-dismissible alert-danger">
							<button type="button" class="close" data-dismiss="alert">x</button>
							<strong>ERROR: </strong>' . $mail->ErrorInfo . '
						</div>'
				;
			} else {
				$db->query(
					"UPDATE 
						users
					SET 
						keypass='$keypass', new_pass='$new_pass'
					WHERE 
						id='$id'
				;");
				$HTML = 1;
		    }
		} else {
			$HTML = 
			'<div class="alert alert-dismissible alert-danger">
				<button type="button" class="close" data-dismiss="alert">x</button>
				<strong>ERROR: </strong> la nueva contraseña es igual a la anterior.
			</div>';
		}
	} else {
		$HTML = 
		'<div class="alert alert-dismissible alert-danger">
			<button type="button" class="close" data-dismiss="alert">x</button>
			<strong>ERROR: </strong> contraseña actual es incorrecta.
		</div>';
	}
	
		
} else {
	$HTML = 
	'<div class="alert alert-dismissible alert-danger">
		<button type="button" class="close" data-dismiss="alert">x</button>
		<strong>ERROR: </strong> vuelve a iniciar sesión e intenta nuevamente.
	</div>';
}

$db->liberar($sql);
$db->close();
echo $HTML;

?>