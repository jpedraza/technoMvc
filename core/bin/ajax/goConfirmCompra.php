<?php

    $tipoPago           = $_POST['tipoPago'];
    $total              = $_POST['total'];
    $productosComprados = $_POST['productosComprados'];
    $totalItems         = $_POST['totalItems'];
    $datosCompra        = unserialize($_SESSION['checkout']); 

    if(isset($_SESSION['checkout'])){
        if ($tipoPago == "mercadopago") {
            $preference_data = array(
                "items" => array(
                    array(
                        "id" => "Code",
                        "title" => "Compra de productos en ". APP_TITLE,
                        "currency_id" => "VEF",
                        "picture_url" =>"https://www.mercadopago.com/org-img/MP3/home/logomp3.gif",
                        "description" => "Description",
                        "category_id" => "Category",
                        "quantity" => 1,
                        /*"unit_price" => 1*/
                        "unit_price" => intval($total)
                    )
                ),
                "payer" => array(
                    "name" => $datosCompra['nombre'],
                    "surname" => $datosCompra['apellido'],
                    "email" => $datosCompra['email'],
                    "date_created" => $datosCompra['fecha'],
                    "phone" => array(
                        "area_code" => substr($datosCompra['telefono'],0,4),
                        "number" => substr($datosCompra['telefono'],4)
                    ),
                    "identification" => array(
                        "type" => "Cedula",
                        "number" => $datosCompra['cedula']
                    ),
                    "address" => array(
                        "street_name" => $datosCompra['calle'],
                        "street_number" => $datosCompra['edificio'],
                        "zip_code" => $datosCompra['postal']
                    )
                ),
                "back_urls" => array(
                    "success" => "https://www.success.com",
                    "failure" => "http://www.failure.com",
                    "pending" => "http://www.pending.com"
                ),
                "auto_return" => "approved",
                "payment_methods" => array(
                    "excluded_payment_methods" => array(
                        array(
                            "id" => "amex",
                        )
                    ),
                    "excluded_payment_types" => array(
                        array(
                            "id" => "ticket"
                        )
                    ),
                    "installments" => 24,
                    "default_payment_method_id" => null,
                    "default_installments" => null,
                ),
                "shipments" => array(
                    "receiver_address" => array(
                        "zip_code" => $datosCompra['postal'],
                        "street_number"=> $datosCompra['edificio'],
                        "street_name"=> $datosCompra['calle']
                    )
                ),
                "notification_url" => "https://www.your-site.com/ipn",
                "external_reference" => "Reference_1234",
                "expires" => false,
                "expiration_date_from" => null,
                "expiration_date_to" => null
            );

            $preference = $mp->create_preference($preference_data);
            echo 
            '<a href="'.$preference["response"]["init_point"].'"name="MP-Checkout" class="blue-ar-m-sq-arall btn btn-success" target="_blank">
                Pagar
            </a>
            <script type="text/javascript" src="//resources.mlstatic.com/mptools/render.js"></script>';
        } else {
            $db = new Conexion();

            /**
             * Ingresar a la BD la compra
             */
            $db->query("
                INSERT INTO
                    compras(id_usuario,fecha)
                VALUES
                    ('$_SESSION[app_id]', '$datosCompra[fecha]');
            ");

            /**
             * Recuperamos el id de la compra que cargamos
             */
            $sql        = $db->query("SELECT MAX(id) FROM compras");
            $idCompra   = intval($db->recorrer($sql));
            $db->liberar($sql);

            /**
             * Recuperamos el item que compramos
             */
            $sql = $db->query(
                "SELECT
                    id_producto,
                    cantidad
                FROM
                    carrito
                WHERE
                    id_usuario='$_SESSION[app_id]';"
            );
            while($data = $db->recorrer($sql)) {
                /**
                 * Insertamos el detalle de la compra
                 */                    
                $db->query("
                    INSERT INTO 
                        detalle_compras(id_compra,id_producto,cantidad_items)
                    VALUES
                        ('$idCompra','$data[0]','$data[1]');
                ");

                /**
                 *  Obtenemos la cantidad en Stock de los productos comprados
                 */
                $stockBD    = $db->query("SELECT cantidad FROM productos WHERE id = '$data[0]' LIMIT 1;");
                $cantidadBd = $db->recorrer($stockBD);
                $cantidadBd = intval($cantidadBd[0]);

                /**
                 *  Obtenemos la cantidad vendida de los productos comprados
                 */
                $soldBD     = $db->query("SELECT cantidad_vendida FROM productos WHERE id = '$data[0]';");
                $cVendidaBd = $db->recorrer($soldBD);
                $cVendidaBd = intval($cVendidaBd[0]);

                /**
                 *  Actualizamos la cantidad en Stock, restando lo que compran.
                 *  Actualizamos la cantidad vendida, sumando lo que compran.
                 */
                $newStock = $cantidadBd - $data[1];
                $newsold  = $cVendidaBd + $data[1];
                $db->query("
                    UPDATE 
                        productos
                    SET 
                        cantidad = '$newStock',
                        cantidad_vendida = '$newsold'
                    WHERE
                        id = '$data[0]';
                ");
            }
            $db->close();
            /**
             * Enviar datos de transferencia o medio de pago al correo.
             * Y eliminar la Variable de Sesion de checkout. y del carrito
             */
            echo 1;
        }
    } else {
        echo
        '<span class="label label-success">
            <strong>Hubo un error, intente nuevamente.</strong>
        </span>'; 
    }
?>