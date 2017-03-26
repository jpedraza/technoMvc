<?php 

function EmailTemplate($name){
	$HTML = '
		<html>
			<body style="background: #ffffff; font-family: Verdana; font-size: 14px; color: #1c1b1b;">
				<div>
					<a href="'.APP_URL.'"><img src="http://lcdesign.com.ve/techno/views/images/home/logo.png" alt="Technotronic Game RK" /></a><br />
					<h2> Hola ' .$name . ' </h2>
					<p style="font-size: 17px;"> 
						Gracias por adquirir tus productos en ' . APP_TITLE. '. 
					</p>
					<p style="text-align: justify;">
						A continuación te informamos detalladamente lo que adquiriste: 
					</p>
										
					<p style="font-size: 9px;">
						&copy; '. date('Y',time()) .' '.APP_TITLE.'. Todos los derechos reservados.
					</p>
				</div> 
			</body>
		</html>
	';

	return $HTML;
}


?>