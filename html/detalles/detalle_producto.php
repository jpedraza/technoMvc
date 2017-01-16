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
                        <div class="view-product">
                            <img src="views/images/productos/default.jpg" alt="">
                                <!--<h3>ZOOM</h3>-->
                        </div>
                        <div id="similar-product" class="carousel slide" data-ride="carousel">
                            <!-- Otras Fotos del Articulo -->
                            <div class="carousel-inner">
                                <div class="item active">
                                    <a href=""><img src="views/images/productos/default.jpg" alt=""></a>
                                    <a href=""><img src="views/images/productos/default.jpg" alt=""></a>
                                    <a href=""><img src="views/images/productos/default.jpg" alt=""></a>
                                </div>
                                <div class="item">
                                    <a href=""><img src="views/images/productos/default.jpg" alt=""></a>
                                    <a href=""><img src="views/images/productos/default.jpg" alt=""></a>
                                    <a href=""><img src="views/images/productos/default.jpg" alt=""></a>
                                </div>
                                <div class="item">
                                    <a href=""><img src="views/images/productos/default.jpg" alt=""></a>
                                    <a href=""><img src="views/images/productos/default.jpg" alt=""></a>
                                    <a href=""><img src="views/images/productos/default.jpg" alt=""></a>
                                </div>  
                            </div>
                            <!-- Controls -->
                            <a class="left item-control" href="#similar-product" data-slide="prev">
                                <i class="fa fa-angle-left"></i>
                            </a>
                            <a class="right item-control" href="#similar-product" data-slide="next">
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="product-information"><!--/Información del Producto-->
                            <h2></h2>
                            <p>Código: <?php print '#000' ?></p>
                            <img src="views/images/product-details/rating.png" alt="">
                            <span>
                                <strike>584</strike><br>
                                <span>888</span>
                                <span><?php print "Bs. 777" ?></span>
                                <label>Cantidad:</label>
                                <input type="text" value="1">
                                <a href="">
                                    <i class="fa fa-star" title="Agregar a Favoritos"></i>
                                </a>
                                <a href="">
                                    <button type="button" class="btn btn-fefault cart">
                                        <i class="fa fa-shopping-cart"></i>
                                        Agregar al carrito
                                    </button>
                                </a>
                            </span>
                            <p><b>Disponibilidad: </b> </p>
                            <p><b>Condicion: </b></p>
                            <p><b>Marca: </b></p>
                            <a href="">
                                <img src="images/product-details/share.png" class="share img-responsive"  alt="" />
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
                                detallessdfdsfdasf
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
                                                <a href="detalleProducto.php?detalleProd=12">
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
                                                <a href="#">
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

</body>
</html>
