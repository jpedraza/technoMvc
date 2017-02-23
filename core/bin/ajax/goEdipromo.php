<?php


if((isset($_POST['titulo']) && $_POST['titulo'] != "")  && (isset($_POST['detalle_promo']) && $_POST['detalle_promo'] != "") && (isset($_POST['oferta']) && $_POST['oferta'] != "" && ($_POST['oferta'] == 1 || $_POST['oferta'] == 0))) {
    $db             = new Conexion();
    $titulo         = $db->real_escape_string($_POST['titulo']);
    $oferta         = $_POST['oferta'];
    $detalle_promo  = $_POST['detalle_promo'];
    $detalle_promo  = str_replace(array('<script>','</script>','<script src', '<script type='), '', $detalle_promo);
    $subido         = "";

    $sql        = $db->query("SELECT id, titulo, detalle, imagen, oferta FROM promociones WHERE id='$_POST[id]' LIMIT 1;");
    $datosBd    = $db->recorrer($sql);
    $tituloBd   = $datosBd[1];     
    $detalleBd  = $datosBd[2];     
    $imagenBd   = $datosBd[3];     
    $ofertaBd   = $datosBd[4];

    if ($tituloBd != $titulo || $detalleBd != $detalle_promo || $ofertaBd != $oferta || (isset($_FILES["imagen"]["name"]) && $_FILES["imagen"]["name"] != "") ) {

        /**
         * Verificamos que el titulo no este repetido en otra promoción
         */
        $sql = $db->query(
            "SELECT * FROM promociones WHERE titulo='$titulo' AND id != '$_POST[id]' LIMIT 1;");
        if($db->rows($sql) == 0) {

            /**
             * Verificamos que el titulo tenga una longitud establecida entre las constantes definidas en el Core
             */
            if (strlen($titulo) > LONGITUD_MIN_NOM && strlen($titulo) <= LONGITUD_MAX_TIT) {

                /**
                 * Verificamos que el valor del select de Imagen de oferta no haya sido alterado
                 */
                if ($oferta == 1 or $oferta == 0) {

                    /**
                     * Verifica que el detalle de la promoción tenga una longitud establecida entre las constantes definidas en el Core
                     */
                    if (strlen($detalle_promo) > LONGITUD_MIN_NOM && strlen($detalle_promo) <= LONGITUD_MAX_DETALLE) {

                        /**
                         * Verifica que se cargo un archivo
                         */
                        if (isset($_FILES["imagen"]["name"])) {

                            /**
                             * Verifica que no da error en la subida. Fichero subido con éxito.
                             */
                            if ($_FILES["imagen"]["error"] == UPLOAD_ERR_OK) {

                                /**
                                 * Verifica si el archivo fue subido mediante HTTP POST. 
                                 * Esto es útil para intentar asegurarse de que un usuario malicioso no ha intentado engañar 
                                 * al script haciéndole trabajar con archivos con los que no debiera de estar trabajando.
                                 */
                                if (is_uploaded_file($_FILES['imagen']['tmp_name'])) {
                                    $nombre_tmp = $_FILES["imagen"]["tmp_name"];        
                                    $nombre     = basename($_FILES["imagen"]["name"]);
                                    $sql        = $db->query("SELECT imagen FROM promociones WHERE imagen='$nombre' LIMIT 1;");

                                    /**
                                     * Verifica si existe una imagen con ese nombre en el servidor
                                     */
                                    if ($db->rows($sql) == 0) {

                                        /**
                                         * Verifica si fue movido una copia del archivo al servidor e inserta los valores en BD
                                         */
                                        if (move_uploaded_file($nombre_tmp, "views/images/home/promociones/$nombre")){
                                            $subido = $nombre;

                                            $sql = $db->query(
                                                "UPDATE
                                                    promociones
                                                SET
                                                    titulo  = '$titulo',
                                                    detalle = '$detalle_promo',
                                                    oferta  = '$oferta',
                                                    imagen  = '$nombre'
                                                WHERE
                                                    id = '$_POST[id]'
                                                ;"
                                            );
                                            unlink("views/images/home/promociones/".$imagenBd);
                                            echo  
                                            '<div class="alert alert-dismissible alert-success">
                                                <button type="button" class="close" data-dismiss="alert">x</button>
                                                <strong>Completado!</strong> La promoción ha sido modificada exitosamente.
                                            </div>';
                                        } else {
                                            echo 
                                            '<div class="alert alert-dismissible alert-danger">
                                                <button type="button" class="close" data-dismiss="alert">x</button>
                                                <strong>ERROR!</strong> Hubo un fallo al subir el archivo : '. $_FILES['imagen']['name'] .'.
                                            </div>';
                                        }
                                    } else {
                                        echo 
                                        '<div class="alert alert-dismissible alert-danger">
                                        <button type="button" class="close" data-dismiss="alert">x</button>
                                        <strong>ERROR:</strong> ya existe una imagen llamada '. $nombre . '.
                                        </div>';
                                        @unlink(ini_get('upload_tmp_dir').$_FILES['imagen']['name']);
                                    }
                                } else {
                                    echo 
                                    '<div class="alert alert-dismissible alert-danger">
                                    <button type="button" class="close" data-dismiss="alert">x</button>
                                    <strong>ERROR:</strong> posible ataque del archivo subido: '. $_FILES['imagen']['name'] .'.
                                    </div>';
                                }
                            } else if ($_FILES["imagen"]["error"] == UPLOAD_ERR_NO_FILE){
                                echo 
                                '<div class="alert alert-dismissible alert-danger">
                                    <button type="button" class="close" data-dismiss="alert">x</button>
                                    <strong>ERROR:</strong> no se subió ningúna imagen.
                                </div>';
                            } else {
                                echo 
                                '<div class="alert alert-dismissible alert-danger">
                                    <button type="button" class="close" data-dismiss="alert">x</button>
                                    <strong>ERROR:</strong> debes ingresar una imagen.
                                </div>';
                            }
                        } else {
                            $sql = $db->query(
                                "UPDATE
                                    promociones
                                SET
                                    titulo  = '$titulo',
                                    detalle = '$detalle_promo',
                                    oferta  = '$oferta'
                                WHERE
                                    id = '$_POST[id]'
                                ;"
                            );      
                            echo  
                            '<div class="alert alert-dismissible alert-success">
                                <button type="button" class="close" data-dismiss="alert">x</button>
                                <strong>Completado!</strong> La promoción ha sido modificada exitosamente.
                            </div>';
                        }
                    } else {
                        echo 
                        '<div class="alert alert-dismissible alert-danger">
                            <button type="button" class="close" data-dismiss="alert">x</button>
                            <strong>ERROR:</strong> el detalle de la promoción debe contener entre '. LONGITUD_MIN_NOM . ' caracteres y '. LONGITUD_MAX_DETALLE .'.
                        </div>';
                    }
                } else {
                    echo 
                    '<div class="alert alert-dismissible alert-danger">
                        <button type="button" class="close" data-dismiss="alert">x</button>
                        <strong>ERROR:</strong> oferta no es valida.
                    </div>';
                }
            } else {
                echo 
                '<div class="alert alert-dismissible alert-danger">
                    <button type="button" class="close" data-dismiss="alert">x</button>
                    <strong>ERROR:</strong> el titulo de la promoción debe contener entre '. LONGITUD_MIN_NOM . ' y ' . LONGITUD_MAX_TIT . ' caracteres.
                </div>';
            }    
        } else {
            echo 
            '<div class="alert alert-dismissible alert-danger">
                <button type="button" class="close" data-dismiss="alert">x</button>
                <strong>ERROR:</strong> la promoción ya existe.
            </div>';
        }
    } else{
        echo  
        '<div class="alert alert-dismissible alert-info">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <strong>Aviso:</strong> no has modificado nada.
        </div>';
    }
    $db->close();
} else {
    echo 
    '<div class="alert alert-dismissible alert-danger">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <strong>ERROR:</strong> debe completar todos los datos.
    </div>';
}
    

?>