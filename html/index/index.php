<?php include(HTML_DIR . 'overall/header.php'); ?>

<body>
<section class="engine"><a rel="nofollow" href="#"><?php echo APP_TITLE ?></a></section>


<?php include(HTML_DIR . '/overall/topnav.php'); ?>

<section>
  <div class="container">
    <?php
      if(isset($_GET['success'])) {
        echo '<div class="alert alert-dismissible alert-success">
        <strong>Activado!</strong> tu usuario ha sido activado correctamente.
        </div>';
      }

      if(isset($_GET['error'])) {
        echo '<div class="alert alert-dismissible alert-danger">
        <strong>Error!</strong></strong> no se ha podido activar tu usuario.
        </div>';
      }
    ?>

    <div class="row container">
      <div class="col-sm-12">
        <div id="slider-carousel" class="carousel slide" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
            <li data-target="#slider-carousel" data-slide-to="1"></li>
            <li data-target="#slider-carousel" data-slide-to="2"></li>
          </ol>
          
          <div class="carousel-inner">
            <div class="item active">
              <div class="col-sm-6">
                <h1><span>Techno</span>tronic</h1>
                <h2>Ofertas del mes</h2>
                <p>Aprovecha la promoción que traemos para ti, todo más barato que mercal.</p>
                <button type="button" class="btn btn-default get">Aprovecha ya</button>
              </div>
              <div class="col-sm-6">
                <img src="views/images/home/1.png" class="girl img-responsive" alt="ofertas">
                <img src="views/images/home/oferta.png"  class="pricing" alt="oferta">
              </div>
            </div>
            <div class="item">
              <div class="col-sm-6">
                <h1><span>Techno</span>tronic</h1>
                <h2>Ofertas del mes</h2>
                <p>Aprovecha la promoción que traemos para ti, todo más barato que mercal.</p>
                <button type="button" class="btn btn-default get">Aprovecha ya</button>
              </div>
              <div class="col-sm-6">
                <img src="views/images/home/2.jpg" class="girl img-responsive" alt="ofertas">
                <img src="views/images/home/oferta.png"  class="pricing" alt="oferta">
              </div>
            </div>          
            <div class="item">
              <div class="col-sm-6">
                <h1><span>Techno</span>tronic</h1>
                <h2>Ofertas del mes</h2>
                <p>Aprovecha la promoción que traemos para ti, todo más barato que mercal.</p>
                <button type="button" class="btn btn-default get">Aprovecha ya</button>
              </div>
              <div class="col-sm-6">
                <img src="views/images/home/3.png" class="girl img-responsive" alt="ofertas">
                <img src="views/images/home/oferta.png" class="pricing" alt="oferta">
              </div>
            </div>          
          </div>
          <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
            <i class="fa fa-angle-left"></i>
          </a>
          <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
            <i class="fa fa-angle-right"></i>
          </a>
        </div>      
      </div>
    </div>
  </div>
</section><br />
<!--/slider-->

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
        </div>
      </div>

            <!--SECCION CENTRAL DE LA PAGINA-->
            <div class="col-sm-9 padding-right">
                <div class="features_items"><!--Productos Destacados-->
                    <h2 class="title text-center">Productos Recientes</h2>
                    <?php
                if(isset($_GET['carro']) and $_GET['carro'] == true) {
                    echo 
                    '<div class="alert alert-dismissible alert-success"> 
                        Agregaste con éxito el producto al carrito.
                    </div>';
                } else if(isset($_GET['carro']) and $_GET['carro'] == false) {
                    echo  
                    '<div class="alert alert-dismissible alert-danger"> 
                        No agregaste el producto al carrito.
                    </div>';
                }
            ?>

            
                      <?php 
                        $db = new Conexion();
                        $sql_new = $db->query(
                          "SELECT
                            id,
                            foto1,
                            precio,
                            nombre,
                            oferta,
                            precio_oferta
                          FROM
                            productos
                          ORDER BY
                          id DESC
                          LIMIT
                           3;")
                        ;
                        while ($nuevos = $sql_new->fetch_row()) {
                      ?>
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
                                            <a href="?view=carrito&mode=add&producto=<?php echo $nuevos[0] ?>" class="btn btn-default add-to-cart">
                                                <i class="fa fa-shopping-cart"></i>Agregar al carrito
                                            </a>
                                        </div>
                                        <img src="views/images/home/new.png" class="new" alt="nuevo">
                                    </div>
                                    <div class="choose">
                                        <ul class="nav nav-pills nav-justified">
                                            <li>
                                                <a href="#">
                                                    <i class="fa fa-star"></i>Agregar a Favoritos
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="fa fa-plus-square"></i>Ver Detalle
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        <?php 
                        }
                        $db->close();
                        ?>                                            
                </div><!-- FIN Productos Destacados-->

                <div class="features_items"><!--Productos en Oferta-->
                    <h2 class="title text-center">Productos En Oferta</h2>
                      <?php 
                        $db = new Conexion();
                        $sql_sale = $db->query(
                            "SELECT
                                id,
                                foto1,
                                precio,
                                precio_oferta,
                                nombre
                            FROM
                                productos
                            WHERE
                                oferta=1
                            ORDER BY
                            id DESC
                            LIMIT
                            3;")
                        ;
                        while ($oferta = $sql_sale->fetch_row()) {
                      ?>
                            <div class="col-sm-4">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center men-thumb-item">
                                            <?php echo 
                                            '<a href="detalles/'. UrlAmigable($oferta[0], $_productos[$oferta[0]]['nombre']) . '">'; ?>
                                                <img src="<?php echo URL_PRODUCTOS . $oferta[1]; ?>" alt="<?php echo $oferta[4]; ?>" class="pro-image-front">
                                                <strike><?php echo number_format($oferta[2],2,",","."); ?></strike>
                                                <h2><?php echo number_format($oferta[3],2,",","."); ?></h2>
                                                <p class="product-name" title="<?php echo $oferta[4]; ?>">
                                                    <?php 
                                                    if (strlen($oferta[4]) > 50) {
                                                        echo substr($oferta[4],0,47);
                                                        echo "...";
                                                    } else {
                                                        echo $oferta[4];
                                                    }
                                                    ?>           
                                                </p>
                                            </a>
                                            <a href="#" class="btn btn-default add-to-cart">
                                                <i class="fa fa-shopping-cart"></i>Agregar al carrito
                                            </a>                                                
                                        </div>
                                        <img src="views/images/home/sale.png" class="new" alt="oferta">
                                    </div>
                                    <div class="choose">
                                        <ul class="nav nav-pills nav-justified">
                                            <li>
                                                <a href="#">
                                                    <i class="fa fa-star"></i>Agregar a Favoritos
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="fa fa-plus-square"></i>Ver Detalle
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        <?php 
                        }
                        $db->close();
                        ?>                        
                </div><!-- FIN Productos en Oferta-->

                <div class="category-tab"><!--PESTAÑA DE CATEGORIA-->
                    <div class="col-sm-12">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#juegos" data-toggle="tab">Juegos</a></li>
                            <li><a href="#controles" data-toggle="tab">Controles</a></li>
                            <li><a href="#conectores" data-toggle="tab">Conectores</a></li>
                            <li><a href="#otrosPro" data-toggle="tab">Otros Productos</a></li>
                        </ul>
                    </div>
                    <!--Contenido-->
                    <div class="tab-content">
                        <!--Juegos-->
                        <div class="tab-pane fade active in" id="juegos" >
                             <?php 
                                $db = new Conexion();
                                $sql = $db->query(
                                    "SELECT
                                        id,
                                        foto1,
                                        precio,
                                        oferta,
                                        precio_oferta,
                                        nombre
                                    FROM
                                        productos
                                    WHERE
                                        id_subcategoria=15
                                    ORDER BY
                                    id DESC
                                    LIMIT
                                    3;")
                                ;
                                while ($prod = $sql->fetch_row()) {
                              ?>
                            <div class="col-sm-3">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center men-thumb-item">
                                            <?php echo 
                                            '<a href="detalles/'. UrlAmigable($prod[0], $_productos[$prod[0]]['nombre']) . '">'; ?>
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
                                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Agregar al carrito</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php 
                                }
                                $db->close();
                            ?>                                    
                        </div>
                        <!--Controles-->
                        <div class="tab-pane fade" id="controles" >
                             <?php 
                                $db = new Conexion();
                                $sql = $db->query(
                                    "SELECT
                                        id,
                                        foto1,
                                        precio,
                                        oferta,
                                        precio_oferta,
                                        nombre
                                    FROM
                                        productos
                                    WHERE
                                        id_subcategoria=16
                                    ORDER BY
                                    id DESC
                                    LIMIT
                                    3;")
                                ;
                                while ($prod = $sql->fetch_row()) {
                              ?>
                            <div class="col-sm-3">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center men-thumb-item">
                                            <?php echo 
                                            '<a href="detalles/'. UrlAmigable($prod[0], $_productos[$prod[0]]['nombre']) . '">'; ?>
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
                                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Agregar al carrito</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php 
                                }
                                $db->close();
                            ?> 
                        </div>
                        <!--Conectores-->
                        <div class="tab-pane fade" id="conectores" >
                             <?php 
                                $db = new Conexion();
                                $sql = $db->query(
                                    "SELECT
                                        id,
                                        foto1,
                                        precio,
                                        oferta,
                                        precio_oferta,
                                        nombre
                                    FROM
                                        productos
                                    WHERE
                                        id_subcategoria=5
                                    ORDER BY
                                    id DESC
                                    LIMIT
                                    3;")
                                ;
                                while ($prod = $sql->fetch_row()) {
                              ?>
                            <div class="col-sm-3">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center men-thumb-item">
                                            <?php echo 
                                            '<a href="detalles/'. UrlAmigable($prod[0], $_productos[$prod[0]]['nombre']) . '">'; ?>
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
                                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Agregar al carrito</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php 
                                }
                                $db->close();
                            ?> 
                        </div>
                        <!--Otros Productos-->
                        <div class="tab-pane fade" id="otrosPro" >
                                 <?php 
                                $db = new Conexion();
                                $sql = $db->query(
                                    "SELECT
                                        id,
                                        foto1,
                                        precio,
                                        oferta,
                                        precio_oferta,
                                        nombre
                                    FROM
                                        productos
                                    WHERE
                                        id_subcategoria=12
                                    ORDER BY
                                    id DESC
                                    LIMIT
                                    3;")
                                ;
                                while ($prod = $sql->fetch_row()) {
                              ?>
                            <div class="col-sm-3">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center men-thumb-item">
                                            <?php echo 
                                            '<a href="detalles/'. UrlAmigable($prod[0], $_productos[$prod[0]]['nombre']) . '">'; ?>
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
                                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Agregar al carrito</a>
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
                </div><!--/FIN DE PESTAÑA DE CATEGORIA-->

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
                                                <?php echo 
                                                '<a href="detalles/'. UrlAmigable($prod[0], $_productos[$prod[0]]['nombre']) . '">'; ?>
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
                                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Agregar al carrito</a>
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
                                                <?php echo 
                                                '<a href="detalles/'. UrlAmigable($prod[0], $_productos[$prod[0]]['nombre']) . '">'; ?>
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
                                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Agregar al carrito</a>
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
