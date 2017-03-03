<?php 
include(HTML_DIR . 'overall/header.php'); ?>

<body>
<section class="engine"><a rel="nofollow" href="#"><?php echo APP_TITLE ?></a></section>


<?php include(HTML_DIR . '/overall/topnav.php'); ?>
<section>
    <div class="container">
        <div class="row">
            <!--CUERPO DE FAVORITOS-->
            <div class="col-sm-12 padding-right">
                <div class="features_items">
                    <h2 class="title text-center">
                        <i class="fa fa-star" style="color: gold"></i> Productos Favoritos <i class="fa fa-star" style="color: gold"></i>
                    </h2>
                    <?php
                    $HTML = "";
                    if ($cantidadPrd > 0) {
                        /**
                         * Verifica si existen las variables de Sesion favoritos y Usuario Logeado.
                         * En base a la respuesta hace el SELECT para mostrar los favoritos.
                         */
                        $favoritos = isset($_SESSION['favoritos']) ? $_SESSION['favoritos'] : null;
                        $id        = isset($_SESSION['app_id']) ? $_SESSION['app_id'] : null;
                        $sql = $db->query(
                            "SELECT
                                id_producto,
                                id
                            FROM
                                favoritos
                            WHERE
                                id_usuario = '$favoritos' OR id_usuario = '$id';");
                        while($data = $db->recorrer($sql)) {
                            $_productos[$data[0]]['oferta'] == 1 ? $precio = number_format($_productos[$data[0]]['precio_oferta'],2,",",".") : $precio = number_format($_productos[$data[0]]['precio'],2,",",".");
                            $nombreProducto = strlen($_productos[$data[0]]['nombre']) > 50 ? substr($_productos[$data[0]]['nombre'],0,47) . "..." : $_productos[$data[0]]['nombre'];
                            $HTML .= '
                            <div class="col-sm-4">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center men-thumb-item">
                                            <a href="detalles/'. UrlAmigable($data[0], $_productos[$data[0]]['nombre']) . '">
                                                <img src="'. URL_PRODUCTOS . $_productos[$data[0]]['foto1'].'" alt="'.$_productos[$data[0]]['nombre'].'" class="pro-image-front" />
                                                <h2>'.$precio.'</h2>
                                                <p class="product-name" title="'. $_productos[$data[0]]['nombre'] .'">'.
                                                    $nombreProducto .'
                                                </p>
                                            </a>
                                            <a href="agregar/'. UrlAmigable($data[0],$_productos[$data[0]]['nombre']).'" class="btn btn-default add-to-cart">
                                                <i class="fa fa-shopping-cart"> Agregar</i>
                                            </a>
                                            <a href="borrar-de-Favoritos/'. UrlAmigable($data[1],$_productos[$data[0]]['nombre']).'" class="btn btn-default add-to-cart">
                                                <i class="fa fa-close"> Borrar</i>
                                            </a> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            ';
                        }
                        $db->liberar($sql);
                        $db->close();  
                        echo $HTML;
                    } else { ?>
                        <div class="col-sm-12">
                            <h4 style="margin-top: 30px; margin-bottom: 100px;">Aún no tienes productos en tus favoritos.</h4>
                        </div> <?php

                    }?>                                 
                </div><!-- FIN DE FAVORITOS-->
            </div>
        </div>
    </div>
</section>

<?php include(HTML_DIR . 'overall/footer.php'); ?>

</body>
</html>