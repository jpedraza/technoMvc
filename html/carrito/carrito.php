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
                if (!isset($_SESSION['app_id'])) {
                    $sql = $db->query(
                    "SELECT
                        id_producto,
                        cantidad
                    FROM
                        carrito
                    WHERE
                        id_usuario='$_SESSION[carrito]';");
                $cantidadPrd = $db->rows($sql);
                $idCarrito   = $_SESSION['carrito']; 
                } else {
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
                        cantidad
                    FROM
                        carrito
                    WHERE
                        id_usuario='$_SESSION[app_id]';");
                $cantidadPrd = $db->rows($sql);

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
                                    $precio = ($_productos[$data[0]]['oferta'] == 1) ? $_productos[$data[0]]['precio_oferta']: $_productos[$data[0]]['precio'];
                                    $subtotal += ($precio * $data[1] * 0.89285714);
                                    $HTML .= '
                                    <tr>
                                        <td>
                                            <a href=""><img src="'.URL_PRODUCTOS. $_productos[$data[0]]['foto1'].'" alt="'.$_productos[$data[0]]['nombre'].'" width="70" height="70"></a>
                                        </td>
                                        <td style="text-align:center;">
                                            <p><a href="">'.$_productos[$data[0]]['nombre'].'</a></p>
                                        </td>
                                        <td style="text-align:center;">
                                            <p>Bs. '.number_format($precio * 0.89285714,2,",",".").'</p>  
                                        </td>
                                        <td style="text-align:center;">
                                            <div class="cart_quantity_button">
                                            <form>
                                                <a class="cart_quantity_down" href="#">- </a>
                                                <input class="cart_quantity_input" type="text" name="quantity" value="'.$data[1].'">
                                                <a class="cart_quantity_up" href="#"> + </a>
                                            </form>
                                            </div>
                                        </td>
                                        <td style="text-align:center;">
                                            <p>Bs. '. number_format($precio * $data[1] * 0.89285714,2,",",".").'</p>   
                                        </td>
                                        <td style="text-align:center;">
                                            <a class="cart_quantity_delete btn btn-default" href="?view=carrito&mode=delete&usuario=' .$idCarrito .'&producto=' .$data[0]. '"><i class="fa fa-times"> Borrar</i>
                                            </a>
                                        </td>
                                    </tr>
                                    ';
                                }
                                echo $HTML; ?>
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
                            <a class="btn btn-default check_out" href=""><i class="fa fa-check-square"></i> Procesar Compra</a>
                        </div>
                    </div>
                </div> 
                    <?php
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

</body>
</html>
