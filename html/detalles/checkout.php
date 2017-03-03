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
                    <h2 class="title text-center">Procesar Compra</h2>
                </div>                  
            </div>
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
            /**
             * Verifica si no esta logeado, muestra link para iniciar sesión, solamente.
             */
            if (!isset($_SESSION['app_id'])) {
                echo'
                <div class="register-req">
                    <p>Por favor inicia Sesión o Registrate para poder comprar</p>
                </div>
                <div class="col-sm-7">
                    <a data-toggle="modal" data-target="#Login">
                        <h4 class="aviso-luis">
                            <span class="glyphicon glyphicon-user"></span>
                            Iniciar Sesión
                        </h4>
                    </a>
                </div>
                <div class="col-sm-5">
                    <a data-toggle="modal" data-target="#Registro">
                        <h4 class="aviso-luis">
                            <span class="glyphicon glyphicon-lock"></span>
                            Registro
                        </h4>
                    </a>
                </div>';
            } elseif ($cantidadPrd < 1) { 
                /**
                 * Verifica si el usuario logeado, tiene productos en el carrito para comprar.
                 * Si no tienes muestra solo un mensaje.
                 */
                echo 
                '<div class="col-sm-7"><br /><br />
                    <div class="product-image-wrapper" style="background-color: #E8F8FD;">
                        <div class="single-products">
                            <div class="productinfo text-center men-thumb-item">
                                <h2>No tiene productos aún en su carrito para pagar.</h2>
                            </div>
                        </div>
                    </div><br /><br /><br /><br />
                </div>
                <div class="col-sm-5">
                    <div class="titulo_categoria">
                        Resumen del Pedido
                    </div>
                    <div class="total_area">
                        <ul>
                            <li>Sub-Total: <span>0,00</span></li>
                            <li>I.V.A.<span>0,00</span></li>
                            <li>Costo de Envio<span>0,00</span></li>
                            <li>Total a Pagar <span>0,00</span></li>
                        </ul>
                    </div>
                </div>';
            } else { ?>
                <div class="col-sm-8">
                    <div class="contact-form">
                        <h2 class="title text-center">Detalle a Pagar</h2>
                    </div>
                    <div class="table-responsive cart_info">
                        <table class="table table-condensed">
                            <thead>
                                <th style="text-align:center; width: 35%" colspan="2">
                                    Producto
                                </th>
                                <th style="text-align:center; width: 15%">
                                    PVP sin IVA
                                </th>
                                <th style="text-align:center; width: 20%">
                                    Cantidad
                                </th>
                                <th style="text-align:center; width: 15%">
                                    Total sin IVA
                                </th>
                                <th style="text-align:center; width: 10%">
                                    Accion
                                </th>
                            </thead>
                            <tbody>
                            <?php
                            $HTML   = "";
                            $subtotal = 0;                              
                                while($data = $db->recorrer($sql)) {
                                    $precio     = ($_productos[$data[0]]['oferta'] == 1) ? $_productos[$data[0]]['precio_oferta']: $_productos[$data[0]]['precio'];
                                    $subtotal  += ($precio * $data[1] * 0.89285714);
                                    $inventario = $_productos[$data[0]]['cantidad'];
                                    $alerta     = $inventario == $data[1] ? '<input type="text" style="background-color: #FFDBDB" class="cart_quantity_input" disabled="" name="cantidad" id="cantidad" value="'.$data[1].'">' : '<input type="text" class="cart_quantity_input" disabled="" name="cantidad" id="cantidad" value="'.$data[1].'">';
                                    $HTML      .= '
                                    <tr> 
                                        <td>
                                            <a href="detalles/'. UrlAmigable($data[0], $_productos[$data[0]]['nombre']) . '"><img src="'.URL_PRODUCTOS. $_productos[$data[0]]['foto1'].'" alt="'.$_productos[$data[0]]['nombre'].'" width="70" height="70"></a>
                                        </td>
                                        <td style="text-align:center;">
                                            <p>
                                                <a href="detalles/'. UrlAmigable($data[0], $_productos[$data[0]]['nombre']) . '">
                                                    '.$_productos[$data[0]]['nombre'].'
                                                </a>
                                            </p>
                                        </td>
                                        <td style="text-align:center;">
                                            <p>Bs. '.number_format($precio * 0.89285714,2,",",".").'</p>  
                                        </td>
                                        <td style="text-align:center;">
                                            <div class="cart_quantity_button">
                                                <a class="btn btn-default cart_quantity_down" href="core/bin/ajax/disminuirCar.php?idCar='.$data[2].'">
                                                    <i class="fa fa-angle-down"></i> 
                                                </a>'.
                                                $alerta .'
                                                <input type="hidden" name="idPrd" id="idPrd" value="'.$data[0].'">
                                                <input type="hidden" name="idCar" id="idCar" value="'.$data[2].'">
                                                <a class="btn btn-default cart_quantity_up" href="core/bin/ajax/aumentarCar.php?idCar='.$data[2].'&id='.$data[0].'">
                                                    <i class="fa fa-angle-up" style="margin-left:4px;"></i> 
                                                </a>
                                            </div>
                                        </td>
                                        <td style="text-align:center;">
                                            <p>Bs. '. number_format($precio * $data[1] * 0.89285714,2,",",".").'</p>   
                                        </td>
                                        <td style="text-align:center;">
                                            <a class="cart_quantity_delete btn btn-default" href="borrar/' . UrlAmigable($data[2], $_productos[$data[0]]['nombre']).'">
                                                <i class="fa fa-times"> Borrar</i>
                                            </a>
                                        </td>
                                    </tr>
                                    ';
                                }
                                $db->liberar($sql);
                                $db->close();
                                echo $HTML;?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="titulo_categoria">
                        Resumen del Pedido
                    </div>
                    <div class="total_area">
                        <ul>
                            <?php 
                                $iva    = $subtotal * 0.12;
                                $total  = $subtotal + $iva; 
                            ?>
                            <li>Sub-Total: <span><?php echo number_format($subtotal,2,",",".") ?></span></li>
                            <li>I.V.A.<span><?php echo number_format($iva,2,",",".") ?></span></li>
                            <li>Costo de Envio<span>0,00</span></li>
                            <li>Total a Pagar <span><?php echo number_format($total,2,",",".") ?></span></li>
                        </ul>
                    </div>
                </div>
                
                <!-- Inicio del Cuerpo del Formulario de Pago -->
                <div class="col-sm-12 register-req">
                    <p>Completa los siguientes datos a fin de procesar tu compra.</p>
                </div>
                <div class="row">
                    <div id="_AJAX_CHECKOUT_" class="col-sm-12"></div> 

                    <form class="form-horizontal" onkeypress="return runScriptCheck(event)"> 
                        <div class="col-sm-4 bill-to">
                            <p>Datos Personales</p>
                            <input type="text" placeholder="Nombre *" id="nombre" value="<?php echo substr($_users[$_SESSION['app_id']]['name'],0,strpos($_users[$_SESSION['app_id']]['name']," ")); ?>" class="form-control">
                            <input type="text" placeholder="Apellido *" id="apellido" value="<?php echo substr(strrchr($_users[$_SESSION['app_id']]['name'], " "),1) ?>" class="form-control">
                            <input type="text" placeholder="Cédula *" id="cedula" class="form-control" maxlength="9">
                            <input type="email" placeholder="Email *" id="email" value="<?php echo $_users[$_SESSION['app_id']]['email']; ?>" disabled="" required="" class="form-control">
                            <input type="text" placeholder="Teléfono *" id="telefono" maxlength="11" class="form-control">
                            <input type="text" placeholder="Teléfono Opcional" id="telefono1" class="form-control" maxlength="11">
                        </div>
                        <div class="col-sm-4 bill-to">
                            <p>Otros Datos</p>
                            <input type="number" placeholder="Código Postal *" min="1000" max="9999" id="postal" maxlength="4" class="form-control">
                            <select id="pais" onclick="Desactivo(this.value)" class="form-control">
                                <option value="0">-- País --</option>
                                <option value="1">Venezuela</option>
                            </select>
                            <select id="estado" disabled="" class="form-control">
                                <option value="0">-- Estado --</option>
                                <option value="1">Amazonas</option>
                                <option value="2">Anzoátegui</option>
                                <option value="3">Apure</option>
                                <option value="4">Aragua</option>
                                <option value="5">Barinas</option>
                                <option value="6">Bolívar</option>
                                <option value="7">Carabobo</option>
                                <option value="8">Cojedes</option>
                                <option value="9">Delta Amacuro</option>
                                <option value="10">Dependencias Federales</option>
                                <option value="11">Distrito Capital</option>
                                <option value="12">Falcón</option>
                                <option value="13">Guárico</option>
                                <option value="14">Lara</option>
                                <option value="15">Mérida</option>
                                <option value="16">Miranda</option>
                                <option value="17">Monagas</option>
                                <option value="18">Nueva Esparta</option>
                                <option value="19">Portuguesa</option>
                                <option value="20">Sucre</option>
                                <option value="21">Táchira</option>
                                <option value="22">Trujillo</option>
                                <option value="23">Vargas</option>
                                <option value="24">Yaracuy</option>
                                <option value="25">Zulia</option>
                            </select>
                            <input type="text" placeholder="Municipio *" id="municipio" class="form-control">
                            <input type="text" placeholder="Avenida / Calle *" id="calle" class="form-control">
                            <input type="text" placeholder="Edificio / Piso - Casa / N° *" id="edificio" class="form-control">
                        </div>
                        <div class="col-sm-4 bill-to">
                            <p>Tipo de Pago</p>
                            <div class="radio">
                                <label class="popup-input">
                                    <input name="tipoPago" id="transferencia" value="transferencia" type="radio">
                                    <img src="views/app/images/transferencia.jpg" title="Transferencia" width="50px" height="50px"> 
                                    <i class="popup">Transferencia</i>
                                </label>
                            </div>
                            <div class="radio">
                                <label class="popup-input">
                                    <input name="tipoPago" id="mercadopago" value="mercadopago" type="radio">
                                    <img src="views/app/images/mercadoPag.jpeg" title="MercadoPago" width="50px" height="50px">
                                    <i class="popup">MercadoPago</i>
                                </label>
                            </div>
                            <div class="radio">
                                <label class="popup-input">
                                    <input name="tipoPago" id="efectivo" value="efectivo" type="radio">
                                    <img src="views/app/images/efectivo.png" title="Efectivo" width="50px" height="50px">
                                    <i class="popup">Efectivo en Tienda</i>
                                </label>
                            </div>
                            <div class="radio">
                                <label class="popup-input">
                                    <input name="tipoPago" id="debito" value="debito" type="radio">
                                    <img src="views/app/images/maestro.png" title="Debito" width="50px" height="50px">
                                    <i class="popup">Debito en Tienda</i>
                                </label>
                            </div>
                        </div>
                        <button type="button" class="btn btn-default btn-success btn-block" onclick="goCheckout()">
                            <span class="glyphicon glyphicon-check"></span> 
                                Procesar Compra
                        </button>
                    </form>                    
                </div> 
            <?php
            } 
            ?>
        </div>  
    </div>
    <!--/FIN DE PAGINA DE COMPRA-->
</section>

    <script src=views/app/js/checkout.js></script>
    <script type="text/javascript">
                $(function(){
          $('.popup').load();
        });
    </script>
<?php include(HTML_DIR . 'overall/footer.php'); ?>

</body>
</html>