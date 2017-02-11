<?php include(HTML_DIR . 'overall/header.php'); ?>

<body>
<section class="engine"><a rel="nofollow" href="#"><?php echo APP_TITLE ?></a></section>

<?php include(HTML_DIR . '/overall/topnav.php'); ?>

<section>
	<div class="container">

	  <div class="alert alert-dismissible alert-success">
	  	<?php 
	  		if (isset($_SESSION['app_id'])) {
	  			echo '
	  			<strong>Contraseña cambiada!</strong> has cambiado con éxito tu contraseña a <strong>'. $password .'</strong>';
	  		} else {
	  			echo 
	  			'<strong>Contraseña cambiada!</strong> has cambiado tu contraseña con éxito a <strong>'. $password .'</strong>, prueba <a data-toggle="modal" data-target="#Login">iniciar sesión</a> con ella. ';
	  		}
	  		
	  	?>
	      
	  </div>

	</div>
</section>

<?php include(HTML_DIR . 'overall/footer.php'); ?>

</body>
</html>