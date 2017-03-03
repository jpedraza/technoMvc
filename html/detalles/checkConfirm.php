<?php include(HTML_DIR . 'overall/header.php'); ?>

<body>
<section class="engine"><a rel="nofollow" href="#"><?php echo APP_TITLE ?></a></section>


<?php include(HTML_DIR . '/overall/topnav.php'); ?>

<section>
    <!--PAGINA DE COMPRA-->
    <div id="contact-page" class="container">
        <div class="bg">
            <div class="row">           
                <div class="col-sm-12">                         
                    <h2 class="title text-center">Confirmar Compra</h2>
                    <?php 
                    $datosCompra = unserialize($_SESSION['checkout']); ?>
                    Llego aquí la redirección <?php echo $datosCompra['nombre']; var_dump($_SESSION['checkout']) ?>
                </div>
            </div>
        </div>  
    </div>
    <!--/FIN DE PAGINA DE COMPRA-->
</section>
<?php include(HTML_DIR . 'overall/footer.php'); ?>

</body>
</html>