<?php 

function EmailTemplate($name, $link){
	$HTML = '
		<html>
			<body style="background: #ffffff; font-family: Verdana; font-size: 14px; color: #1c1b1b;">
				<div>
					<a href="'.APP_URL.'"><img src="http://lcdesign.com.ve/techno/views/images/home/logo.png" alt="Technotronic Game RK" /></a><br />
					<h2> Hola ' .$name . ' </h2>
					<p style="font-size: 17px;"> Gracias por registrarte en ' . APP_TITLE. '. </p>
					<p style="text-align: justify;"> Solo queda un paso más, activar tu cuenta para poder disfrutar de todos los beneficios de ser parte de los usuarios registrados de nuestra Web </p>
					<p style="padding: 15px; background-color: #9cc3ff;">
						Para activar tu cuenta has <a style="font-weight:bold; color: #3971de;" href="' .$link. '" target="_blank">click aquí &raquo;</a>
					</p>
					<p style="font-size: 9px;">&copy; '. date('Y',time()) .' '.APP_TITLE.'. Todos los derechos reservados.</p>
				</div> 
			</body>
		</html>
	';

	return $HTML;
}


?>