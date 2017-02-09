<?php include(HTML_DIR . 'overall/header.php'); ?>

<body>
<section class="engine"><a rel="nofollow" href="#"><?php echo APP_TITLE ?></a></section>


<?php include(HTML_DIR . '/overall/topnav.php'); ?>

<section>
  <div class="container">
    <div class="row">
      <!--SECCION IZQUIERDA-->
      <div class="col-sm-3">
        <div class="left-sidebar">
          <div class="brands_products">
            <!--PRODUCTO POR CONDICIÓN-->
            <h2>CONDICIÓN DEL PRODUCTO</h2>
            <div class="brands-name">
              <ul class="nav nav-pills nav-stacked">
                <li><a href="<?php echo 'condicion/1-Nuevos'; ?>"> <span class="pull-right"></span>Nuevo</a></li>
                <li><a href="<?php echo 'condicion/2-Usados'; ?>"> <span class="pull-right"></span>Usado</a></li>
              </ul>
            </div>
          </div>
          <!--/PRODUCTO POR CONDICIÓN -->

          <div class="brands_products">
            <!--PRODUCTOS POR MARCA-->
            <h2>MARCAS PREFERIDAS</h2>
            <div class="brands-name">
              <ul class="nav nav-pills nav-stacked">
                <?php
                    $sqlMarca = 
                        "SELECT 
                            marca, COUNT(*) total 
                        FROM 
                            productos 
                        GROUP BY 
                            marca 
                        HAVING 
                            total > 1 
                        LIMIT 6";
                    $db = new Conexion();
                    $marca = $db->query($sqlMarca);
                    while ($marcaBd = $db->recorrer($marca)) { ?>
                        <li>
                            <a href="<?php print 'marca/'. $marcaBd[0] ?>"> 
                                <span class="pull-right"><?php print "(" . $marcaBd[1] . ")" ?></span>
                                <?php print $marcaBd[0] ?>
                            </a>
                        </li>
                    <?php 
                    } ?>
              </ul>
            </div>
          </div>
          <!--/PRODUCTOS POR MARCA-->
          
          <!--PRODUCTOS EN OFERTA-->
          <div class="brands_products">
            <a href="promocion/1-Promocion"><h2>Productos En Oferta</h2></a>
          </div>
          <!--/PRODUCTOS EN OFERTA-->
        </div>
      </div>

            <!--SECCION CENTRAL DE LA PAGINA-->
            <div class="col-sm-9 padding-right">
                <div class="features_items"><!--Productos Destacados-->
                    <h2 class="title text-center">
                        Productos en Oferta
                    </h2>
                    <?php 
                    $total = 0;
                    $db = new Conexion();
                    $sql_new = $db->query(
                        "SELECT
                            *
                        FROM
                            productos
                        WHERE
                            oferta='$_GET[oferta]'
                        ;")
                    ;
                    if ($db->rows($sql_new) > 0) {
                        while ($sql_new->fetch_row()) { 
                            $total = $total + 1 ;
                        }
                    }
                    $compag = (int)(!isset($_GET['pag'])) ? 1 : $_GET['pag']; 
                    $TotalReg = is_numeric($total) ? $total : null;
                    $TotalRegistro  = ceil($TotalReg / CANTIDAD_ARTICULOS);
                    $consultavistas =
                        "SELECT
                            id,
                            foto1,
                            precio,
                            nombre,
                            oferta,
                            precio_oferta
                        FROM
                            productos
                        WHERE
                            oferta='$_GET[oferta]'
                        ORDER BY
                            nombre ASC
                        LIMIT ".(($compag-1) * CANTIDAD_ARTICULOS)." , ".CANTIDAD_ARTICULOS
                    ;
                    $consulta = $db->query($consultavistas);
                        if ($db->rows($consulta) > 0) {
                            while ($nuevos = $consulta->fetch_row()) { ?>
                                <div class="col-sm-4">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center men-thumb-item">
                                                <?php echo 
                                                '<a href="detalles/'. UrlAmigable($nuevos[0], $_productos[$nuevos[0]]['nombre']) . '">'; ?>                                            
                                                    <img src="<?php echo URL_PRODUCTOS . $nuevos[1]; ?>" alt="<?php echo $nuevos[3]; ?>" class="pro-image-front">
                                                    <h2>
                                                        <?php 
                                                        $nuevos[4] == 1 ? $precio = number_format($nuevos[5],2,",",".") : $precio = number_format($nuevos[2],2,",","."); 
                                                        echo $precio;
                                                        ?>
                                                    </h2>
                                                    <p class="product-name" title="<?php echo $nuevos[3]; ?>">
                                                        <?php 
                                                        if (strlen($nuevos[3]) > 50) {
                                                            echo substr($nuevos[3],0,47);
                                                            echo "...";
                                                        } else {
                                                            echo $nuevos[3];
                                                        }
                                                        ?>           
                                                    </p>   
                                                </a>
                                                <a href='agregar/<?php echo UrlAmigable($nuevos[0],$_productos[$nuevos[0]]['nombre']) ?>' class="btn btn-default add-to-cart">
                                                    <i class="fa fa-shopping-cart"></i>Agregar al carrito
                                                </a>                                                
                                            </div>
                                            <?php 
                                            if ($nuevos[4] == 1) { ?>
                                                <img src="views/images/home/sale.png" class="new" alt="Oferta">
                                            <?php 
                                            } 
                                            ?>
                                        </div>
                                        <div class="choose">
                                            <ul class="nav nav-pills nav-justified">
                                                <li>
                                                    <a href='agregar-Favoritos/<?php echo UrlAmigable($nuevos[0],$_productos[$nuevos[0]]['nombre']) ?>'>
                                                        <i class="fa fa-star"></i>Agregar a Favoritos
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="detalles/<?php echo UrlAmigable($nuevos[0], $_productos[$nuevos[0]]['nombre']) ?>">
                                                        <i class="fa fa-plus-square"></i>Ver Detalle
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div> <?php 
                            } 
                            /*Sector de Paginacion */
                                                                    
                                //Operacion matematica para botón siguiente y atrás 
                                $IncrimentNum = (($compag + 1) <= $TotalRegistro) ? ($compag + 1) : 1;
                                $DecrementNum = (($compag - 1)) < 1 ? 1 :( $compag - 1);
                                $condition    = "Promocion";                                    
                                $HTML =  
                                    '<div class="col-md-9" style="text-align:center">
                                    <ul class="pagination"> ';
                                if($TotalRegistro > 3){
                                    $HTML .= 
                                        '<li>
                                            <a href=promocionPag/'.$_GET['oferta']. '-' . $condition . '-1>
                                                ◀◀
                                            </a>
                                        </li>';
                                } else { 
                                    $HTML .= 
                                        '';
                                }
                                if($TotalRegistro > 1){
                                $HTML .=
                                    '<li>
                                        <a href=promocionPag/'.$_GET['oferta']. '-' . $condition . '-' . $DecrementNum . '>
                                            ◀
                                        </a>
                                    </li>';
                                } else { 
                                    $HTML .= 
                                        '';
                                }    
                                //Se resta y suma con el numero de pag actual con el cantidad de 
                                //números  a mostrar
                                $Desde = $compag - (ceil(CANTIDAD_ARTICULOS / 2) - 1);
                                $Hasta = $compag + (ceil(CANTIDAD_ARTICULOS / 2) - 1);
                                                                    
                                //Se valida
                                $Desde = ($Desde < 1) ? 1 : $Desde;
                                $Hasta = ($Hasta < CANTIDAD_ARTICULOS) ? CANTIDAD_ARTICULOS : $Hasta;
                                //Se muestra los números de paginas
                                for($i = $Desde; $i <= $Hasta; $i++) {
                                //Se valida la paginacion total de registros
                                    if($i <= $TotalRegistro){
                                    //Validamos la pag activo
                                        if($i == $compag){
                                            $HTML .=  
                                            '<li class="active">
                                                <a href="promocionPag/'.$_GET['oferta']. '-' . $condition . '-' . $i .'">
                                                    '.$i.'
                                                </a>
                                            </li>';
                                        } else {
                                            $HTML .=  
                                            '<li>
                                                <a href="promocionPag/'.$_GET['oferta']. '-' . $condition . '-' .$i.'">
                                                    ' . $i . '
                                                </a>
                                            </li>';
                                        }           
                                    }
                                }
                                if($TotalRegistro > 1){
                                $HTML .=  
                                    '<li>
                                        <a href=promocionPag/'.$_GET['oferta']. '-' . $condition . '-' . $IncrimentNum . '>
                                            ▶
                                        </a>
                                    </li>';
                                } else { 
                                    $HTML .= 
                                        '';
                                }    
                                if ($TotalRegistro > 3){
                                    $HTML .= 
                                    '<li>
                                        <a href=promocionPag/'.$_GET['oferta']. '-' . $condition . '-' . intval($TotalRegistro) . '>
                                            ▶▶
                                        </a>
                                    </li>';
                                } else {
                                    $HTML .= 
                                        '</ul>
                                    </div>';
                                }
                                echo $HTML;
                        } else { ?>
                            <div class="col-sm-12"><br /><br />
                                <div class="product-image-wrapper" style="background-color: #E8F8FD;">
                                    <div class="single-products">
                                        <div class="productinfo text-center men-thumb-item">
                                            <h2> Aún no hay productos en esta sección </h2>
                                        </div>
                                    </div>
                                </div><br /><br /><br /><br />
                            </div>    
                        <?php }
                        ?>                                            
                </div><!-- FIN Productos Destacados-->


                <div class="recommended_items"><!--MAS VENDIDOS-->
                    <h2 class="title text-center">Productos Más Vendidos</h2>

                    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="item active">
                                <?php 
                                    $sql = $db->query(
                                        "SELECT
                                            id,
                                            foto1,
                                            precio,
                                            oferta,
                                            precio_oferta,
                                            nombre,
                                            cantidad_vendida
                                        FROM
                                            productos
                                        ORDER BY
                                        cantidad_vendida DESC
                                        LIMIT
                                        3;")
                                    ;
                                    while ($prod = $sql->fetch_row()) {
                                ?>                                                        
                                <div class="col-sm-4">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center men-thumb-item">
                                                <a href="<?php echo 'detalles/'. UrlAmigable($prod[0], $_productos[$prod[0]]['nombre']) ?>">
                                                    <img src="<?php echo URL_PRODUCTOS . $prod[1]; ?>" alt="<?php echo $prod[5]; ?>" class="pro-image-front">
                                                    <h2>
                                                        <?php 
                                                            $prod[3] == 1 ? $precio = number_format($prod[4],2,",",".") : $precio = number_format($prod[2],2,",","."); 
                                                        echo $precio;
                                                        ?>
                                                    </h2>
                                                    <p class="product-name" title="<?php echo $prod[5]; ?>">
                                                        <?php 
                                                        if (strlen($prod[5]) > 50) {
                                                            echo substr($prod[5],0,47);
                                                            echo "...";
                                                        } else {
                                                            echo $prod[5];
                                                        }
                                                        ?>           
                                                    </p>
                                                </a>
                                                <a href='agregar/<?php echo UrlAmigable($prod[0],$_productos[$prod[0]]['nombre']) ?>' class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Agregar al carrito</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php 
                                    }
                                ?>
                            </div>
                            <div class="item">
                                <?php 
                                    $sql = $db->query(
                                        "SELECT
                                            id,
                                            foto1,
                                            precio,
                                            oferta,
                                            precio_oferta,
                                            nombre,
                                            cantidad_vendida
                                        FROM
                                            productos
                                        ORDER BY
                                        cantidad_vendida DESC
                                        LIMIT
                                        3,3;")
                                    ;
                                    while ($prod = $sql->fetch_row()) {
                                ?>                                                        
                                <div class="col-sm-4">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center men-thumb-item">
                                                <a href="<?php echo 'detalles/'. UrlAmigable($prod[0], $_productos[$prod[0]]['nombre']) ?>">
                                                    <img src="<?php echo URL_PRODUCTOS . $prod[1]; ?>" alt="<?php echo $prod[5]; ?>" class="pro-image-front">
                                                    <h2>
                                                        <?php 
                                                            $prod[3] == 1 ? $precio = number_format($prod[4],2,",",".") : $precio = number_format($prod[2],2,",","."); 
                                                        echo $precio;
                                                        ?>
                                                    </h2>
                                                    <p class="product-name" title="<?php echo $prod[5]; ?>">
                                                        <?php 
                                                        if (strlen($prod[5]) > 50) {
                                                            echo substr($prod[5],0,47);
                                                            echo "...";
                                                        } else {
                                                            echo $prod[5];
                                                        }
                                                        ?>           
                                                    </p>
                                                </a>
                                                <a href='agregar/<?php echo UrlAmigable($prod[0],$_productos[$prod[0]]['nombre']) ?>' class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Agregar al carrito</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php 
                                    }
                                    $db->close();
                                ?>
                            </div>
                        </div>
                        <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>      
                    </div>
                </div><!--/FIN DE MAS VENDIDOS-->
            </div>
        </div>
    </div>
</section>



<?php include(HTML_DIR . 'overall/footer.php'); ?>

<script>
    $(document).ready(function(){
 
    //selector de imagenes a aplicar la funcionalidad de click
    $("#thumbs img").click(function(){
 
        //obtenemos la imagen a mostrar
        urlImagenGrande=$(this).data("img");
 
        //asignamos la imagen por medio de prop
        $("#imagenGrande").prop("src",urlImagenGrande); 
    }) 
});
</script>
</body>
</html>
