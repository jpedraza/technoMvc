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
                                <a class="btn btn-default" data-toggle="modal" href="Promociones/">
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
                  <li><a href="Promociones/"><i class="fa fa-folder-open-o"></i>Promociones</a></li>
                </ol>
            </div>

            <div class="row cart_info col-sm-12">
                <div id="Edipro" role="dialog">
                    <div>  
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"></button>
                                <h4 class="aviso-luis">
                                    <span class="glyphicon glyphicon-gift"></span>
                                    Editar Promociones
                                </h4>
                            </div>

                            <div id="_AJAX_EDIPROMO_"></div>

                            <div class="modal-body">
                                <form role="form" method="post" enctype="multipart/form-data" id="form" onkeypress="return runScriptAddpromo(event)">
                                    <div class="form-group" onkeypress="return runScriptAddpromo(event)">
                                        <label for="titulo">
                                            <span class="glyphicon glyphicon-pencil"></span> 
                                            Titulo
                                        </label>
                                        <input type="text" class="form-control" id="titulo" maxlength="25" placeholder="Introduce el titulo" value="<?php echo $_promociones[$_GET['id']]['titulo'] ?>">
                                        <input type="hidden" name="id" id="id" value="<?php echo $_GET['id'] ?>">
                                    </div>
                                    <div class="form-group" onkeypress="return runScriptAddpromo(event)">
                                        <label for="detalle">
                                            <span class="glyphicon glyphicon-pencil"></span> 
                                            Detalle de Promoción
                                        </label>
                                        <textarea class="form-control" id="detalle_promo" maxlength="90"><?php echo $_promociones[$_GET['id']]['detalle'] ?></textarea> 
                                    </div>
                                    <div class="form-group" onkeypress="return runScriptAddpromo(event)">
                                        <input type="file" name="imagen" class="form-control" id="imagen" data-field-type="bootstrap-file-filed" 
                                            data-label='<i class="fa fa-folder-open"></i>Insertar Imagen' 
                                            data-btn-class="btn-default" 
                                            data-file-types="image/jpeg,image/png,image/gif"
                                            data-max-file-size="500000"
                                            data-max-num-files="1" 
                                            data-preview="on" />
                                        <label for="detalle"> Img. Actual <span class="glyphicon glyphicon-arrow-right"></span></label>
                                        <img src="views/images/home/promociones/<?php echo $_promociones[$_GET['id']]['imagen']; ?>" alt="'. $_promociones[$_GET['id']]['titulo'] .'" width="90" height="70">
                                    </div>
                                    <div class="form-group" onkeypress="return runScriptAddpromo(event)">
                                        <label for="psw">
                                            <span class="glyphicon glyphicon-picture"></span> 
                                            Agregar Imagen de Oferta
                                        </label>
                                        <select class="form-control" id="oferta">
                                            <?php 
                                            $oferta = $_promociones[$_GET['id']]['oferta'] == 1 ? 
                                            '<option value="'.$_promociones[$_GET['id']]['oferta'].'">Si</option>
                                            <option value="0">No</option>' 
                                            : 
                                            '<option value="'.$_promociones[$_GET['id']]['oferta'].'">No</option>
                                            <option value="1">Si</option>' ;

                                            echo $oferta;
                                            ?> 
                                        </select> 
                                    </div>
                                    <button type="button" onclick="goEdipromo()" class="btn btn-default btn-success btn-block">
                                        <span class="glyphicon glyphicon-check"></span> 
                                        Editar Promoción
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>    
            </div>
        </div>
    </section>

    <script src="views/app/js/promociones.js"></script>
    <?php include(HTML_DIR . 'overall/footer.php'); ?>
</body>
</html>