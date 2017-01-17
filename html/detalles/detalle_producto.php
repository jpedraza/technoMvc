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
                <li><a href="#"> <span class="pull-right"></span>Nuevo</a></li>
                <li><a href="#"> <span class="pull-right"></span>Usado</a></li>
              </ul>
            </div>
          </div>
          <!--/PRODUCTO POR CONDICIÓN -->

          <div class="brands_products">
            <!--PRODUCTOS POR MARCA-->
            <h2>MáS BUSCADOS</h2>
            <div class="brands-name">
              <ul class="nav nav-pills nav-stacked">
                <li><a href="#"> <span class="pull-right">(7)</span>Generico</a></li>
                <li><a href="#"> <span class="pull-right">(4)</span>PlayStation</a></li>
                <li><a href="#"> <span class="pull-right">(5)</span>Sony</a></li>
                <li><a href="#"> <span class="pull-right">(2)</span>Wii</a></li>
              </ul>
            </div>
          </div>
          <!--/PRODUCTOS POR MARCA-->
          
          <!--PRODUCTOS EN OFERTA-->
          <div class="brands_products">
            <a href="#"><h2>Productos En Oferta</h2></a>
          </div>
          <!--/PRODUCTOS EN OFERTA-->

          <!--PUBLICIDAD-->
          <div class="shipping text-center">
              <img src="views/images/home/publicidad.jpg" alt="" />
          </div>
          <!--/PUBLICIDAD-->
        </div>
      </div>

            <!--SECCION CENTRAL DE LA PAGINA-->
             <div class="col-sm-9 padding-right">
                <div class="product-details"><!--Detalles del Producto-->
                    <div class="col-sm-5">
                        <?php 
                            $db = new Conexion();
                            $sql = $db->query(
                                "SELECT
                                    *
                                FROM
                                    productos
                                WHERE
                                    id='$_GET[id]'
                                LIMIT 
                                    1;")
                            ;
                            while ($prod = $sql->fetch_row()) {
                        ?>
                         
                        <div class="view-product">
                            <img id="imagenGrande" alt="<?php echo $prod[1]; ?>" src="views/images/productos/<?php echo $prod[11]; ?>" />
                        </div>
                        <div id="similar-product" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <div id="thumbs" class="item active">
                                    <img src="views/images/productos/<?php echo $prod[11]; ?>" alt="<?php echo $prod[1]; ?>" data-img="views/images/productos/<?php echo $prod[11]; ?>" />
                                    <img src="views/images/productos/<?php echo $prod[12]; ?>" alt="<?php echo $prod[1]; ?>" data-img="views/images/productos/<?php echo $prod[12]; ?>" />
                                    <img src="views/images/productos/<?php echo $prod[13]; ?>" alt="<?php echo $prod[1]; ?>" data-img="views/images/productos/<?php echo $prod[13]; ?>" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="product-information"><!--/Información del Producto-->
                            <h2><?php echo $prod[1]; ?></h2>
                            <p>Código: <?php print '#000'. $prod[0] ?></p>
                            <img src="views/images/product-details/rating.png" alt="">
                            <span>
                                <?php 
                                if ($prod[9] == 1){ ?>
                                    <strike><?php print "Bs. " . number_format($prod[2], 2, ",", ".") ?></strike><br>
                                    <span><?php print "Bs. " . number_format($prod[10], 2, ",", "."); ?></span>
                                <?php } else { ?>
                                    <span><?php print "Bs. " . number_format($prod[2], 2, ",", "."); ?></span>
                                    <?php } ?>
                                <label>Cantidad:</label>
                                <input type="text" value="1">
                                <a href="">
                                    <i class="fa fa-star" title="Agregar a Favoritos"></i>
                                </a>
                                <a href="">
                                    <button type="button" class="btn btn-default cart">
                                        <i class="fa fa-shopping-cart"></i>
                                        Agregar al carrito
                                    </button>
                                </a>
                            </span>
                            <p><b>Disponibilidad:</b> <?php echo $prod[3]; ?> </p>
                            <p><b>Condicion: </b> <?php if ($prod[5] == 1) { echo "Nuevo";} else { echo "Usado";} ?></p>
                            <p><b>Marca: </b> 
                                <?php 
                                    echo strtoupper(substr($prod[8],0,1)); 
                                    echo substr($prod[8],1); 
                                ?></p>
                            <a href="">
                                <img src="views/images/product-details/share.png" class="share img-responsive"  alt="" />
                            </a>
                        </div><!--/Información del Producto-->
                    </div>
                </div><!--/Fin de Detalles del Producto-->

                    <div class="category-tab shop-details-tab"><!--Menu Secundario de Producto-->
                        <div class="col-sm-12">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#detalles" data-toggle="tab">Detalles</a></li>
                                <li><a href="#similares" data-toggle="tab">Productos Similares</a></li>
                                <!--<li><a href="#reviews" data-toggle="tab">Opiniones</a></li>-->
                            </ul>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane fade active in" id="detalles" >
                                <?php echo $prod[4]; ?>
                            </div>

                            <div class="tab-pane fade" id="similares" >
                                <div class="col-sm-4">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center men-thumb-item">
                                                <a href="">
                                                    <img src="views/images/productos/default.jpg" alt="" class="pro-image-front">
                                                </a> 
                                                <h2>5432</h2>
                                                <p>Similar</p>
                                                <a href="">
                                                    <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Agregar al Carrito</button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <h3>No Hay Producto Similar</h3>
                            </div>
                        </div>
                    </div><!--/category-tab-->
                <?php }
                    $db->close();
                 ?>
                <div class="recommended_items"><!--MAS VENDIDOS-->
                    <h2 class="title text-center">Productos Más Vendidos</h2>

                    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="item active">
                                <?php 
                                    $db = new Conexion();
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
                                                <a href="<?php echo '?view=detalles&mode=productos&id=' .$prod[0] ?>">
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
                                                <a href="" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Agregar al carrito</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php 
                                    }
                                    $db->close();
                                ?>
                            </div>
                            <div class="item">
                                <?php 
                                    $db = new Conexion();
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
                                                <a href="<?php echo '?view=detalles&mode=productos&id=' .$prod[0] ?>">
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
                                                <a href="" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Agregar al carrito</a>
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
