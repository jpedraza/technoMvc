<?php include(HTML_DIR . 'overall/header.php'); ?>

<body>
    <section class="engine"><a rel="nofollow" href="#"><?php echo APP_TITLE ?></a></section>

    <?php include(HTML_DIR . 'overall/topnav.php'); ?>

    <section class="cart_items">
        <div class="container">
            
            <div class="row container col-sm-12">                
                <div class="pull-right">
                    <div>
                        <ul class="mbr-navbar__items mbr-buttons--active">
                            <li>
                                <a class="btn btn-default" data-toggle="modal" href="?view=userAdm">
                                    Gestionar
                                </a>
                                <a class="btn btn-default active" data-toggle="modal" href="#">
                                    Editar
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <ol class="breadcrumb">
                  <li><a href="home/"><i class="fa fa-home"></i>Inicio</a></li>
                  <li><a href="usuarios/"><i class="fa fa-folder-open-o"></i>Usuarios</a></li>
                </ol>
            </div>

            <div class="row cart_info col-sm-12">
                <div id="Edipro" role="dialog">
                    <div>  
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"></button>
                                <h4 class="aviso-luis">
                                    <span class="glyphicon glyphicon-shopping-cart"></span>
                                    Editar Usuario
                                </h4>
                            </div>

                            <div id="_AJAX_EDITUSER_"></div>

                            <div class="modal-body">
                                <?php 
                                $estatus = $_users[$_GET['id']]['activo'] == 1 ? 'Activo' : 'Inactivo';
                                $permiso = $_users[$_GET['id']]['permisos'];
                                switch ($permiso) {
                                    case '0':
                                        $permiso_value = 'Cliente Sancionado';
                                        break;
                                    case '1':
                                        $permiso_value = 'Cliente';
                                        break;
                                    case '2':
                                        $permiso_value = 'Administrador';
                                        break;                                    
                                    default:
                                        $permiso_value = 'Cliente Sancionado';
                                        break;
                                }
                                ?>
                                <form role="form">
                                    <div class="form-group" onkeypress="return runScriptEdituser(event)">
                                        <label for="nombre">
                                            <span class="glyphicon glyphicon-user"></span> 
                                            Nombre y Apellido
                                        </label>
                                        <input type="text" class="form-control" id="name_reg" value="<?php echo $_users[$_GET['id']]['name'] ?>" disabled="">
                                    </div>
                                    <div class="form-group" onkeypress="return runScriptEdituser(event)">
                                        <label for="usrname">
                                            <span class="glyphicon glyphicon-user"></span> 
                                            Usuario
                                        </label>
                                        <input type="text" class="form-control" id="user_reg" value="<?php echo $_users[$_GET['id']]['user'] ?>" disabled="">
                                    </div>
                                    <div class="form-group" onkeypress="return runScriptEdituser(event)">
                                        <label for="email">
                                            <span class="glyphicon glyphicon-envelope"></span> 
                                            Email
                                        </label>
                                        <input type="email" class="form-control" id="email_reg" value="<?php echo $_users[$_GET['id']]['email'] ?>" disabled="">
                                    </div>
                                    <div class="form-group" onkeypress="return runScriptEdituser(event)">
                                        <label for="psw">
                                            <span class="glyphicon glyphicon-user"></span> 
                                            Tipo Usuario
                                        </label>
                                        <select class="form-control" id="tipo_user">
                                            <option value="<?php echo $permiso ?>"><?php echo $permiso_value ?></option>
                                            <?php 
                                            if ($permiso == 0){ 
                                                echo 
                                                '<option value="1">Cliente</option>
                                                <option value="2">Administrador</option>';
                                            }elseif ($permiso == 1){
                                                echo 
                                                '<option value="0">Cliente Sancionado</option>
                                                <option value="2">Administrador</option>';
                                            }else {
                                                echo 
                                                '<option value="0">Cliente Sancionado</option>
                                                <option value="1">Cliente</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group" onkeypress="return runScriptEdituser(event)">
                                        <label for="psw_two">
                                            <span class="glyphicon glyphicon-off"></span> 
                                            Estatus
                                        </label>
                                        <select class="form-control" id="estatus_user">
                                            <option value="<?php echo $_users[$_GET['id']]['activo'] ?>"><?php echo $estatus ?></option>
                                            <?php 
                                            $option = $_users[$_GET['id']]['activo'] == 1 ? '<option value="0">Inactivo</option>' : '<option value="1">Activo</option>';
                                            echo $option;
                                            ?>
                                        </select>
                                    </div>
                                    <button type="button" onclick="goEdituser()" class="btn btn-default btn-success btn-block">
                                        <span class="glyphicon glyphicon-edit"></span> 
                                        Editar Administrador
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>    
            </div>
        </div>
    </section>

    <script src="views/app/js/userAdm.js"></script>
    <?php include(HTML_DIR . 'overall/footer.php'); ?>
</body>
</html>