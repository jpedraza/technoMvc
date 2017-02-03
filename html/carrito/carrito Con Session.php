<?php include(HTML_DIR . 'overall/header.php'); ?>

<body>
<section class="engine"><a rel="nofollow" href="#"><?php echo APP_TITLE ?></a></section>


<?php include(HTML_DIR . '/overall/topnav.php'); ?>


<section>
    <!--PAGINA DE CONTACTO-->
    <div id="contact-page" class="container">
        <div class="bg">
            <div class="row">
                <?php 
                $prdCarro           = $_SESSION['carritoProducto'];
                $carro              = explode("/", $prdCarro);
                $cantidadPrd        = count($carro);
                $cantidadReal       = array_count_values($carro);
                $cantidadRealPrd    = count($cantidadReal);

                var_dump($prdCarro);
                exit();

                /*if ($cantidadRealPrd == $cantidadPrd) {
                    for ($i=0; $i < $cantidadPrd; $i++) { 
                        echo $_productos[$carro[$i]]['nombre']  ."<br />";
                    }
                } else{
                    header("Location:" . $_SERVER['HTTP_REFERER']);
                }*/
                if ($cantidadPrd > 0) { ?>
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
                                    Precio Unitario
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
                                $HTML = ""; 
                                $subtotal = 0;
                                $cantidad = 1;
                                for ($i=0; $i < $cantidadPrd; $i++) {
                                    $precio = ($_productos[$carro[$i]]['oferta'] == 1) ? $_productos[$carro[$i]]['precio_oferta']: $_productos[$carro[$i]]['precio'];
                                    $subtotal += ($precio * $cantidad * 0.89285714);
                                    $HTML .= '
                                    <tr>
                                        <td>
                                            <a href=""><img src="'.URL_PRODUCTOS. $_productos[$carro[$i]]['foto1'].'" alt="'.$_productos[$carro[$i]]['nombre'].'" width="70" height="70"></a>
                                        </td>
                                        <td style="text-align:center;">
                                            <p><a href="">'.$_productos[$carro[$i]]['nombre'].'</a></p>
                                        </td>
                                        <td style="text-align:center;">
                                            <p>Bs. '.number_format($precio,2,",",".").'</p>  
                                        </td>
                                        <td style="text-align:center;">
                                            <div class="cart_quantity_button">
                                            <form>
                                                <a class="cart_quantity_down" href="#">- </a>
                                                <input class="cart_quantity_input" type="text" name="quantity" value="'.$cantidad.'">
                                                <a class="cart_quantity_up" href="#"> + </a>
                                            </form>
                                            </div>
                                        </td>
                                        <td style="text-align:center;">
                                            <p>Bs. '. number_format($precio * $cantidad * 0.89285714,2,",",".").'</p>   
                                        </td>
                                        <td style="text-align:center;">
                                            <a class="cart_quantity_delete" href="#"><i class="fa fa-times"></i>
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
                                <!--<a class="btn btn-default update" href="">Actualizar</a>-->
                        <a class="btn btn-default check_out" href="">Comprar</a>
                    </div>
                </div> 
                    <?php
                } else { ?>
                    <div class="col-sm-12">
                        <h2 class="title text-center">Carrito</h2>
                        <div class="table-responsive cart_info">
                            <table class="table table-condensed">
                                <thead>
                                    <th style="text-align:center; width: 35%" colspan="2">
                                        Producto
                                    </th>
                                    <th style="text-align:center; width: 15%">
                                        Precio Unitario
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
                                    <tr>
                                        <td colspan="6" style="text-align:center;">
                                            <h4 style="color: #00849c;"> No hay productos aún en su carrito </h4>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div> 

                <?php    
                }
                ?> 
            </div>  
        </div>  
    </div>
    <!--/FIN DE PAGINA DE CONTACTO-->
</section>

<?php include(HTML_DIR . 'overall/footer.php'); ?>

</body>
</html>
