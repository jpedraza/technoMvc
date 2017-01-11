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
                <p>Aprovecha la promoci&oacute;n que traemos para ti, todo m&aacute;s barato que mercal.</p>
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
                <p>Aprovecha la promoci&oacute;n que traemos para ti, todo m&aacute;s barato que mercal.</p>
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
                <p>Aprovecha la promoci&oacute;n que traemos para ti, todo m&aacute;s barato que mercal.</p>
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
                <li><a href="#"> <span class="pull-right"></span>Nuevo</a></li>
                <li><a href="#"> <span class="pull-right"></span>Usado</a></li>
              </ul>
            </div>
          </div>
          <!--/PRODUCTO POR CONDICIÓN -->

          <div class="brands_products">
            <!--PRODUCTOS POR MARCA-->
            <h2>M&Aacute;S BUSCADOS</h2>
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
                <div class="features_items"><!--Productos Destacados-->
                    <h2 class="title text-center">Productos Recientes</h2>
                                            <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center men-thumb-item">
                                        <a href="detalleProducto.php?detalleProd=26">
                                            <img src="views/images/productos/wahl1.jpg" alt="Producto Destacado" class="pro-image-front">
                                            <h2>Bs. 29.999,00</h2>
                                            <p title="Afeitadora Wahl Beard Battery Trimmer">
                                            Afeitadora Wahl Beard Batt<b>....</b>                                             </p>
                                        </a>
                                        <a href="verificoSesion.php?idpro=26" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Agregar al carrito</a>                                                
                                    </div>
                                    <img src="views/images/home/new.png" class="new" alt="nuevo">
                                </div>
                                <div class="choose">
                                    <ul class="nav nav-pills nav-justified">
                                        <li><a href="verificoFavorito.php?idpro=26"><i class="fa fa-star"></i>Agregar a Favoritos</a></li>
                                        <li><a href="detalleProducto.php?detalleProd=26"><i class="fa fa-plus-square"></i>Ver Detalle</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                                            <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center men-thumb-item">
                                        <a href="detalleProducto.php?detalleProd=25">
                                            <img src="views/images/productos/destornilladorSecur.jpg" alt="Producto Destacado" class="pro-image-front">
                                            <h2>Bs. 2.950,00</h2>
                                            <p title="Kit De Destornilladores Para Abrir Celulares 21 Pcs + Pinza">
                                            Kit De Destornilladores Pa<b>....</b>                                             </p>
                                        </a>
                                        <a href="verificoSesion.php?idpro=25" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Agregar al carrito</a>                                                
                                    </div>
                                    <img src="views/images/home/new.png" class="new" alt="nuevo">
                                </div>
                                <div class="choose">
                                    <ul class="nav nav-pills nav-justified">
                                        <li><a href="verificoFavorito.php?idpro=25"><i class="fa fa-star"></i>Agregar a Favoritos</a></li>
                                        <li><a href="detalleProducto.php?detalleProd=25"><i class="fa fa-plus-square"></i>Ver Detalle</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                                            <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center men-thumb-item">
                                        <a href="detalleProducto.php?detalleProd=24">
                                            <img src="views/images/productos/destornillador1.jpg" alt="Producto Destacado" class="pro-image-front">
                                            <h2>Bs. 3.450,00</h2>
                                            <p title="Juego De Destornilladores 31 En 1 ">
                                            Juego De Destornilladores <b>....</b>                                             </p>
                                        </a>
                                        <a href="verificoSesion.php?idpro=24" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Agregar al carrito</a>                                                
                                    </div>
                                    <img src="views/images/home/new.png" class="new" alt="nuevo">
                                </div>
                                <div class="choose">
                                    <ul class="nav nav-pills nav-justified">
                                        <li><a href="verificoFavorito.php?idpro=24"><i class="fa fa-star"></i>Agregar a Favoritos</a></li>
                                        <li><a href="detalleProducto.php?detalleProd=24"><i class="fa fa-plus-square"></i>Ver Detalle</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                                            
                                    </div><!-- FIN Productos Destacados-->

                <div class="features_items"><!--Productos en Oferta-->
                    <h2 class="title text-center">Productos En Oferta</h2>
                                            <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center men-thumb-item">
                                        <a href="detalleProducto.php?detalleProd=1">
                                            <img src="views/images/productos/3ps2.jpg" alt="Producto Destacado" class="pro-image-front">
                                            <strike>Bs. 86.550,00</strike>
                                            <h2>Bs. 85.000,00</h2>
                                            <p title="Playstation 2 Slim 9001 | Chipeado">
                                            Playstation 2 Slim 9001 | <b>....</b>                                             </p>
                                        </a>
                                        <a href="verificoSesion.php?idpro=1" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Agregar al carrito</a>
                                    </div>
                                    <img src="views/images/home/sale.png" class="new" alt="oferta">
                                </div>
                                <div class="choose">
                                    <ul class="nav nav-pills nav-justified">
                                        <li><a href="verificoFavorito.php?idpro=1"><i class="fa fa-star"></i>Agregar a Favoritos</a></li>
                                        <li><a href="detalleProducto.php?detalleProd=1"><i class="fa fa-plus-square"></i>Ver Detalle</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                                            <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center men-thumb-item">
                                        <a href="detalleProducto.php?detalleProd=2">
                                            <img src="views/images/productos/wii.jpg" alt="Producto Destacado" class="pro-image-front">
                                            <strike>Bs. 62.999,00</strike>
                                            <h2>Bs. 61.000,00</h2>
                                            <p title="Nintendo Wii | Chipeado">
                                            Nintendo Wii | Chipeado                                            </p>
                                        </a>
                                        <a href="verificoSesion.php?idpro=2" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Agregar al carrito</a>
                                    </div>
                                    <img src="views/images/home/sale.png" class="new" alt="oferta">
                                </div>
                                <div class="choose">
                                    <ul class="nav nav-pills nav-justified">
                                        <li><a href="verificoFavorito.php?idpro=2"><i class="fa fa-star"></i>Agregar a Favoritos</a></li>
                                        <li><a href="detalleProducto.php?detalleProd=2"><i class="fa fa-plus-square"></i>Ver Detalle</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                                            <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center men-thumb-item">
                                        <a href="detalleProducto.php?detalleProd=5">
                                            <img src="views/images/productos/pso.jpg" alt="Producto Destacado" class="pro-image-front">
                                            <strike>Bs. 32.800,00</strike>
                                            <h2>Bs. 31.500,00</h2>
                                            <p title="Playstation 1 PsOne | Chipeado y Lente Óptico Nuevo">
                                            Playstation 1 PsOne | Chip<b>....</b>                                             </p>
                                        </a>
                                        <a href="verificoSesion.php?idpro=5" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Agregar al carrito</a>
                                    </div>
                                    <img src="views/images/home/sale.png" class="new" alt="oferta">
                                </div>
                                <div class="choose">
                                    <ul class="nav nav-pills nav-justified">
                                        <li><a href="verificoFavorito.php?idpro=5"><i class="fa fa-star"></i>Agregar a Favoritos</a></li>
                                        <li><a href="detalleProducto.php?detalleProd=5"><i class="fa fa-plus-square"></i>Ver Detalle</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
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
                                                            <div class="col-sm-3">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center men-thumb-item">
                                                <a href="detalleProducto.php?detalleProd=9">
                                                    <img src="views/images/productos/callghost.jpg" alt="Call Of Duty Ghost | Ps3" class="pro-image-front">
                                                    <h2>Bs. 20.000,00</h2>
                                                    <p>Call Of Duty Ghost | Ps3</p>
                                                </a>
                                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Agregar al carrito</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                                            <div class="col-sm-3">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center men-thumb-item">
                                                <a href="detalleProducto.php?detalleProd=14">
                                                    <img src="views/images/productos/callBlack.jpg" alt="Call of Duty: Black Ops III | PsVita" class="pro-image-front">
                                                    <h2>Bs. 10.990,00</h2>
                                                    <p>Call of Duty: Black Ops III | PsVita</p>
                                                </a>
                                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Agregar al carrito</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                                            <div class="col-sm-3">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center men-thumb-item">
                                                <a href="detalleProducto.php?detalleProd=15">
                                                    <img src="views/images/productos/killzone.jpg" alt="Killzone 3 | Ps3" class="pro-image-front">
                                                    <h2>Bs. 12.990,00</h2>
                                                    <p>Killzone 3 | Ps3</p>
                                                </a>
                                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Agregar al carrito</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                                    </div>
                        <!--Controles-->
                        <div class="tab-pane fade" id="controles" >
                                                            <div class="col-sm-3">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center men-thumb-item">
                                                <a href="detalleProducto.php?detalleProd=13">
                                                    <img src="views/images/productos/wii1.jpg" alt="Control Wii Remote Y Nunchuk Original" class="pro-image-front">
                                                    <h2>Bs. 39.999,00</h2>
                                                    <p>Control Wii Remote Y Nunchuk Original</p>
                                                </a>
                                                <a href="verificoSesion.php?idpro=13" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Agregar al carrito</a>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                                            <div class="col-sm-3">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center men-thumb-item">
                                                <a href="detalleProducto.php?detalleProd=18">
                                                    <img src="views/images/productos/controlGCube.jpg" alt="Control de Nintendo Gamecube / Nintendo Wii" class="pro-image-front">
                                                    <h2>Bs. 50.000,00</h2>
                                                    <p>Control de Nintendo Gamecube / Nintendo Wii</p>
                                                </a>
                                                <a href="verificoSesion.php?idpro=18" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Agregar al carrito</a>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                                            <div class="col-sm-3">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center men-thumb-item">
                                                <a href="detalleProducto.php?detalleProd=19">
                                                    <img src="views/images/productos/controlps3.jpg" alt="Control de Ps3 Dualshock Original" class="pro-image-front">
                                                    <h2>Bs. 14.950,00</h2>
                                                    <p>Control de Ps3 Dualshock Original</p>
                                                </a>
                                                <a href="verificoSesion.php?idpro=19" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Agregar al carrito</a>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                                    </div>
                        <!--Conectores-->
                        <div class="tab-pane fade" id="conectores" >
                                                            <div class="col-sm-3">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center men-thumb-item">
                                                <a href="detalleProducto.php?detalleProd=7">
                                                    <img src="views/images/productos/rca.jpg" alt="Cable 3RCA Audio Y Video 1.5metros" class="pro-image-front">
                                                    <h2>Bs. 490,00</h2>
                                                    <p>Cable 3RCA Audio Y Video 1.5metros</p>
                                                </a>
                                                <a href="verificoSesion.php?idpro=7" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Agregar al carrito</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                                            <div class="col-sm-3">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center men-thumb-item">
                                                <a href="detalleProducto.php?detalleProd=20">
                                                    <img src="views/images/productos/hdmi.jpg" alt="Cable Hdmi 1.5 Mt Full Hd 1080px" class="pro-image-front">
                                                    <h2>Bs. 1.850,00</h2>
                                                    <p>Cable Hdmi 1.5 Mt Full Hd 1080px</p>
                                                </a>
                                                <a href="verificoSesion.php?idpro=20" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Agregar al carrito</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                                    </div>
                        <!--Otros Productos-->
                        <div class="tab-pane fade" id="otrosPro" >
                                                            <div class="col-sm-3">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center men-thumb-item">
                                                <a href="detalleProducto.php?detalleProd=10">
                                                    <img src="views/images/productos/linterna3.jpg" alt="Linterna Recargable 3 Leds" class="pro-image-front">
                                                    <h2>Bs. 2.000,00</h2>
                                                    <p>Linterna Recargable 3 Leds</p>
                                                </a>
                                                <a href="verificoSesion.php?idpro=10" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Agregar al carrito</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                                            <div class="col-sm-3">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center men-thumb-item">
                                                <a href="detalleProducto.php?detalleProd=24">
                                                    <img src="views/images/productos/destornillador1.jpg" alt="Juego De Destornilladores 31 En 1 " class="pro-image-front">
                                                    <h2>Bs. 3.450,00</h2>
                                                    <p>Juego De Destornilladores 31 En 1 </p>
                                                </a>
                                                <a href="verificoSesion.php?idpro=24" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Agregar al carrito</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                                            <div class="col-sm-3">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center men-thumb-item">
                                                <a href="detalleProducto.php?detalleProd=25">
                                                    <img src="views/images/productos/destornilladorSecur.jpg" alt="Kit De Destornilladores Para Abrir Celulares 21 Pcs + Pinza" class="pro-image-front">
                                                    <h2>Bs. 2.950,00</h2>
                                                    <p>Kit De Destornilladores Para Abrir Celulares 21 Pcs + Pinza</p>
                                                </a>
                                                <a href="verificoSesion.php?idpro=25" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Agregar al carrito</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                                            <div class="col-sm-3">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center men-thumb-item">
                                                <a href="detalleProducto.php?detalleProd=26">
                                                    <img src="views/images/productos/wahl1.jpg" alt="Afeitadora Wahl Beard Battery Trimmer" class="pro-image-front">
                                                    <h2>Bs. 29.999,00</h2>
                                                    <p>Afeitadora Wahl Beard Battery Trimmer</p>
                                                </a>
                                                <a href="verificoSesion.php?idpro=26" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Agregar al carrito</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                                    </div>
                    </div>
                </div><!--/FIN DE PESTAÑA DE CATEGORIA-->

                <div class="recommended_items"><!--MAS VENDIDOS-->
                    <h2 class="title text-center">Productos M&aacute;s Vendidos</h2>

                    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="item active">
                                                                        
                                    <div class="col-sm-4">
                                        <div class="product-image-wrapper">
                                            <div class="single-products">
                                                <div class="productinfo text-center men-thumb-item">
                                                    <a href="detalleProducto.php?detalleProd=12">
                                                        <img src="views/images/productos/bateriaAa.jpg" alt="Bateria Duracell AA | Paquete de 2" class="pro-image-front">
                                                        <h2>Bs. 2.600,00</h2>
                                                        <p>Bateria Duracell AA | Paquete de 2</p>
                                                    </a>
                                                    <a href="verificoSesion.php?idpro=12" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Agregar al carrito</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                                                        
                                    <div class="col-sm-4">
                                        <div class="product-image-wrapper">
                                            <div class="single-products">
                                                <div class="productinfo text-center men-thumb-item">
                                                    <a href="detalleProducto.php?detalleProd=20">
                                                        <img src="views/images/productos/hdmi.jpg" alt="Cable Hdmi 1.5 Mt Full Hd 1080px" class="pro-image-front">
                                                        <h2>Bs. 1.850,00</h2>
                                                        <p>Cable Hdmi 1.5 Mt Full Hd 1080px</p>
                                                    </a>
                                                    <a href="verificoSesion.php?idpro=20" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Agregar al carrito</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                                                        
                                    <div class="col-sm-4">
                                        <div class="product-image-wrapper">
                                            <div class="single-products">
                                                <div class="productinfo text-center men-thumb-item">
                                                    <a href="detalleProducto.php?detalleProd=24">
                                                        <img src="views/images/productos/destornillador1.jpg" alt="Juego De Destornilladores 31 En 1 " class="pro-image-front">
                                                        <h2>Bs. 3.450,00</h2>
                                                        <p>Juego De Destornilladores 31 En 1 </p>
                                                    </a>
                                                    <a href="verificoSesion.php?idpro=24" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Agregar al carrito</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                                            </div>
                            <div class="item">
                                    
                                    <div class="col-sm-4">
                                        <div class="product-image-wrapper">
                                            <div class="single-products">
                                                <div class="productinfo text-center men-thumb-item">
                                                    <a href="detalleProducto.php?detalleProd=17">
                                                        <img src="views/images/productos/directv.jpg" alt="Control de Directv Universal" class="pro-image-front">
                                                        <h2>Bs. 8.980,00</h2>
                                                        <p>Control de Directv Universal</p>
                                                    </a>
                                                    <a href="verificoSesion.php?idpro=17" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Agregar al carrito</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-sm-4">
                                        <div class="product-image-wrapper">
                                            <div class="single-products">
                                                <div class="productinfo text-center men-thumb-item">
                                                    <a href="detalleProducto.php?detalleProd=21">
                                                        <img src="views/images/productos/plusaudio.jpg" alt="Cable Auxiliar Plus 3.5mm 1.5m Estereo Macho A Macho" class="pro-image-front">
                                                        <h2>Bs. 1.250,00</h2>
                                                        <p>Cable Auxiliar Plus 3.5mm 1.5m Estereo Macho A Macho</p>
                                                    </a>
                                                    <a href="verificoSesion.php?idpro=21" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Agregar al carrito</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-sm-4">
                                        <div class="product-image-wrapper">
                                            <div class="single-products">
                                                <div class="productinfo text-center men-thumb-item">
                                                    <a href="detalleProducto.php?detalleProd=22">
                                                        <img src="views/images/productos/35-rca.jpg" alt="Conector De Audio 3.5 Mm Macho A 2 Rca Hembra" class="pro-image-front">
                                                        <h2>Bs. 590,00</h2>
                                                        <p>Conector De Audio 3.5 Mm Macho A 2 Rca Hembra</p>
                                                    </a>
                                                    <a href="verificoSesion.php?idpro=22" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Agregar al carrito</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
