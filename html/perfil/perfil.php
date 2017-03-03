<?php include(HTML_DIR . 'overall/header.php'); ?>

<body>
    <section class="engine"><a rel="nofollow" href="#"><?php echo APP_TITLE ?></a></section>

    <?php include(HTML_DIR . 'overall/topnav.php'); ?>

    <section class="mbr-section mbr-after-navbar">
        <div>
            <div class="row container">                
                <div class="pull-right">
                    <div class="mbr-navbar__column">
                        <ul>
                            <li class="mbr-navbar__item">
                                <a class="btn btn-default" data-toggle="modal" data-target="#Editpass"><i class="fa fa-edit"></i> Modificar Clave</a>
                                <?php  include(HTML_DIR . '/perfil/editpass.html'); ?>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <ol class="breadcrumb">
                <li><i class="fa fa-user"></i> Usuarios</li>
            </ol>
        </div>

            <div class="row categorias_con_foros">
			   <div class="col-sm-12">
			       <div class="row titulo_categoria" style="margin-bottom: 15px;">Perfil de <?php echo $_users[$id_usuario]['user']; ?></div>

			       	<div class="row cajas">
				        <div class="col-md-3" >
				          	<center>
                                <?php 
                                    $db     = new Conexion();
                                    $sql    = $db->query("SELECT * FROM users WHERE id='$_SESSION[app_id]';");
                                    if ($db->rows($sql) > 0) {
                                        while($data = $db->recorrer($sql)) {
                                            $users[$data['id']] = $data;
                                        }
                                    } else {
                                        $users = false;
                                    }    
                                ?>
                                <img src="<?php echo URL_PRODUCTOS . "default.jpg" ;?>" class="thumbnail" height="120" />
                                <strong style="color:#0084bd;"><?php echo strtoupper($users[$id_usuario]['name']); ?></strong> <br /><br />
                            </center>
                            <p>
                                <strong>Compras: </strong> 
                                <span style="font-size: 10pt;color:#0084bd;">0</span>
                            </p>
                            <p>
                                <strong>Última Visita: </strong>
                                <span style="font-size: 10pt; color:#0084bd;"><?php echo $users[$id_usuario]['ultima_conexion']; ?></span>
                            </p>

                        </div>
                        <div class="col-md-9">
                        <div id="_AJAX_EDIPERFIL_"></div>
                            <blockquote>
                                <form role="form">
                                    <div class="form-group" onkeypress="return runScriptEditPer(event)">
                                        <label for="nombre">
                                            <span class="glyphicon glyphicon-user"></span> 
                                            Nombre y Apellido
                                        </label>
                                        <input type="text" class="form-control" id="name_reg" placeholder="Introduce tu Nombre y Apellido" onclick="return activo()" value="<?php echo $users[$id_usuario]['name']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="usrname">
                                        <span class="glyphicon glyphicon-user"></span> 
                                        Usuario
                                        </label>
                                        <input type="text" class="form-control" id="user_reg" placeholder="Introduce un nombre de usuario" value="<?php echo $users[$id_usuario]['user']; ?>" disabled="">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">
                                        <span class="glyphicon glyphicon-envelope"></span> 
                                        Email
                                        </label>
                                        <input type="email" class="form-control" id="email_reg" placeholder="Introduce tu correo electrónico" value="<?php echo $users[$id_usuario]['email']; ?>" disabled="">
                                    </div>
                                    <button type="button" onclick="ediPerfil()" id="editar" class="btn btn-default btn-success btn-block" disabled="">
                                        <span class="glyphicon glyphicon-edit"></span> 
                                        Editar
                                    </button>
                                </form>
                            </blockquote>
                            <hr />
				        </div>
				    </div>
				</div>
			</div>
		</div>
	</section>
    
    <?php include(HTML_DIR . 'overall/footer.php'); ?>
    <script src="views/app/js/editPerfil.js"></script>
</body>
</html>