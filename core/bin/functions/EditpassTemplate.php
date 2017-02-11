<?php 

function EditpassTemplate($user, $link){
	$HTML = '
		<html>
			<body style="background: #ffffff; font-family: Verdana; font-size: 14px; color: #1c1b1b;">
				<div>
					<a href="'.APP_URL.'"><img src="http://lcdesign.com.ve/techno/views/images/home/logo.png" alt="Technotronic Game RK" /></a><br />
					<h2> Hola ' .$user . ' </h2>
					<p style="font-size: 17px; text-align: justify;"> Hemos recibido tu solicitud de cambio de contraseña para ingresar a ' . APP_TITLE. '. </p>
					<p style="text-align: justify;">El día ' . date('d/m/Y', time()) . ' se ha generado una solicitud de cambio de contraseña. <br /> Si no has solicitado esto, has caso omiso a este mensaje. En caso contrario, debes hacer click en el enlace de abajo para confirmar tu nueva contraseña </p>
					<p style="padding: 15px; background-color: #9cc3ff; text-align: justify;">
						Para confirmar tu nueva contraseña has <a style="font-weight:bold; color: #3971de;" href="' .$link. '" target="_blank">click aquí &raquo;</a>
					</p>
					<p style="font-size: 9px;">&copy; '. date('Y',time()) .' '.APP_TITLE.'. Todos los derechos reservados.</p>
				</div> 
			</body>
		</html>
	';

	return $HTML;
}


?>