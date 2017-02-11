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
                                <a class="btn btn-default" data-toggle="modal" href="?view=categorias">
                                    Gestionar
                                </a>
                                <a class="btn btn-default" data-toggle="modal" href="?view=categorias&mode=add">
                                    Crear
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
                  <li><a href="#"><i class="fa fa-folder-open-o"></i>Categorías</a></li>
                </ol>
            </div>

            <div class="row cart_info col-sm-12">
                <div class="cart_info">
                    <div class="titulo_categoria">Gestión de Categorías</div><br />

                    <div class="cajas">
                        
                        <?php
                            if(isset($_GET['error'])) {
                                if ($_GET['error'] == 1) {                    
                                    echo 
                                    '<div class="alert alert-dismissible alert-danger">
                                        <strong>Error!</strong></strong> Nombre de la categoria no puede estar vacio.
                                    </div>';
                                } else if ($_GET['error'] == 2) {
                                    echo 
                                    '<div class="alert alert-dismissible alert-danger">
                                        <strong>Error!</strong></strong> Ya existe esta categoria.
                                    </div>';
                                } 
                            }
                            if(isset($_GET['success'])) {
                                echo '<div class="alert alert-dismissible alert-success">
                                <strong>Completado!</strong> La categoria ' . $_categorias[$_GET['id']]['nombre'] .' ha sido modificada correctamente.
                                </div>';
                            }

                            
                        ?>
                        <form class="form-horizontal" action="?view=categorias&mode=edit&id=<?php echo $_GET['id']; ?>" method="POST" enctype="application/x-www-form-urlencoded">
                            <fieldset>
                                <div class="form-group" onkeypress="return runScriptReg(event)">
                                    <label for="inputEmail" class="col-lg-2 control-label">Categoría</label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" name="nombre" placeholder="Nombre para la categoría" value="<?php echo $_categorias[$_GET['id']]['nombre']; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-10 col-lg-offset-2">
                                        <button type="reset" class="btn btn-default">Resetear</button>
                                        <button type="submit" class="btn btn-default">Editar</button>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include(HTML_DIR . 'overall/footer.php'); ?>
</body>
</html>