
                                    <?php 

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
                                                "unit_price" => $total
                                            )
                                        ),
                                        "payer" => array(
                                            "name" => "user-name",
                                            "surname" => "user-surname",
                                            "email" => "user@email.com",
                                            "date_created" => "2014-07-28T09:50:37.521-04:00",
                                            "phone" => array(
                                                "area_code" => "11",
                                                "number" => "4444-4444"
                                            ),
                                            "identification" => array(
                                                "type" => "DNI",
                                                "number" => "12345678"
                                            ),
                                            "address" => array(
                                                "street_name" => "Street",
                                                "street_number" => 123,
                                                "zip_code" => "1430"
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
                                    ?>

                                    <a href="<?php echo $preference["response"]["init_point"]; ?>" name="MP-Checkout" class="blue-ar-m-sq-arall">Pagar</a>
                                    <script type="text/javascript" src="//resources.mlstatic.com/mptools/render.js"></script>