<?php include(HTML_DIR . 'overall/header.php'); ?>

<body>
<section class="engine"><a rel="nofollow" href="#"><?php echo APP_TITLE ?></a></section>


<?php include(HTML_DIR . '/overall/topnav.php'); ?>


<section>
    <!--CARRITO-->
    <div id="contact-page" class="container">
        <div class="bg">
            <div class="row">
                <?php
                $db  = new Conexion();
                /**
                 * Muestra los productos en el carrito de una persona que aun no esta logeada.
                 */
                if (!isset($_SESSION['app_id'])) {
                    $sql = $db->query(
                    "SELECT
                        id_producto,
                        cantidad,
                        id
                    FROM
                        carrito
                    WHERE
                        id_usuario='$_SESSION[carrito]';");
                    $cantidadPrd = $db->rows($sql);
                    $idCarrito   = $_SESSION['carrito']; 
                } elseif ($_users[$_SESSION['app_id']]['permisos'] != 2) {
                    /**
                     * Si la persona esta logeada actualiza su carrito.
                     * Esto si la persona agrego productos al carro sin logearse.
                     */
                    $sql = $db->query(
                    "UPDATE
                        carrito
                    SET
                        id_usuario='$_SESSION[app_id]'
                    WHERE
                        id_usuario='$_SESSION[carrito]';");

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
                } else {
                    $db->query("
                    DELETE FROM
                        carrito
                    WHERE
                        id_usuario = '$_SESSION[carrito]' OR id_usuario = '$_SESSION[app_id]';");
                    $cantidadPrd = 0;
                    $idCarrito   = $_SESSION['app_id'];
                }
                ?>
                <div class="col-sm-8">
                    <div class="contact-form">
                        <h2 class="title text-center">Carrito</h2>
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
                            if ($cantidadPrd > 0) {                                
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
                                        <?php
                                        if (is_numeric($idCarrito)){
                                            echo '
                                            <div style="text-align: center; margin-top: -15px; margin-bottom: 35px">
                                                <a class="btn btn-default check_out" href="vaciar/' . UrlAmigable($idCarrito, $_users[$idCarrito]['user']).'"><i class="fa fa-times-circle"></i> Vaciar Carro</a>
                                            </div>'; 
                                        } else{ 
                                            echo '
                                            <div style="text-align: center; margin-top: -15px; margin-bottom: 35px">
                                                <a class="btn btn-default check_out" href="?view=carrito&mode=vaciar&usuario='.$idCarrito.'"><i class="fa fa-times-circle"></i> Vaciar Carro</a>
                                            </div>';  
                                        } ?>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="titulo_categoria">
                                        Costo estimado de la compra
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
                                    <div style="text-align: center; margin-top: -15px; margin-bottom: 35px">
                                        <?php 
                                        if (!isset($_SESSION['app_id'])) {
                                            echo '
                                            <a class="btn btn-default check_out" data-toggle="modal" data-target="#Login">
                                                <i class="fa fa-check-circle"></i> Procesar Compra
                                            </a>';
                                        } else {
                                            echo '
                                            <a class="btn btn-default check_out" href="Procesar-Compra/">
                                                <i class="fa fa-check-circle"></i> Procesar Compra
                                            </a>';
                                        }
                                        ?>
                                        
                                    </div>
                                </div>
                            </div> 
                            <?php
                            /**
                             * Si no hay productos en el carrito
                             */
                            } else { ?>
                                <tr>
                                    <td colspan="6" style="text-align:center;height: 100px;">
                                        <h4 style="color: #00849c;">No hay productos aún en su carrito </h4>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="titulo_categoria">
                        Costo estimado de la compra
                    </div>
                    <div class="total_area">
                        <ul>
                            <li>Sub-Total: <span>0,00</span></li>
                            <li>I.V.A.<span>0,00</span></li>
                            <li>Costo de Envio<span>0,00</span></li>
                            <li>Total a Pagar <span>0,00</span></li>
                        </ul>
                    </div>
                </div> 
                <?php    
                }
                ?> 
            </div>  
        </div>  
    </div>
    <!--/FIN DE CARRITO-->
</section>

<?php include(HTML_DIR . 'overall/footer.php'); ?>
<script src=views/app/js/controlCarro.js></script>

</body>
</html>
