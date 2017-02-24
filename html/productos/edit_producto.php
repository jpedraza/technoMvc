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
                                <a class="btn btn-default" data-toggle="modal" href="Stock/">
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
                  <li><a href="Stock/"><i class="fa fa-folder-open-o"></i>Productos</a></li>
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
                                    Editar Producto
                                </h4>
                            </div>

                            <div id="_AJAX_EDIPRO_"></div>

                            <div class="modal-body">
                                <form role="form" enctype="multipart/form" id="form" onkeypress="return runScriptEdipro(event)">
                                    <div class="form-group col-sm-6">
                                        <input type="hidden" id="id" name="id" value="<?php echo $_GET['id']; ?>">
                                        <label for="inputEmail" class="col-lg-4 control-label">Nombre del Producto <b class="aviso-luis">*</b></label>
                                        <div class="col-lg-10">
                                            <input type="text" class="form-control" id="nombre" maxlength="<?php echo LONGITUD_MAX_NOM; ?>" name="nombre" placeholder="Nombre del producto" value="<?php echo $_productos[$_GET['id']]['nombre']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="inputEmail" class="col-lg-6 control-label">Precio <b class="aviso-luis">*</b></label>
                                        <div class="col-lg-10">
                                            <input type="number" class="form-control" id="precio" name="precio" placeholder="Precio" value="<?php echo $_productos[$_GET['id']]['precio']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label for="inputEmail" class="col-lg-4 control-label">Cantidad <b class="aviso-luis">*</b></label>
                                        <div class="col-lg-10">
                                            <input type="number" class="form-control" id="cantidad" name="cantidad" placeholder="Stock" value="<?php echo $_productos[$_GET['id']]['cantidad']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for="inputEmail" class="col-lg-4 control-label">Condicion <b class="aviso-luis">*</b></label>
                                        <div class="col-lg-10">
                                            <select name="condicion" id="condicion" class="form-control">
                                                <?php 
                                                    if ($_productos[$_GET['id']]['condicion'] == 1) {
                                                       echo '<option value="1">Nuevo</option>';
                                                    } else {
                                                       echo '<option value="2">Usado</option>';
                                                    }
                                                ?>
                                                <option value="1">Nuevo</option>
                                                <option value="2">Usado</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-5">
                                        <label for="inputEmail" class="col-lg-4 control-label">Categoría <b class="aviso-luis">*</b></label>
                                        <div class="col-lg-10">
                                            <select name="categoria" id="categoria" class="form-control">
                                                <?php 
                                                    echo '<option value="'. $_productos[$_GET['id']]['id_categoria'] .'">' . $_categorias[$_productos[$_GET['id']]['id_categoria']]['nombre']  .'</option>';
 
                                                    if ($_categorias) {
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

                                    <div class="form-group col-sm-6" enctype="multipart/form-data">
                                        <label for="inputEmail" class="col-lg-4 control-label">Sub-Categoría <b class="aviso-luis">*</b></label>
                                        <div class="col-lg-10">
                                            <select name="subcategoria" id="subcategoria" class="form-control">
                                                <?php
                                                    echo '<option value="'. $_productos[$_GET['id']]['id_subcategoria'] .'">' . $_subcategorias[$_productos[$_GET['id']]['id_subcategoria']]['nombre']  .'</option>';
                                                ?>
                                                <option value="0">Elige la Subcategoría</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="inputEmail" class="col-lg-4 control-label">Marca <b class="aviso-luis">*</b></label>
                                        <div class="col-lg-10">
                                            <input type="text" class="form-control" id="marca" name="marca" placeholder="Marca del producto" value="<?php echo $_productos[$_GET['id']]['marca']; ?>">
                                        </div>
                                    </div>

                                    <div class="form-group col-sm-6">
                                        <label for="inputEmail" class="col-lg-4 control-label">¿Esta en Oferta? <b class="aviso-luis">*</b></label>
                                        <div class="col-lg-10">
                                            <select name="oferta" id="oferta" class="form-control" onclick="return Desactivo(this.value)">
                                                <?php 
                                                    if ($_productos[$_GET['id']]['oferta'] == 0) {
                                                       echo 
                                                       '<option value="0">No</option>
                                                        <option value="1">Si</option>';
                                                    } else {
                                                       echo 
                                                       '<option value="1">Si</option>
                                                        <option value="0">No</option>';
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="inputEmail" class="col-lg-4 control-label">Precio de oferta</label>
                                        <div class="col-lg-10">
                                            <?php 
                                            if ($_productos[$_GET['id']]['oferta'] == 1) {
                                                echo '
                                                <input type="number" class="form-control" id="precio_oferta" name="precio_oferta" placeholder="Precio de Oferta" value="'.$_productos[$_GET['id']]['precio_oferta'].'">
                                                ';
                                            } else {
                                                echo'
                                                <input type="number" class="form-control" id="precio_oferta" name="precio_oferta" disabled="" placeholder="Precio de Oferta" value="'.$_productos[$_GET['id']]['precio_oferta'].'">
                                                ';
                                            }
                                            ?>
                                        </div>
                                    </div>

                                    <div class="form-group col-sm-4">
                                        <label for="inputEmail" class="col-lg-4 control-label">Foto Principal<b class="aviso-luis">*</b></label>
                                        <div class="col-lg-10">
                                            <input type="file" name="foto1" class="form-control" id="foto1" data-field-type="bootstrap-file-filed" 
                                            data-label='<i class="fa fa-folder-open"></i>Insertar Imagen' 
                                            data-btn-class="btn-default" 
                                            data-file-types="image/jpeg,image/png,image/gif"
                                            data-max-file-size="500000"
                                            data-max-num-files="1" 
                                            data-preview="on" >
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for="inputEmail" class="col-lg-4 control-label">Foto 2</label>
                                        <div class="col-lg-10">
                                            <input type="file" name="foto2" class="form-control" id="foto2" data-field-type="bootstrap-file-filed" 
                                            data-label='<i class="fa fa-folder-open"></i>Insertar Imagen' 
                                            data-btn-class="btn-default" 
                                            data-file-types="image/jpeg,image/png,image/gif"
                                            data-max-file-size="500000"
                                            data-max-num-files="1" 
                                            data-preview="on" >
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for="inputEmail" class="col-lg-4 control-label">Foto 3</label>
                                        <div class="col-lg-10">
                                            <input type="file" name="foto3" class="form-control" id="foto3" data-field-type="bootstrap-file-filed" 
                                            data-label='<i class="fa fa-folder-open"></i>Insertar Imagen' 
                                            data-btn-class="btn-default" 
                                            data-file-types="image/jpeg,image/png,image/gif"
                                            data-max-file-size="500000"
                                            data-max-num-files="1" 
                                            data-preview="on" >
                                        </div>
                                    </div>

                                    <div class="form-group col-sm-4">
                                        <div class="col-lg-10">
                                            <label for="fotos" class="col-lg-4 control-label">Foto 1 <i class="fa fa-arrow-right"></i></label>
                                            <img src="views/images/productos/<?php echo $_productos[$_GET['id']]['foto1']; ?>" alt="'. $_productos[$_GET['id']]['nombre'] .'" width="70" height="70">
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <div class="col-lg-10">
                                            <label for="fotos" class="col-lg-4 control-label">Foto 2 <i class="fa fa-arrow-right"></i></label>
                                            <img src="views/images/productos/<?php if (!empty($_productos[$_GET['id']]['foto2'])) {
                                                echo $_productos[$_GET['id']]['foto2'];
                                            } else {
                                                echo "default.jpg";
                                            }
                                            ?>" alt="'. $_productos[$_GET['id']]['nombre'] .'" width="70" height="70">
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <div class="col-lg-10">
                                            <label for="fotos" class="col-lg-4 control-label">Foto 3 <i class="fa fa-arrow-right"></i></label>
                                            <img src="views/images/productos/<?php if (!empty($_productos[$_GET['id']]['foto3'])) {
                                                echo $_productos[$_GET['id']]['foto3'];
                                            } else {
                                                echo "default.jpg";
                                            }
                                            ?>" alt="'. $_productos[$_GET['id']]['nombre'] .'" width="70" height="70">
                                        </div>
                                    </div>

                                    <div class="form-group col-sm-12">
                                        <label for="textArea" class="col-lg-4 control-label">Descripción <b class="aviso-luis">*</b></label>
                                          
                                        <div class="col-lg-8">
                                            <textarea rows="5" name="detalle" id="detalle" class="form-control" placeholder="Descripción del producto">
                                                <?php echo $_productos[$_GET['id']]['descripcion']; ?>
                                            </textarea>
                                        </div>
                                    </div>
                                    
                                    <button type="button" class="btn btn-default btn-success btn-block" onclick="goEdipro()">
                                        <span class="glyphicon glyphicon-saved"></span> 
                                        Editar producto
                                    </button>
                                </form>
                            </div>
                            <div class="modal-footer">
                                
                            </div>
                        </div>
                    </div>
                </div>    
            </div>
        </div>
    </section>

    <script src=views/app/js/producto.js></script>
    <?php include(HTML_DIR . 'overall/footer.php'); ?>
</body>
</html>