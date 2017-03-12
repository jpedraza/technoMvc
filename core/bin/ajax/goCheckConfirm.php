<?php

if(!empty($_POST['nombre']) and !empty($_POST['apellido']) and !empty($_POST['cedula']) and !empty($_POST['email']) and !empty($_POST['telefono']) and !empty($_POST['postal']) and !empty($_POST['municipio']) and !empty($_POST['calle']) and !empty($_POST['edificio'])) {
    /**
     * Definimos las Variables que enviamos por POST en el Formulario de compra.
     * No es necesario pero se simplifica.
     * En el caso de tipo de pago aplicamos un condicional para ver cual opción fue seleccionada.
     */
    $nombre     =  $_POST['nombre'];
    $apellido   =  $_POST['apellido'];
    $cedula     =  $_POST['cedula'];
    $email      =  $_POST['email'];
    $telefono   =  $_POST['telefono'];
    $telefono1  =  isset($_POST['telefono1']) ? $_POST['telefono1'] : 0;
    $postal     =  $_POST['postal'];
    $pais       =  $_POST['pais'];
    $estado     =  $_POST['estado'];
    $municipio  =  $_POST['municipio'];
    $calle      =  $_POST['calle'];
    $edificio   =  $_POST['edificio'];
    $fecha      =  date("d-m-Y");

    if ($_POST['mercadopago'] == "true") {
        $tipoPago = "mercadopago";
    } elseif ($_POST['transferencia'] == "true") {
        $tipoPago = "transferencia";
    }elseif ($_POST['efectivo'] == "true") {
        $tipoPago = "efectivo";
    }else{
        $tipoPago = "debito";
    }
    
    /**
     * Verifica que el nombre tenga una longitud mayor a la definida en el core.
     */
    if (strlen($nombre) > LONGITUD_MIN_NOM_1) {
        /**
         * Verifica que el apellido tenga una longitud mayor a la definida en el core.
         */
        if (strlen($apellido) > LONGITUD_MIN_NOM_1) {
            if (strlen($cedula) >= LONGITUD_MIN_CEDULA && strlen($cedula) <= LONGITUD_MAX_CEDULA) {
                /**
                 * Verifica que solo ingreso numeros en la cedula
                 */
                if (preg_match("/^[[:digit:]]*$/",$cedula)) {
                    /**
                     * Completa la cedula con 0 a la izquierda para hacerla mas estetica al mostrar.
                     */
                    $cedula = str_pad($cedula,LONGITUD_MAX_CEDULA,0,STR_PAD_LEFT);
                    /**
                     * Verifica que no hayan modificado el correo de forma maliciosa
                     */
                    if (strlen($email) > LONGITUD_MIN_NOM) {
                        /**
                         * Verifica que el telefono tenga la longitud definida en el core
                         */
                        if (strlen($telefono) == LONGITUD_TELEFONO) {
                            /**
                             * Verifica que el telefono comience con el código de area 02 o 04.
                             */
                            if (substr($telefono, 0,2) == 02 || substr($telefono, 0,2) == 04) {
                                /**
                                 * Verifica que solo ingreso numeros.
                                 */
                                if (preg_match("/^[[:digit:]]*$/",$telefono)) {
                                    /**
                                     * Verifica si ingreso el telefono Opcional y valida.
                                     */
                                    if ($telefono1 == 0 || strlen($telefono) == LONGITUD_TELEFONO) {
                                        /**
                                         * Verifica que el telefono Opcional comience con el código de area 02 o 04.
                                         */
                                        if ($telefono1 == 0 || substr($telefono1, 0,2) == 02 || substr($telefono1, 0,2) == 04) {
                                            /**
                                             * Verifica que solo ingreso numeros.
                                             */
                                            if (preg_match("/^[[:digit:]]*$/",$telefono1)) {
                                                /**
                                                 * Verifica que el codigo postal tenga la longitud definida en el core
                                                 */
                                                if (strlen($postal) == LONGITUD_CODIGO_POSTAL) {
                                                    /**
                                                     * Verifica que país y estado esten seleccionados
                                                     */
                                                    if ($pais > 0 && $estado > 0) {
                                                        /**
                                                         * Verifica que municipio, calle y edificio tengan la longitud establecida en el core
                                                         */
                                                        if (strlen($municipio) >= LONGITUD_MIN_NOM_1) {
                                                            if (strlen($calle) > LONGITUD_MIN_NOM) {
                                                                if (strlen($edificio) > LONGITUD_MIN_NOM) {
                                                                    /**
                                                                     * Creo un arreglo con todos los datos.
                                                                     * @var compra [array].
                                                                     * Esta se la asigno a una variable de Sesión.
                                                                     */
                                                                    $compra = [
                                                                        "nombre"        => $nombre,
                                                                        "apellido"      => $apellido,
                                                                        "cedula"        => $cedula,
                                                                        "email"         => $email,
                                                                        "telefono"      => $telefono,
                                                                        "telefono1"     => $telefono1,
                                                                        "postal"        => $postal,
                                                                        "pais"          => $pais,
                                                                        "estado"        => $estado,
                                                                        "municipio"     => $municipio,
                                                                        "calle"         => $calle,
                                                                        "edificio"      => $edificio,
                                                                        "tipoPago"      => $tipoPago,
                                                                        "fecha"         => $fecha,
                                                                    ];
                                                                    $_SESSION['checkout'] = serialize($compra);
                                                                    echo 1;
                                                                } else {
                                                                    echo 
                                                                    '<div class="alert alert-dismissible alert-danger">
                                                                        <button type="button" class="close" data-dismiss="alert">x</button>
                                                                        <strong>ERROR:</strong> la longitud de Edificio o Casa debe ser mayor a '.LONGITUD_MIN_NOM.' caracteres.
                                                                    </div>';
                                                                }
                                                            } else {
                                                                echo 
                                                                '<div class="alert alert-dismissible alert-danger">
                                                                    <button type="button" class="close" data-dismiss="alert">x</button>
                                                                    <strong>ERROR:</strong> la longitud de la avenida y/o calle debe ser mayor a '.LONGITUD_MIN_NOM.' caracteres.
                                                                </div>';
                                                            }
                                                        } else {
                                                            echo 
                                                            '<div class="alert alert-dismissible alert-danger">
                                                                <button type="button" class="close" data-dismiss="alert">x</button>
                                                                <strong>ERROR:</strong> la longitud del municipio debe ser mayor a '.LONGITUD_MIN_NOM_1.' caracteres.
                                                            </div>';
                                                        }
                                                    } else {
                                                        echo 
                                                        '<div class="alert alert-dismissible alert-danger">
                                                            <button type="button" class="close" data-dismiss="alert">x</button>
                                                            <strong>ERROR:</strong> debe seleccionar un país y un estado.
                                                        </div>';
                                                    }
                                                } else {
                                                    echo 
                                                    '<div class="alert alert-dismissible alert-danger">
                                                        <button type="button" class="close" data-dismiss="alert">x</button>
                                                        <strong>ERROR:</strong> debe ingresar un código postal valido, de '.LONGITUD_CODIGO_POSTAL.' digitos.
                                                    </div>';
                                                }
                                            } else {
                                                echo 
                                                '<div class="alert alert-dismissible alert-danger">
                                                    <button type="button" class="close" data-dismiss="alert">x</button>
                                                    <strong>ERROR:</strong> debe ingresar solo números en el teléfono opcional.
                                                </div>';
                                            }
                                        } else {
                                            echo 
                                            '<div class="alert alert-dismissible alert-danger">
                                                <button type="button" class="close" data-dismiss="alert">x</button>
                                                <strong>ERROR:</strong> debe ingresar un codigo de área o celular valido.
                                            </div>';
                                        }
                                    } else {
                                        echo 
                                        '<div class="alert alert-dismissible alert-danger">
                                            <button type="button" class="close" data-dismiss="alert">x</button>
                                            <strong>ERROR:</strong> ingrese un teléfono opcional valido. Ej. 04123456789
                                        </div>';
                                    }
                                } else {
                                    echo 
                                    '<div class="alert alert-dismissible alert-danger">
                                        <button type="button" class="close" data-dismiss="alert">x</button>
                                        <strong>ERROR:</strong> debe ingresar solo números en el teléfono.
                                    </div>';
                                }
                            } else {
                                echo 
                                '<div class="alert alert-dismissible alert-danger">
                                    <button type="button" class="close" data-dismiss="alert">x</button>
                                    <strong>ERROR:</strong> debe ingresar un codigo de área o celular valido.
                                </div>';
                            }
                        } else {
                            echo 
                            '<div class="alert alert-dismissible alert-danger">
                                <button type="button" class="close" data-dismiss="alert">x</button>
                                <strong>ERROR:</strong> ingrese un teléfono valido. Ej. 02126543210
                            </div>';
                        }
                    } else {
                        echo 
                        '<div class="alert alert-dismissible alert-danger">
                            <button type="button" class="close" data-dismiss="alert">x</button>
                            <strong>ERROR:</strong> no debes modificar el correo.
                        </div>';
                    }
                } else {
                    echo 
                    '<div class="alert alert-dismissible alert-danger">
                        <button type="button" class="close" data-dismiss="alert">x</button>
                        <strong>ERROR:</strong> debe ingresar solo números en la cédula.
                    </div>';
                }
            } else {
                echo 
                '<div class="alert alert-dismissible alert-danger">
                    <button type="button" class="close" data-dismiss="alert">x</button>
                    <strong>ERROR:</strong> Ingrese una cedula valida.
                </div>';
            }
        } else {
            echo 
            '<div class="alert alert-dismissible alert-danger">
                <button type="button" class="close" data-dismiss="alert">x</button>
                <strong>ERROR:</strong> la longitud del apellido es muy corta.
            </div>';
        }
    } else {
        echo 
        '<div class="alert alert-dismissible alert-danger">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <strong>ERROR:</strong> la longitud del nombre es muy corta.
        </div>';
    }
} else {
    echo 
    '<div class="alert alert-dismissible alert-danger">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <strong>ERROR:</strong> Todos los datos deben estar llenos.
    </div>';
}

?>
