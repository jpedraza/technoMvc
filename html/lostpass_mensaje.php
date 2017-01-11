<?php include(HTML_DIR . 'overall/header.php'); ?>

<body>
<section class="engine"><a rel="nofollow" href="#"><?php echo APP_TITLE ?></a></section>

<?php include(HTML_DIR . '/overall/topnav.php'); ?>

<section>
	<div class="container">

	  <div class="alert alert-dismissible alert-success">
	      <strong>Contraseña cambiada!</strong> se ha generado una nueva contraseña <strong><?php echo $password ?></strong>, prueba <a data-toggle="modal" data-target="#Login">iniciar sesión</a> con ella y podrás cambiarla una vez estes dentro. 
	  </div>

	</div>
</section>

<?php include(HTML_DIR . 'overall/footer.php'); ?>

</body>
</html>
