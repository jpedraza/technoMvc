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
                $datosCompra = unserialize($_SESSION['checkout']);
                if ($cantidadPrd < 1) { 
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
                    <!-- Inicio del Cuerpo del Formulario de Pago -->
                    <div class="col-sm-12 register-req">
                        <p>Edita los datos a fin de procesar tu compra.</p>
                    </div>
                    <div class="row">
                        <div id="_AJAX_CHECKOUT_" class="col-sm-12"></div> 

                        <form class="form-horizontal" onkeypress="return runScriptCheck(event)"> 
                            <div class="col-sm-4 bill-to">
                                <p>Datos Personales</p>
                                <input type="text" placeholder="Nombre *" id="nombre" value="<?php echo $datosCompra['nombre']; ?>" class="form-control">
                                <input type="text" placeholder="Apellido *" id="apellido" value="<?php echo $datosCompra['apellido']; ?>" class="form-control">
                                <input type="text" placeholder="Cédula *" id="cedula" class="form-control" maxlength="9" value="<?php echo $datosCompra['cedula']; ?>">
                                <input type="email" placeholder="Email *" id="email" value="<?php echo $datosCompra['email']; ?>" disabled="" required="" class="form-control">
                                <input type="text" placeholder="Teléfono *" id="telefono" maxlength="11" class="form-control" value="<?php echo $datosCompra['telefono']; ?>">
                                <input type="text" placeholder="Teléfono Opcional" id="telefono1" class="form-control" maxlength="11" value="<?php echo $datosCompra['telefono1']; ?>">
                            </div>
                            <div class="col-sm-4 bill-to">
                                <p>Otros Datos</p>
                                <input type="number" placeholder="Código Postal *" min="1000" max="9999" id="postal" maxlength="4" class="form-control" value="<?php echo $datosCompra['postal']; ?>">
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
                                <input type="text" placeholder="Municipio *" id="municipio" class="form-control" value="<?php echo $datosCompra['municipio']; ?>">
                                <input type="text" placeholder="Avenida / Calle *" id="calle" class="form-control" value="<?php echo $datosCompra['calle']; ?>">
                                <input type="text" placeholder="Edificio / Piso - Casa / N° *" id="edificio" class="form-control" value="<?php echo $datosCompra['edificio']; ?>">
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