<?php 

function LostpassTemplate($user, $link){
	$HTML = '
		<html>
			<body style="background: #ffffff; font-family: Verdana; font-size: 14px; color: #1c1b1b;">
				<div>
					<h2> Hola ' .$user . ' </h2>
					<p style="font-size: 17px; text-align: justify;"> Hemos recibido tu solicitud de cambio de contraseña para ingresar a ' . APP_TITLE. '. </p>
					<p style="text-align: justify;">El día ' . date('d/m/Y', time()) . ' se ha generado una solicitud de recuperación de contraseña. <br /> Si no has solicitado esto, has caso omiso a este mensaje. En caso contrario si deseas modificar tu clave, debes hacer click en el enlace de abajo </p>
					<p style="padding: 15px; background-color: #9cc3ff; text-align: justify;">
						Para modificar tu contraseña has <a style="font-weight:bold; color: #3971de;" href="' .$link. '" target="_blank">click aquí &raquo;</a>
					</p>
					<p style="font-size: 9px;">&copy; '. date('Y',time()) .' '.APP_TITLE.'. Todos los derechos reservados.</p>
				</div> 
			</body>
		</html>
	';

	return $HTML;
}


?>