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
                                    $db->liberar($sql);   
                                ?>
                                <img src="<?php echo URL_PRODUCTOS . "default.jpg" ;?>" class="thumbnail" height="120" />
                                <strong style="color:#0084bd;"><?php echo strtoupper($users[$id_usuario]['name']); ?></strong> <br /><br />
                            </center>
                            <p>
                                <?php 
                                    /**
                                     * Cantidad de Compras de un Usuario
                                     */
                                    $sql = $db->query(
                                        "SELECT 
                                            count(*) 
                                        FROM 
                                            compras 
                                        WHERE 
                                            id_usuario='$_SESSION[app_id]';"
                                    );
                                    $numeroCompras = $db->rows($sql);
                                    $db->liberar($sql);

                                    /**
                                     * Cantidad de Productos comprados por un Usuario
                                     */
                                    $sql = $db->query(
                                        "SELECT 
                                            SUM(dc.cantidad_items), c.fecha 
                                        FROM 
                                            compras c 
                                        JOIN 
                                            detalle_compras dc 
                                        ON 
                                            c.id = dc.id_compra 
                                        WHERE 
                                            c.id_usuario = '$_SESSION[app_id]';"
                                    );
                                    $query             = $db->recorrer($sql);
                                    $cantidadComprados = intval($query[0]);
                                    $cantidadComprados == 0 ? $fechaCompra = "Hoy es un buen día" :  $fechaCompra = $query[1];
                                ?>
                                <strong>Compras: </strong> 
                                <span style="font-size: 10pt;color:#0084bd;"><?php echo $numeroCompras; ?></span>
                            </p>
                            <p>
                                <strong>Articulos Comprados: </strong>
                                <span style="font-size: 10pt; color:#0084bd;"><?php echo $cantidadComprados; ?></span>
                            </p>
                            <p>
                                <strong>Última Compra: </strong>
                                <span style="font-size: 10pt; color:#0084bd;"><?php echo $fechaCompra; ?></span>
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
                            <blockquote>
                                <div>
                                    <label>
                                        <span class="glyphicon glyphicon-shopping-cart"></span> 
                                        Productos Adquiridos
                                    </label>                                    
                                </div>
                                <div class="col-sm-12">
                                    <?php 
                                        $sql = $db->query(
                                            "SELECT 
                                                p.foto1, p.nombre, dc.id_producto
                                            FROM 
                                                compras c 
                                            JOIN 
                                                detalle_compras dc 
                                            ON 
                                                c.id = dc.id_compra 
                                            JOIN 
                                                productos p
                                            ON 
                                                dc.id_producto = p.id
                                            WHERE 
                                                c.id_usuario = '$_SESSION[app_id]';"
                                        );
                                        if ($db->rows($sql) > 1) {
                                            while ($data = $db->recorrer($sql)) {
                                                echo 
                                                '<a href="detalles/'. UrlAmigable($data[2], $_productos[$data[2]]['nombre']) . '" target="_blank">
                                                    <img src="'.URL_PRODUCTOS . $data[0] .'" alt="'. $data[1].'" width="100px" height=100px />
                                                </a>';
                                            }
                                        } else {
                                            echo
                                            '<span style="font-size: 10pt;color:#0084bd; text-align:justify;">
                                                 Aún no has comprado, aprovecha nuestros descuentos y promociones. ¿Qué estas esperando?
                                            </span>';
                                        }
                                    ?>
                                </div>
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