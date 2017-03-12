<?php include(HTML_DIR . 'overall/header.php'); ?>

<body>
<section class="engine"><a rel="nofollow" href="#"><?php echo APP_TITLE ?></a></section>


<?php include(HTML_DIR . '/overall/topnav.php'); ?>

<section>
    <!--PAGINA DE COMPRA-->
    <div id="contact-page" class="container">
        <div class="bg">
            <div class="row">
                <!-- INICIO DEL CUERPO DE LA PÁGINA -->
                <?php 
                    $datosCompra = unserialize($_SESSION['checkout']);
                    switch ($datosCompra['tipoPago']) {
                        case 'mercadopago':
                            echo 
                            '<div class="col-sm-12">
                                <div class="contact-form">
                                    <h2 class="title text-center">¡Compra Exitosa!</h2>
                                    <div class="contentpanel table-responsive">
                                        <h4>Pagaste con Mercado Pago</h4>
                                    </div>
                                </div>
                            </div>';
                        break;
                        case 'transferencia':
                            echo 
                            '<div class="col-sm-12">
                                <div class="contact-form">
                                    <h2 class="title text-center">¡Compra Exitosa!</h2>
                                    <div class="contentpanel"><br />
                                        <p class="justificado"> 
                                            Gracias por preferirnos, a continuación le remito detalles para efectuar el deposito o la transferencia bancaría, cabe destacar que tiene 3 días habiles para efectuar y confirmar su pago, a través de nuestros telefonos: '. TELEFONO .' o nuestro correo electrónico: <a href="mailto:'.CORREO_PAGO .'">'.CORREO_PAGO.'.</a>
                                        </p><br />
                                    </div>
                                    <h4>Datos Bancarios</h4><br />
                                    <div class="contentpanel table-responsive">  
                                        <table class="table table-condensed">
                                            <thead>
                                                <th> 
                                                    Banco
                                                </th>
                                                <th> 
                                                    Número de Cuenta
                                                </th>
                                                <th> 
                                                    Tipo de Cuenta
                                                </th>
                                                <th> 
                                                    A nombre de
                                                </th>
                                                <th> 
                                                    Cédula
                                                </th>
                                                <th> 
                                                    E-mail
                                                </th>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td style="vertical-align:middle;">
                                                        <img src="views/app/images/logo-bancos/mercantil.png" title="Banco" width="100px" height="80px">
                                                    </td>
                                                    <td style="vertical-align:middle;">
                                                        0105-0123-4567-8911-2345
                                                    </td>
                                                    <td style="vertical-align:middle;">
                                                        Corriente
                                                    </td>
                                                    <td style="vertical-align:middle;">
                                                        Will Smitch
                                                    </td>
                                                    <td style="vertical-align:middle;">
                                                        12.345.678
                                                    </td>
                                                    <td style="vertical-align:middle;">'.
                                                        CORREO_PAGO .'
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="vertical-align:middle;">
                                                        <img src="views/app/images/logo-bancos/banesco.png" title="Banco" width="100px" height="80px">
                                                    </td>
                                                    <td style="vertical-align:middle;">
                                                        0134-0123-4567-8911-2345
                                                    </td>
                                                    <td style="vertical-align:middle;">
                                                        Ahorro
                                                    </td>
                                                    <td style="vertical-align:middle;">
                                                        Will Smitch
                                                    </td>
                                                    <td style="vertical-align:middle;">
                                                        12.345.678
                                                    </td>
                                                    <td style="vertical-align:middle;">'.
                                                        CORREO_PAGO .'
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="vertical-align:middle;">
                                                        <img src="views/app/images/logo-bancos/venezuela.png" title="Banco" width="100px" height="80px">
                                                    </td>
                                                    <td style="vertical-align:middle;">
                                                        0102-0123-4567-8911-2345
                                                    </td>
                                                    <td style="vertical-align:middle;">
                                                        Ahorro
                                                    </td>
                                                    <td style="vertical-align:middle;">
                                                        Will Smitch
                                                    </td>
                                                    <td style="vertical-align:middle;">
                                                        12.345.678
                                                    </td>
                                                    <td style="vertical-align:middle;">'.
                                                        CORREO_PAGO .'
                                                    <
                                                <tr>
                                                    <td style="vertical-align:middle;">
                                                        <img src="views/app/images/logo-bancos/provincial.png" title="Banco" width="100px" height="80px">
                                                    </td>
                                                    <td style="vertical-align:middle;">
                                                        0108-0123-4567-8911-2345
                                                    </td>
                                                    <td style="vertical-align:middle;">
                                                        Corriente
                                                    </td>
                                                    <td style="vertical-align:middle;">
                                                        Will Smitch
                                                    </td>
                                                    <td style="vertical-align:middle;">
                                                        12.345.678
                                                    </td>
                                                    <td style="vertical-align:middle;">'.
                                                        CORREO_PAGO .'
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>';
                        break;
                        case 'efectivo':
                            echo 
                            '<div class="col-sm-12">
                                <div class="contact-form">
                                    <h2 class="title text-center">¡Compra Exitosa!</h2>
                                    <div class="contentpanel"><br />
                                        <p class="justificado"> 
                                            Gracias por preferirnos, a continuación le remito detalles para efectuar el pago en efectivo, cabe destacar que tiene 3 días habiles para efectuar su pago y retirar su producto en nuestra tienda ubicada en:
                                        </p><br />
                                        <p>
                                            <b>'.DIRECCION_TIENDA .'</b>.
                                        </p><br />
                                        <p class="justificado"> 
                                            Cualquier información o duda puede efectuarla a través de nuestros telefonos: '. TELEFONO .' / '. CELULAR .' o nuestro correo electrónico: <a href="mailto:'.CORREO_PAGO .'">'.CORREO_PAGO.'.</a>
                                        </p><br />
                                    </div>
                                    <h4>Ubicación en el Mapa</h4>
                                    <iframe class="contact-map" src="https://www.google.com/maps/embed?pb=!1m23!1m12!1m3!1d3925.74555622869!2d-66.37574706711685!3d10.282073781813889!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m8!3e6!4m0!4m5!1s0x8c2b0e54fa3b7291%3A0xc2efda86e00413fc!2sCalle+Las+Clavellinas%2C+Caucagua%2C+Miranda%2C+Venezuela!3m2!1d10.2842459!2d-66.37767149999999!5e0!3m2!1ses-419!2s!4v1467674296035" frameborder="0" style="border:0" allowfullscreen></iframe>
                                </div>
                            </div>';
                        break;
                        case 'debito':
                            echo 
                            '<div class="col-sm-12">
                                <div class="contact-form">
                                    <h2 class="title text-center">¡Compra Exitosa!</h2>
                                    <div class="contentpanel"><br />
                                        <p class="justificado"> 
                                            Gracias por preferirnos, a continuación le remito detalles para efectuar el pago en debito, cabe destacar que tiene 3 días habiles para efectuar su pago y retirar su producto en nuestra tienda ubicada en:
                                        </p><br />
                                        <p>
                                            <b>'.DIRECCION_TIENDA .'</b>.
                                        </p><br />
                                        <p class="justificado"> 
                                            En el mismo orden de ideas, no se acepta ningún pago con tarjeta de debito sin estar presente el titular con su respectiva cédula de identidad o algún documento que lo acredite como titular de la misma. Cabe destacar que el pago con tarjeta de crédito es solo a tráves de MercadoPago ya que no aceptamos pagos con tarjetas de crédito en nuestra tienda sin excepción. <br/>Cualquier información o duda puede efectuarla a través de nuestros telefonos: '. TELEFONO .' / '. CELULAR .' o nuestro correo electrónico: <a href="mailto:'.CORREO_PAGO .'">'.CORREO_PAGO.'.</a>
                                        </p><br />
                                    </div>
                                    <h4>Ubicación en el Mapa</h4>
                                    <iframe class="contact-map" src="https://www.google.com/maps/embed?pb=!1m23!1m12!1m3!1d3925.74555622869!2d-66.37574706711685!3d10.282073781813889!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m8!3e6!4m0!4m5!1s0x8c2b0e54fa3b7291%3A0xc2efda86e00413fc!2sCalle+Las+Clavellinas%2C+Caucagua%2C+Miranda%2C+Venezuela!3m2!1d10.2842459!2d-66.37767149999999!5e0!3m2!1ses-419!2s!4v1467674296035" frameborder="0" style="border:0" allowfullscreen></iframe>
                                </div>
                            </div>';
                        break;                  
                        default:
                            echo 
                            '<div class="col-sm-12">
                                <div class="contact-form">
                                    <h2 class="title text-center">¡Compra Exitosa!</h2>
                                    <div class="contentpanel"><br />
                                        <p class="justificado"> 
                                            Gracias por preferirnos, a continuación le remito detalles para efectuar el pago en efectivo o debito en nuestro local, cabe destacar que tiene 3 días habiles para efectuar su pago y retirar su producto en nuestra tienda ubicada en:
                                        </p><br />
                                        <p>
                                            <b>'.DIRECCION_TIENDA .'</b>.
                                        </p><br />
                                        <p class="justificado"> 
                                            Cualquier información o duda puede efectuarla a través de nuestros telefonos: '. TELEFONO .' / '. CELULAR .' o nuestro correo electrónico: <a href="mailto:'.CORREO_PAGO .'">'.CORREO_PAGO.'.</a>
                                        </p><br />
                                    </div>
                                    <h4>Ubicación en el Mapa</h4>
                                    <iframe class="contact-map" src="https://www.google.com/maps/embed?pb=!1m23!1m12!1m3!1d3925.74555622869!2d-66.37574706711685!3d10.282073781813889!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m8!3e6!4m0!4m5!1s0x8c2b0e54fa3b7291%3A0xc2efda86e00413fc!2sCalle+Las+Clavellinas%2C+Caucagua%2C+Miranda%2C+Venezuela!3m2!1d10.2842459!2d-66.37767149999999!5e0!3m2!1ses-419!2s!4v1467674296035" frameborder="0" style="border:0" allowfullscreen></iframe>
                                </div>
                            </div>';
                        break;
                    } 
                ?>
            <!-- FIN DEL CUERPO DE LA PÁGINA -->
            </div>
        </div>  
    </div>
    <!--/FIN DE PAGINA DE COMPRA-->
</section>

<script src=views/app/js/checkout.js></script>
<?php include(HTML_DIR . 'overall/footer.php'); ?>

</body>
</html>

