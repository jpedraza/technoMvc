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
                ?>
                <div class="col-sm-8">
                    <div class="contact-form">
                        <h2 class="title text-center">Confirmar Pago</h2>
                        <div class="contentpanel table-responsive">
                            <h4>Pago y Envío</h4>
                            <table class="table table-condensed">
                                <tbody>
                                    <tr>
                                        <td style="text-align:justify; width: 5%">
                                            <small><b>Comprador:</b></small><br />
                                            <small><b>Cédula:</b></small><br />
                                            <small><b>Email:</b></small><br />
                                            <small><b>Teléfono:</b></small><br />
                                            <small><b>Teléfono 2:</b></small><br />
                                            <small><b>C. Postal:</b></small><br />
                                        </td>
                                        <td style="text-align:justify; width: 30%">
                                            <?php 
                                                $datosCompra['telefono1'] != "" ? $tlfOpcional = $datosCompra['telefono1'] : $tlfOpcional = "Sin Información";
                                                echo 
                                                '<small>'. $datosCompra['nombre'] . ' '. $datosCompra['apellido'] . '</small><br />'.
                                                '<small>'. $datosCompra['cedula'] . '</small><br />'.
                                                '<small>'. $datosCompra['email']. '</small><br />'.
                                                '<small>'. $datosCompra['telefono']. '</small><br />'.
                                                '<small>'. $tlfOpcional. '</small><br />'.
                                                '<small>'. $datosCompra['postal']. '</small><br />';
                                            ?>
                                        </td>                                        
                                        <td style="text-align:justify; width: 5%">
                                            <small><b>País:</b></small><br />
                                            <small><b>Estado:</b></small><br />
                                            <small><b>Municipio:</b></small><br />
                                            <small><b>Av/Calle:</b></small><br />
                                            <small><b>Edif/Casa:</b></small><br />
                                            <small><b>Fecha:</b></small><br />
                                        </td>
                                        <td style="text-align:just}; width: 55%">
                                            <?php
                                                $datosCompra['pais'] == 1 ? $pais = "Venezuela" : "Exterior";
                                                /**
                                                 * Para mostrar el valor del estado en String
                                                 */
                                                switch ($datosCompra['estado']) {
                                                    case '1':
                                                        $estado = "Amazonas";
                                                        break;
                                                    case '2':
                                                        $estado = "Anzoátegui";
                                                         break;
                                                    case '3':
                                                        $estado = "Apure";
                                                         break;
                                                    case '4':
                                                        $estado = "Aragua";
                                                         break;
                                                    case '5':
                                                        $estado = "Barinas";
                                                         break;
                                                    case '6':
                                                        $estado = "Bolívar";
                                                         break;
                                                    case '7':
                                                        $estado = "Carabobo";
                                                         break;
                                                    case '8':
                                                        $estado = "Cojedes";
                                                         break;
                                                    case '9':
                                                        $estado = "Delta Amacuro";
                                                         break;
                                                    case '10':
                                                        $estado = "Dpnd. Federales";
                                                         break;
                                                    case '11':
                                                        $estado = "Distrito Capital";
                                                         break;
                                                    case '12':
                                                        $estado = "Falcón";
                                                         break;
                                                    case '13':
                                                        $estado = "Guárico";
                                                         break;
                                                    case '14':
                                                        $estado = "Lara";
                                                         break;
                                                    case '15':
                                                        $estado = "Mérida";
                                                         break;
                                                    case '16':
                                                        $estado = "Miranda";
                                                         break;
                                                    case '17':
                                                        $estado = "Monagas";
                                                         break;
                                                    case '18':
                                                        $estado = "Nueva Esparta";
                                                         break;
                                                    case '19':
                                                        $estado = "Portuguesa";
                                                         break;
                                                    case '20':
                                                        $estado = "Sucre";
                                                         break;
                                                    case '21':
                                                        $estado = "Táchira";
                                                         break;
                                                    case '22':
                                                        $estado = "Trujillo";
                                                         break;
                                                    case '23':
                                                        $estado = "Vargas";
                                                         break;
                                                    case '24':
                                                        $estado = "Yaracuy";
                                                         break;
                                                    case '25':
                                                        $estado = "Zulia";
                                                         break;
                                                    default:
                                                         $estado = "Gran Caracas";
                                                         break;
                                                } 
                                                echo 
                                                '<small>'. $pais . '</small><br />'.
                                                '<small>'. $estado . '</small><br />'.
                                                '<small>'. $datosCompra['municipio'] . '</small><br />'.
                                                '<small>'. $datosCompra['calle']. '</small><br />'.
                                                '<small>'. $datosCompra['edificio']. '</small><br />'.
                                                '<small>'. date("d-m-Y"). '</small><br />';
                                            ?>
                                        </td>
                                        <td style="text-align:center; width: 5%">
                                            <b> Forma de Pago </b><br />
                                            <?php echo 
                                                '<small>'
                                                    . strtoupper(substr($datosCompra['tipoPago'],0,1)) 
                                                    . strtolower(substr($datosCompra['tipoPago'],1)). 
                                                '</small><br />'; ?>
                                        <td style="vertical-align:middle; width: 3%">
                                            <a class="pull-right btn btn-default btn-xs" href="Procesar-Compra/">
                                                <i class="fa fa-edit"></i>
                                                Modificar                        
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div><br />
                        <div class="contentpanel table-responsive">
                            <h4>Productos en tu carro de compras
                                <a class="pull-right btn btn-default btn-xs" href="carrito/">
                                    <i class="fa fa-cart-plus"></i>
                                        Modificar
                                </a>
                            </h4>
                            <table class="table confirm_products">
                                <tbody>
                                <?php
                                    $db = new Conexion();
                                    $sql = $db->query(
                                        "SELECT
                                            id_producto,
                                            cantidad,
                                            id
                                        FROM
                                            carrito
                                        WHERE
                                            id_usuario='$_SESSION[app_id]';");
                                        $cantidadPrd = $db->rows($sql);
                                        $idCarrito   = $_SESSION['app_id'];
                                    $subtotal = 0;
                                    $HTML   = "";
                                    $subtotal = 0;
                                    /**
                                     * [$costoEnvio determina el costo del envio (Nacional o Local)]
                                     * @var [String]
                                     */
                                    $estado != "Distrito Capital" ? $costoEnvio = COSTO_ENVIO_NACIONAL : $costoEnvio = COSTO_ENVIO_LOCAL;                              
                                        while($data = $db->recorrer($sql)) {
                                            $precio     = ($_productos[$data[0]]['oferta'] == 1) ? $_productos[$data[0]]['precio_oferta']: $_productos[$data[0]]['precio'];
                                            $subtotal  += ($precio * $data[1]);
                                            $total      = $costoEnvio + $subtotal;
                                            $HTML .= 
                                            '<tr>
                                                <td style="text-align:center; width: 10%">
                                                    <a href="detalles/'. UrlAmigable($data[0], $_productos[$data[0]]['nombre']) . '">
                                                        <img src="'.URL_PRODUCTOS. $_productos[$data[0]]['foto1'].'" alt="'.$_productos[$data[0]]['nombre'].'" width="70" height="70">
                                                    </a>
                                                </td>
                                                <td style="text-align:center; vertical-align:middle; width: 40%">
                                                    <a href="detalles/'. UrlAmigable($data[0], $_productos[$data[0]]['nombre']) . '">
                                                        <small>'.$_productos[$data[0]]['nombre'].'</small>
                                                    </a>
                                                </td>
                                                <td style="text-align:center; vertical-align:middle; width: 10%">
                                                    <small>Bs. '.number_format($precio,2,",",".").'</small>
                                                </td>
                                                <td style="text-align:center; vertical-align:middle; width: 10%">
                                                    <small>'.$data[1].'</small>
                                                </td>
                                                <td style="text-align:center; vertical-align:middle; width: 10%">
                                                    <small>Bs. '. number_format($precio * $data[1],2,",",".").'</small>
                                                </td>
                                            </tr>';
                                        }
                                        echo $HTML;
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="row confirm_total">
                            <div class="col-md-12 payment_confirmation">
                                <div id="payment">
                                    <div class="form-group action-buttons">
                                        <div class="col-md-12">
                                            <button id="checkout_btn" onclick="confirmSubmit();" class="btn btn-success lock-on-click" title="Confirmar Orden" data-loading-text="<i class='fa fa-refresh fa-spin'></i>">
                                                <i class="fa fa-check-square"></i>
                                                Confirmar Orden
                                            </button>
                                        </div>
                                        <!-- <script type="text/javascript">
                                            function confirmSubmit() {
                                                $('body').css('cursor','wait');
                                                $.ajax({
                                                    type: 'GET',
                                                    url: 'http://demos1.softaculous.com/AbanteCart/index.php?rt=extension/default_cod/confirm',
                                                    beforeSend: function() {
                                                        $('.alert').remove();
                                                        $('.action-buttons').hide(); 
                                                        $('.action-buttons').before('<div class="wait alert alert-info text-center"><i class="fa fa-refresh fa-spin"></i> </div>');
                                                    },      
                                                    success: function() {
                                                        location = 'http://demos1.softaculous.com/AbanteCart/index.php?rt=checkout/success';
                                                    },
                                                    error: function (jqXHR, textStatus, errorThrown) {
                                                        alert(textStatus + ' ' + errorThrown);
                                                        $('.wait').remove();
                                                        $('.action-buttons').show();
                                                        try { resetLockBtn(); } catch (e){}
                                                    }
                                                });
                                            }
                                        </script> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="sidewidt">
                        <div class="titulo_categoria">
                            Resumen del Pedido
                        </div> 
                        <table class="table confirm_products">
                            <tbody>
                                <?php
                                    $HTML1 = "";
                                    $sql = $db->query(
                                        "SELECT
                                            id_producto,
                                            cantidad,
                                            id
                                        FROM
                                            carrito
                                        WHERE
                                            id_usuario='$_SESSION[app_id]';");
                                        $cantidadPrd = $db->rows($sql);
                                        $idCarrito   = $_SESSION['app_id'];
                                    while($data = $db->recorrer($sql)) {
                                        $precio     = ($_productos[$data[0]]['oferta'] == 1) ? $_productos[$data[0]]['precio_oferta']: $_productos[$data[0]]['precio']; 
                                        $HTML1 .= 
                                        '<tr>
                                            <td style="text-align:Justify; vertical-align:middle; width: 70%">
                                                <small>'.$data[1] .'</small>
                                                <b>-</b> 
                                                <small>'.$_productos[$data[0]]['nombre'].'</small>
                                            </td>
                                            <td style="text-align:center; vertical-align:middle; width: 30%">
                                                <b>
                                                    <small>
                                                        Bs. '. number_format($precio * $data[1],2,",",".").'
                                                    </small>
                                                </b>
                                            </td>
                                        </tr>';
                                    }
                                    echo $HTML1;
                                ?>
                            </tbody>
                        </table>
                        <table class="pull-right">
                            <tbody>
                                <tr>
                                    <td style="text-align:justify; vertical-align:middle; width: 40%">
                                        <b>Sub-Total:</b>
                                    </td>
                                    <td style="text-align:right; vertical-align:middle; width: 60%">
                                        <small class="pull-right">
                                            <?php echo 'Bs. '. number_format($subtotal,2,",","."); ?>
                                        </small>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align:justify; vertical-align:middle; width: 40%">
                                        <b>Costo de Envio:</b>
                                    </td>
                                    <td style="text-align:right; vertical-align:middle; width: 60%">
                                        <small class="pull-right">
                                            <?php echo 'Bs. '. number_format($costoEnvio,2,",","."); ?>
                                        </small>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align:justify; vertical-align:middle; width: 40%">
                                        <b>Total:</b>
                                    </td>
                                    <td style="text-align:right; vertical-align:middle; width: 60%">
                                        <small class="pull-right">
                                            <?php echo 'Bs. '. number_format($total,2,",","."); ?>
                                        </small>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            <!-- FIN DEL CUERPO DE LA PÁGINA -->
            </div>
        </div>  
    </div>
    <!--/FIN DE PAGINA DE COMPRA-->
</section>
<?php include(HTML_DIR . 'overall/footer.php'); ?>

</body>
</html>