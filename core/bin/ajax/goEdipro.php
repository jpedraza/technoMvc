<?php

if(!empty($_POST['nombre']) and (empty($_POST['precio']) or $_POST['precio'] != "") and isset($_POST['cantidad']) and $_POST['condicion'] != 0 and ($_POST['categoria'] == "" or is_numeric($_POST['categoria'])) and !empty($_POST['marca']) and (empty($_POST['detalle']) or $_POST['detalle'] != "")) {
    $db         = new Conexion();
    $data       = $db->real_escape_string($_POST['nombre']);
    $precio     = $_POST['precio'];
    $marca      = $db->real_escape_string($_POST['marca']);
    $cantidad   = $_POST['cantidad'];
    $condicion  = $_POST['condicion'];
    $categoria  = $_POST['categoria'];
    $detalle    = $_POST['detalle'];
    $bandera    = false;
    $subido     = array();
    $id         = $_POST['id'];


    $sql = $db->query("SELECT id FROM productos WHERE nombre='$data' and id!='$id' LIMIT 1;");    
    if($db->rows($sql) == 0) {
        if (strlen($data) > LONGITUD_MIN_NOM and strlen($data) < LONGITUD_MAX_NOM) {
           if ($cantidad >= 1) {
                if (is_numeric($precio)) {
                    if($precio > PRECIO_MIN_PROD) {
                        if ($condicion == 1 or $condicion == 2) {
                            if ($categoria > 0) {
                                if (strlen($marca) >= LONGITUD_MIN_MAR and strlen($marca) <= LONGITUD_MAX_MAR) {
                                    if ((strlen($detalle) - 10) > LONGITUD_MIN_NOM) {
                                        if (isset($_FILES["imagen"]["name"])) {
                                            foreach ($_FILES["imagen"]["error"] as $clave => $error) {
                                                if ($error == UPLOAD_ERR_OK) {
                                                    if (is_uploaded_file($_FILES['imagen']['tmp_name'][$clave])) {
                                                        $nombre_tmp = $_FILES["imagen"]["tmp_name"][$clave];        
                                                        $nombre = basename($_FILES["imagen"]["name"][$clave]);
                                                        $sql_img = $db->query("SELECT foto1,foto2,foto3 FROM productos WHERE foto1='$nombre' OR foto2='$nombre' OR foto3='$nombre' LIMIT 1;");
                                                        if ($db->rows($sql_img) == 0) {
                                                            if (move_uploaded_file($nombre_tmp, "views/images/productos/$nombre")){
                                                                $bandera = true;
                                                                array_push($subido,$nombre);
                                                            } else {
                                                                echo 
                                                                '<div class="alert alert-dismissible alert-danger">
                                                                <button type="button" class="close" data-dismiss="alert">x</button>
                                                                <strong>ERROR!</strong> Hubo un fallo al subir el archivo : '. $_FILES['imagen']['name'][$clave] .'.
                                                                </div>';
                                                                exit;
                                                            }
                                                        } else {
                                                            echo 
                                                            '<div class="alert alert-dismissible alert-danger">
                                                            <button type="button" class="close" data-dismiss="alert">x</button>
                                                            <strong>ERROR:</strong> ya existe un archivo llamado '. $nombre . '.
                                                            </div>';
                                                            @unlink(ini_get('upload_tmp_dir').$_FILES['imagen']['name']);
                                                            exit;
                                                        }
                                                    } else {
                                                        echo 
                                                        '<div class="alert alert-dismissible alert-danger">
                                                        <button type="button" class="close" data-dismiss="alert">x</button>
                                                        <strong>ERROR:</strong> Posible ataque del archivo subido: '. $_FILES['imagen']['name'][$clave] .'.
                                                        </div>';
                                                        exit;
                                                    }
                                                } else if ($error == UPLOAD_ERR_NO_FILE){
                                                    $bandera = true;
                                                }
                                                else {
                                                   echo 
                                                    '<div class="alert alert-dismissible alert-danger">
                                                    <button type="button" class="close" data-dismiss="alert">x</button>
                                                    <strong>ERROR:</strong>  Debes ingresar al menos una imagen.
                                                    </div>';
                                                    exit; 
                                                }
                                            }  $sql_bd = $db->query("SELECT foto1,foto2,foto3 FROM productos WHERE id='$_POST[id]';");
                                            $fotoBd = $db->recorrer($sql_bd);
                                            if($bandera == true) {
                                                $archivos = count($subido);
                                                if ($archivos == 3) {
                                                    $foto1 = $subido[0];
                                                    $foto2 = $subido[1];
                                                    $foto3 = $subido[2];
                                                } else if ($archivos == 2) {
                                                    $foto1 = $subido[0];
                                                    $foto2 = $subido[1];
                                                    $foto3 = $fotoBd[2];
                                                } else if ($archivos == 1) {
                                                    $foto1 = $subido[0];
                                                    $foto2 = $fotoBd[1];
                                                    $foto3 = $fotoBd[2];
                                                } else if ($archivos == 0) {
                                                    $foto1 = $fotoBd[0];
                                                    $foto2 = $fotoBd[1];
                                                    $foto3 = $fotoBd[2];
                                                }
                                                $precio_oferta = ($_POST['oferta'] == 1) ? $_POST['precio_oferta'] : 0; 
                                                $sql_insert = $db->query(
                                                    "UPDATE 
                                                        productos 
                                                    SET 
                                                        nombre='$data', 
                                                        precio='$precio', 
                                                        cantidad='$cantidad',  
                                                        descripcion='$detalle', 
                                                        condicion='$condicion', 
                                                        id_categoria='$categoria', 
                                                        id_subcategoria='$_POST[subcategoria]', 
                                                        marca='$marca', 
                                                        oferta='$_POST[oferta]', 
                                                        precio_oferta='$precio_oferta', 
                                                        foto1='$foto1', 
                                                        foto2='$foto2', 
                                                        foto3='$foto3' 
                                                    WHERE 
                                                        id='$_POST[id]'
                                                    ;"
                                                );      
                                                echo  
                                                '<div class="alert alert-dismissible alert-success">
                                                <button type="button" class="close" data-dismiss="alert">x</button>
                                                <strong>Completado!:</strong> El producto ha sido modificado exitosamente
                                                </div>';
                                            } else {
                                                echo 
                                                '<div class="alert alert-dismissible alert-danger">
                                                <button type="button" class="close" data-dismiss="alert">x</button>
                                                <strong>ERROR:</strong> Debes adjuntar una imagen.
                                                </div>';
                                            }
                                        } else {
                                            echo 
                                            '<div class="alert alert-dismissible alert-danger">
                                            <button type="button" class="close" data-dismiss="alert">x</button>
                                            <strong>ERROR:</strong> Debes seleccionar una imagen.
                                            </div>';
                                        }
                                    } else {
                                        echo 
                                        '<div class="alert alert-dismissible alert-danger">
                                        <button type="button" class="close" data-dismiss="alert">x</button>
                                        <strong>ERROR:</strong> La descripción del producto debe contener al menos '. LONGITUD_MIN . ' caracteres.
                                        </div>';
                                    }
                                } else {
                                    echo '<div class="alert alert-dismissible alert-danger">
                                    <button type="button" class="close" data-dismiss="alert">x</button>
                                    <strong>ERROR:</strong> La marca del producto debe contener entre '. LONGITUD_MIN_MAR . ' y ' . LONGITUD_MAX_MAR . ' caracteres.
                                    </div>';
                                }
                            } else {
                                echo 
                                '<div class="alert alert-dismissible alert-danger">
                                <button type="button" class="close" data-dismiss="alert">x</button>
                                <strong>ERROR:</strong> Debes seleccionar una categoría.
                                </div>';
                            }
                        } else {
                            echo 
                            '<div class="alert alert-dismissible alert-danger">
                            <button type="button" class="close" data-dismiss="alert">x</button>
                            <strong>ERROR:</strong> La condicion del producto no es valida.
                            </div>';
                        }
                    } else {
                        echo 
                        '<div class="alert alert-dismissible alert-danger">
                        <button type="button" class="close" data-dismiss="alert">x</button>
                        <strong>ERROR:</strong> El precio del producto debe ser mayor a ' . PRECIO_MIN_PROD . MONEDA .'.
                        </div>';
                    }           
                } else {
                    echo 
                    '<div class="alert alert-dismissible alert-danger">
                    <button type="button" class="close" data-dismiss="alert">x</button>
                    <strong>ERROR:</strong> Debe ingresar un numero valido como precio.
                    </div>';
                }        
            } else {
                echo '<div class="alert alert-dismissible alert-danger">
                <button type="button" class="close" data-dismiss="alert">x</button>
                <strong>ERROR:</strong> La cantidad debe ser un número mayor o igual a 1.
                </div>';
            }
        } else {
            echo '<div class="alert alert-dismissible alert-danger">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <strong>ERROR:</strong> El nombre del producto debe contener entre '. LONGITUD_MIN_NOM . ' y ' . LONGITUD_MAX_NOM . ' caracteres.
            </div>';
        }    
    } else {
        echo '<div class="alert alert-dismissible alert-danger">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <strong>ERROR:</strong> El producto ya existe.
        </div>';
    }
    $db->liberar($sql);
    $db->close();
} else {
  echo '<div class="alert alert-dismissible alert-danger">
  <button type="button" class="close" data-dismiss="alert">x</button>
  <strong>ERROR:</strong> Debe completar los datos obligatorios *.
  </div>';
}
    

?>