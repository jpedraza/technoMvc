<?php

    $tipoPago           = $_POST['tipoPago'];
    $total              = $_POST['total'];
    $productosComprados = $_POST['productosComprados'];
    $totalItems         = $_POST['totalItems'];

    if(isset($_SESSION['checkout'])){
        if ($tipoPago == "mercadopago") {
            $datosCompra = unserialize($_SESSION['checkout']); 
            $preference_data = array(
                "items" => array(
                    array(
                        "id" => "Code",
                        "title" => "Compra de productos en ". APP_TITLE,
                        "currency_id" => "VEF",
                        "picture_url" =>"https://www.mercadopago.com/org-img/MP3/home/logomp3.gif",
                        "description" => "Description",
                        "category_id" => "Category",
                        "quantity" => $totalItems,
                        "unit_price" => $total
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
                        "zip_code" => "1430",
                        "street_number"=> 123,
                        "street_name"=> "Street",
                        "floor"=> 4,
                        "apartment"=> "C"
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
                /**
                 * Ingresar a la BD los datos del comprador.
                 * Sumar al producto 1 la cantidad de vendidos.
                 * Restar del stock 1.
                 * Enviar datos de transferencia o medio de pago.
                 * Y eliminar la Variable de Sesion de checkout.
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