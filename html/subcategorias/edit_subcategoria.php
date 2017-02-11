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
                                <a class="btn btn-default" data-toggle="modal" href="?view=subcategorias">
                                    Gestionar
                                </a>
                                <a class="btn btn-default" data-toggle="modal" href="?view=subcategorias&mode=add">
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
                  <li><a href="#"><i class="fa fa-folder-open-o"></i>Sub-Categorías</a></li>
                </ol>
            </div>

            <div class="row cart_info col-sm-12">
                <div class="cart_info">
                    <div class="titulo_categoria">Gestión de Sub-Categorías</div><br />

                    <div class="cajas">
                        
                        <?php
                            if(isset($_GET['success'])) {
                                echo '<div class="alert alert-dismissible alert-success">
                                <strong>Completado!</strong> La sub-categoria ' . $_subcategorias[$_GET['id']]['nombre'] . ' ha sido editada correctamente.
                                </div>';
                            }

                            if(isset($_GET['error'])) {
                                if ($_GET['error'] == 1) {                    
                                    echo 
                                    '<div class="alert alert-dismissible alert-danger">
                                        <strong>Error!</strong></strong> debe completar todos los campos.
                                    </div>';
                                } else if ($_GET['error'] == 2) {
                                    echo 
                                    '<div class="alert alert-dismissible alert-danger">
                                        <strong>Error!</strong></strong> debe asociar al menos una categoria.
                                    </div>';
                                } else if ($_GET['error'] == 3) {
                                    echo 
                                    '<div class="alert alert-dismissible alert-danger">
                                        <strong>Error!</strong></strong> ya existe esta sub-categoria.
                                    </div>';
                                }
                            }

                            
                        ?>
                        <form class="form-horizontal" action="?view=subcategorias&mode=edit&id=<?php echo $_GET['id']; ?>" method="POST" enctype="application/x-www-form-urlencoded">
                            <fieldset>
                                <div class="form-group col-sm-5" onkeypress="return runScriptReg(event)">
                                    <label for="inputEmail" class="col-lg-2 control-label">Categoría <b class="aviso-luis">*</b></label>
                                    <div class="col-lg-10">
                                        <select name="id_categoria" class="form-control">
                                            <?php 
                                                if ($_subcategorias) {
                                                    echo 
                                                    '<option value="' . $_subcategorias[$_GET['id']]['id_categoria']. '">' .
                                                        strtoupper(substr($_categorias[$_subcategorias[$_GET['id']]['id_categoria']]['nombre'],0,1)).
                                                        strtolower(substr($_categorias[$_subcategorias[$_GET['id']]['id_categoria']]['nombre'],1)).
                                                    '</option>';
                                                        foreach ($_categorias as $id_categoria => $array_categoria) {
                                                            echo 
                                                            '<option value="' . $id_categoria . '">' 
                                                            . strtoupper(substr($_categorias[$id_categoria]['nombre'],0,1)).strtolower(substr($_categorias[$id_categoria]['nombre'],1)).
                                                            '</option>';
                                                        } 
                                                } else {
                                                    echo '<option value="0">No existen categorías</option>';
                                                }
                                            ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-5" onkeypress="return runScriptReg(event)">
                                        <label for="inputEmail" class="col-lg-2 control-label">Sub-Categoría <b class="aviso-luis">*</b></label>
                                        <div class="col-lg-10">
                                            <input type="text" class="form-control" name="nombre" placeholder="Nombre para la sub-categoría" value="<?php echo $_subcategorias[$_GET['id']]['nombre']; ?>">
                                        </div>
                                    </div>
                                <div class="form-group col-sm-12">
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