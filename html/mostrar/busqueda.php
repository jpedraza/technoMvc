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
                        Busqueda
                    </h2>
                                                
                </div><!-- FIN Productos Destacados-->
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