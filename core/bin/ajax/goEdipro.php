<?php

if(!empty($_POST['nombre']) and (empty($_POST['precio']) or $_POST['precio'] != "") and isset($_POST['cantidad']) and $_POST['condicion'] != 0 and ($_POST['categoria'] == "" or is_numeric($_POST['categoria'])) and !empty($_POST['marca']) and (empty($_POST['detalle']) or $_POST['detalle'] != "")) {
    $db             = new Conexion();
    $data           = $db->real_escape_string($_POST['nombre']);
    $precio         = $_POST['precio'];
    $cantidad       = $_POST['cantidad'];
    $detalle        = $_POST['detalle'];
    $condicion      = $_POST['condicion'];
    $categoria      = $_POST['categoria'];
    $subcategoria   = $_POST['subcategoria'];
    $marca          = $db->real_escape_string($_POST['marca']);
    $oferta         = $_POST['oferta'];
    $precio_oferta  = isset($_POST['precio_oferta']) ? $_POST['precio_oferta'] : 0;
    $foto1          = isset($_FILES["foto1"]["name"]) ? $_FILES["foto1"]["name"] : "";
    $foto2          = isset($_FILES["foto2"]["name"]) ? $_FILES["foto2"]["name"] : "";
    $foto3          = isset($_FILES["foto3"]["name"]) ? $_FILES["foto3"]["name"] : "";
    $id             = $_POST['id'];

    /**
     * Busca los valores actuales del producto en BD para verificar si esta modificando algo primero
     */
    $sql            = $db->query("SELECT * FROM productos WHERE id='$id' LIMIT 1;");
    $datosBd        = $db->recorrer($sql);
    $nombreBd       = $datosBd[1];     
    $precioBd       = $datosBd[2];     
    $cantidadBd     = $datosBd[3];     
    $detalleBd      = $datosBd[4];
    $condicionBd    = $datosBd[5];
    $categoriaBd    = $datosBd[6];
    $subcategoriaBd = $datosBd[7];
    $marcaBd        = $datosBd[8];
    $ofertaBd       = $datosBd[9];
    $precio_oferBd  = $datosBd[10];
    $foto1Bd        = $datosBd[11];
    $foto2Bd        = $datosBd[12];
    $foto3Bd        = $datosBd[13];

    /**
     * Verifica si modifico algún campo (compara los valores del formulario con los de la BD)
     */
    if ($nombreBd != $data || $precioBd != $precio || $cantidadBd != $cantidad || $detalleBd != $detalle || $condicionBd != $condicion || $categoriaBd != $categoria || $subcategoriaBd != $subcategoria || $marcaBd != $marca || $ofertaBd != $oferta || $precio_oferBd != $precio_oferta || $foto1 != "" || $foto2 != "" || $foto3 != "") {

        /**
         * Verifica si se repite el nombre del producto, con otro producto en la BD
         */
        $sql = $db->query("SELECT id FROM productos WHERE nombre='$data' and id!='$id' LIMIT 1;");    
        if($db->rows($sql) == 0) {

            /**
             * Verifica que la longitud del nombre este establecida entre los parametros definidos en el core
             */
            if (strlen($data) > LONGITUD_MIN_NOM and strlen($data) < LONGITUD_MAX_NOM) {

                /**
                 * Verifica que la cantidad ingresada en existencia, sea mayor o igual a uno
                 */
                if ($cantidad >= 1) {

                    /**
                     * Verifica que el precio ingresado sea un valor numerico.
                     */
                    if (is_numeric($precio)) {

                        /**
                         * Verifica que el precio sea mayor al precio min del producto establecido en el core
                         */
                        if($precio > PRECIO_MIN_PROD) {

                            /**
                             * Verifica que la condición no haya sido modificada malisiosamente
                             */
                            if ($condicion == 1 or $condicion == 2) {

                                /**
                                 * Verifica que haya seleccionado una categoría
                                 */
                                if ($categoria > 0) {

                                    /**
                                     * Verifica que la longitud de la marca este establecida entre los parametros definidos en el core 
                                     */
                                    if (strlen($marca) >= LONGITUD_MIN_MAR and strlen($marca) <= LONGITUD_MAX_MAR) {

                                        /**
                                         * Verifica que la longitud del detalle sea mayor a los parametros definidos en el core
                                         */
                                        if ((strlen($detalle) - 10) > LONGITUD_MIN_NOM) {

                                            /**
                                             * Verifica si existe una imagen cargada 
                                             */
                                            if ($foto1 != "" || $foto2 != "" || $foto3 != "") {

                                                /**
                                                 * Verifica que la imagen se haya cargado bien
                                                 */
                                                if ($foto1 == UPLOAD_ERR_OK || $foto2 == UPLOAD_ERR_OK || $foto3 == UPLOAD_ERR_OK) {

                                                    if ($foto1 == "") {
                                                        if ($foto2 == "") {
                                                            #FOTO 3 ADJUNTADA SOLAMENTE. ACTUALIZO SOLO LA IMAGEN 3
                                                            
                                                            /**
                                                             * Verifica que no se haya atacado el servidor
                                                             */
                                                            if (is_uploaded_file($_FILES['foto3']['tmp_name'])) {
                                                                $nombre_tmp = $_FILES["foto3"]["tmp_name"];
                                                                $nombre     = basename($_FILES["foto3"]["name"]);
                                                                $sql        = $db->query(
                                                                    "SELECT 
                                                                        foto1,
                                                                        foto2,
                                                                        foto3 
                                                                    FROM 
                                                                        productos 
                                                                    WHERE 
                                                                        foto1 = '$nombre' OR foto2 = '$nombre' OR foto3 = '$nombre' 
                                                                    LIMIT 1;"
                                                                );

                                                                /**
                                                                 * Verifica que la imagen no exista en la BD y por ende en el servidor
                                                                 */
                                                                if ($db->rows($sql) == 0) {

                                                                    /**
                                                                     * Verifica si se subio correctamente una copia de la imagen al servidor.
                                                                     * De ser true, actualiza los demas campos en la BD.
                                                                     * Luego borra la img anterior del servidor, si no es la establecida por default.
                                                                     */
                                                                    if (move_uploaded_file($nombre_tmp, "views/images/productos/$nombre")){
                                                                        $precio_oferta == $precio_oferBd ? $precio_oferta = $precio_oferBd : $precio_oferta = $precio_oferta;
                                                                        $oferta == 1 ? $precio_oferta = $precio_oferta : $precio_oferta = 0; 
                                                                        $db->query(
                                                                            "UPDATE 
                                                                                productos 
                                                                            SET 
                                                                                nombre          = '$data', 
                                                                                precio          = '$precio', 
                                                                                cantidad        = '$cantidad',  
                                                                                descripcion     = '$detalle', 
                                                                                condicion       = '$condicion', 
                                                                                id_categoria    = '$categoria', 
                                                                                id_subcategoria = '$subcategoria', 
                                                                                marca           = '$marca', 
                                                                                oferta          = '$oferta', 
                                                                                precio_oferta   = '$precio_oferta', 
                                                                                foto3           = '$foto3' 
                                                                            WHERE 
                                                                                id='$id'
                                                                            ;"
                                                                        );
                                                                        $foto3Bd != "default.jpg" ? unlink("views/images/productos/".$foto3Bd) : null;      
                                                                        echo  
                                                                        '<div class="alert alert-dismissible alert-success">
                                                                        <button type="button" class="close" data-dismiss="alert">x</button>
                                                                        <strong>Completado!:</strong> El producto ha sido modificado exitosamente.
                                                                        </div>';          
                                                                    } else {
                                                                        echo 
                                                                        '<div class="alert alert-dismissible alert-danger">
                                                                        <button type="button" class="close" data-dismiss="alert">x</button>
                                                                        <strong>ERROR!</strong> Hubo un fallo al subir el archivo: '. $_FILES['foto3']['name'].'.
                                                                        </div>';
                                                                    }
                                                                } else {
                                                                    echo 
                                                                    '<div class="alert alert-dismissible alert-danger">
                                                                    <button type="button" class="close" data-dismiss="alert">x</button>
                                                                    <strong>ERROR!</strong> ya existe un archivo llamado '. $nombre . '.
                                                                    </div>';
                                                                    @unlink(ini_get('upload_tmp_dir').$_FILES['foto3']['name']);
                                                                }
                                                            } else {
                                                                echo 
                                                                '<div class="alert alert-dismissible alert-danger">
                                                                <button type="button" class="close" data-dismiss="alert">x</button>
                                                                <strong>ERROR!</strong> Posible ataque del archivo subido: '. $_FILES['foto3']['name'] .'.
                                                                </div>';
                                                            }
                                                        } elseif ($foto3 == "") {
                                                            # FOTO 2 ADJUNTADA SOLAMENTE. ACTUALIZO SOLO LA IMAGEN 2
                                                            
                                                            /**
                                                             * Verifica que no se haya atacado el servidor
                                                             */
                                                            if (is_uploaded_file($_FILES['foto2']['tmp_name'])) {
                                                                $nombre_tmp = $_FILES["foto2"]["tmp_name"];
                                                                $nombre     = basename($_FILES["foto2"]["name"]);
                                                                $sql        = $db->query(
                                                                    "SELECT 
                                                                        foto1,
                                                                        foto2,
                                                                        foto3 
                                                                    FROM 
                                                                        productos 
                                                                    WHERE 
                                                                        foto1 = '$nombre' OR foto2 = '$nombre' OR foto3 = '$nombre' 
                                                                    LIMIT 1;"
                                                                );

                                                                /**
                                                                 * Verifica que la imagen no exista en la BD y por ende en el servidor
                                                                 */
                                                                if ($db->rows($sql) == 0) {

                                                                    /**
                                                                     * Verifica si se subio correctamente una copia de la imagen al servidor.
                                                                     * De ser true, actualiza los demas campos en la BD.
                                                                     * Luego borra la img anterior del servidor, si no es la establecida por default.
                                                                     */
                                                                    if (move_uploaded_file($nombre_tmp, "views/images/productos/$nombre")){
                                                                        $precio_oferta == $precio_oferBd ? $precio_oferta = $precio_oferBd : $precio_oferta = $precio_oferta;
                                                                        $oferta == 1 ? $precio_oferta = $precio_oferta : $precio_oferta = 0; 
                                                                        $db->query(
                                                                            "UPDATE 
                                                                                productos 
                                                                            SET 
                                                                                nombre          = '$data', 
                                                                                precio          = '$precio', 
                                                                                cantidad        = '$cantidad',  
                                                                                descripcion     = '$detalle', 
                                                                                condicion       = '$condicion', 
                                                                                id_categoria    = '$categoria', 
                                                                                id_subcategoria = '$subcategoria', 
                                                                                marca           = '$marca', 
                                                                                oferta          = '$oferta', 
                                                                                precio_oferta   = '$precio_oferta', 
                                                                                foto2           = '$foto2' 
                                                                            WHERE 
                                                                                id='$id'
                                                                            ;"
                                                                        );
                                                                        $foto2Bd != "default.jpg" ? unlink("views/images/productos/".$foto2Bd) : null;      
                                                                        echo  
                                                                        '<div class="alert alert-dismissible alert-success">
                                                                        <button type="button" class="close" data-dismiss="alert">x</button>
                                                                        <strong>Completado!</strong> El producto ha sido modificado exitosamente.
                                                                        </div>';          
                                                                    } else {
                                                                        echo 
                                                                        '<div class="alert alert-dismissible alert-danger">
                                                                        <button type="button" class="close" data-dismiss="alert">x</button>
                                                                        <strong>ERROR!</strong> Hubo un fallo al subir el archivo: '. $_FILES['foto2']['name'].'.
                                                                        </div>';
                                                                    }
                                                                } else {
                                                                    echo 
                                                                    '<div class="alert alert-dismissible alert-danger">
                                                                    <button type="button" class="close" data-dismiss="alert">x</button>
                                                                    <strong>ERROR!</strong> ya existe un archivo llamado '. $nombre . '.
                                                                    </div>';
                                                                    @unlink(ini_get('upload_tmp_dir').$_FILES['foto2']['name']);
                                                                }
                                                            } else {
                                                                echo 
                                                                '<div class="alert alert-dismissible alert-danger">
                                                                <button type="button" class="close" data-dismiss="alert">x</button>
                                                                <strong>ERROR!</strong> Posible ataque del archivo subido: '. $_FILES['foto2']['name'] .'.
                                                                </div>';
                                                            }

                                                        } else {
                                                            # FOTO 2 Y 3 ADJUNTAS. ACTUALIZO IMAGEN 2 Y 3 SOLAMENTE

                                                            /**
                                                             * Verifica que no se haya atacado el servidor
                                                             */
                                                            if (is_uploaded_file($_FILES['foto2']['tmp_name']) && is_uploaded_file($_FILES['foto3']['tmp_name'])) {
                                                                $nombre_tmp  = $_FILES["foto2"]["tmp_name"];
                                                                $nombre_tmp3 = $_FILES["foto3"]["tmp_name"];
                                                                $nombre      = basename($_FILES["foto2"]["name"]);
                                                                $nombre3     = basename($_FILES["foto3"]["name"]);
                                                                $sql         = $db->query(
                                                                    "SELECT 
                                                                        foto1,
                                                                        foto2,
                                                                        foto3 
                                                                    FROM 
                                                                        productos 
                                                                    WHERE 
                                                                        foto1 = '$nombre' OR foto2 = '$nombre' OR foto3 = '$nombre' 
                                                                    LIMIT 1;"
                                                                );

                                                                $sql2 = $db->query(
                                                                    "SELECT 
                                                                        foto1,
                                                                        foto2,
                                                                        foto3 
                                                                    FROM 
                                                                        productos 
                                                                    WHERE 
                                                                        foto1 = '$nombre3' OR foto2 = '$nombre3' OR foto3 = '$nombre3' 
                                                                    LIMIT 1;"
                                                                );

                                                                /**
                                                                 * Verifica que las imagenes no existan en la BD y por ende en el servidor
                                                                 */
                                                                if ($db->rows($sql) == 0) {
                                                                    if ($db->rows($sql2) == 0) {

                                                                        /**
                                                                         * Verifica si se subio correctamente una copia de la imagen al servidor.
                                                                         * De ser true, actualiza los demas campos en la BD.
                                                                         * Luego borra la img anterior del servidor, si no es la establecida por default.
                                                                         */
                                                                        if (move_uploaded_file($nombre_tmp, "views/images/productos/$nombre")){
                                                                            if (move_uploaded_file($nombre_tmp3, "views/images/productos/$nombre3")){
                                                                                $precio_oferta == $precio_oferBd ? $precio_oferta = $precio_oferBd : $precio_oferta = $precio_oferta;
                                                                                $oferta == 1 ? $precio_oferta = $precio_oferta : $precio_oferta = 0; 
                                                                                $db->query(
                                                                                    "UPDATE 
                                                                                        productos 
                                                                                    SET 
                                                                                        nombre          = '$data', 
                                                                                        precio          = '$precio', 
                                                                                        cantidad        = '$cantidad',  
                                                                                        descripcion     = '$detalle', 
                                                                                        condicion       = '$condicion', 
                                                                                        id_categoria    = '$categoria', 
                                                                                        id_subcategoria = '$subcategoria', 
                                                                                        marca           = '$marca', 
                                                                                        oferta          = '$oferta', 
                                                                                        precio_oferta   = '$precio_oferta', 
                                                                                        foto2           = '$foto2', 
                                                                                        foto3           = '$foto3' 
                                                                                    WHERE 
                                                                                        id='$id'
                                                                                    ;"
                                                                                );
                                                                                $foto2Bd != "default.jpg" ? unlink("views/images/productos/".$foto2Bd) : null;      
                                                                                $foto3Bd != "default.jpg" ? unlink("views/images/productos/".$foto3Bd) : null;      
                                                                                echo  
                                                                                '<div class="alert alert-dismissible alert-success">
                                                                                <button type="button" class="close" data-dismiss="alert">x</button>
                                                                                <strong>Completado!</strong> El producto ha sido modificado exitosamente.
                                                                                </div>';
                                                                            } else {
                                                                                echo 
                                                                                '<div class="alert alert-dismissible alert-danger">
                                                                                <button type="button" class="close" data-dismiss="alert">x</button>
                                                                                <strong>ERROR!</strong> Hubo un fallo al subir el archivo: '. $_FILES['foto3']['name'].'.
                                                                                </div>';
                                                                            }          
                                                                        } else {
                                                                            echo 
                                                                            '<div class="alert alert-dismissible alert-danger">
                                                                            <button type="button" class="close" data-dismiss="alert">x</button>
                                                                            <strong>ERROR!</strong> Hubo un fallo al subir el archivo: '. $_FILES['foto2']['name'].'.
                                                                            </div>';
                                                                        }
                                                                    } else {
                                                                        echo 
                                                                        '<div class="alert alert-dismissible alert-danger">
                                                                        <button type="button" class="close" data-dismiss="alert">x</button>
                                                                        <strong>ERROR!</strong> ya existe un archivo llamado '. $nombre3 . '.
                                                                        </div>';
                                                                        @unlink(ini_get('upload_tmp_dir').$_FILES['foto3']['name']);
                                                                    }
                                                                } else {
                                                                    echo 
                                                                    '<div class="alert alert-dismissible alert-danger">
                                                                    <button type="button" class="close" data-dismiss="alert">x</button>
                                                                    <strong>ERROR!</strong> ya existe un archivo llamado '. $nombre . '.
                                                                    </div>';
                                                                    @unlink(ini_get('upload_tmp_dir').$_FILES['foto2']['name']);
                                                                }
                                                            } else {
                                                                echo 
                                                                '<div class="alert alert-dismissible alert-danger">
                                                                <button type="button" class="close" data-dismiss="alert">x</button>
                                                                <strong>ERROR!</strong> Posible ataque de los archivos subido: '. $_FILES['foto2']['name'] .' y/o '. $_FILES['foto3']['name'] .'.
                                                                </div>';
                                                            }
                                                        }
                                                    } elseif ($foto2 == "") {
                                                        if ($foto3 == "") {
                                                            # FOTO 1 ADJUNTA. ACTUALIZO IMAGEN 1 SOLAMENTE
                                                            
                                                            /**
                                                             * Verifica que no se haya atacado el servidor
                                                             */
                                                            if (is_uploaded_file($_FILES['foto1']['tmp_name'])) {
                                                                $nombre_tmp = $_FILES["foto1"]["tmp_name"];
                                                                $nombre     = basename($_FILES["foto1"]["name"]);
                                                                $sql        = $db->query(
                                                                    "SELECT 
                                                                        foto1,
                                                                        foto2,
                                                                        foto3 
                                                                    FROM 
                                                                        productos 
                                                                    WHERE 
                                                                        foto1 = '$nombre' OR foto2 = '$nombre' OR foto3 = '$nombre' 
                                                                    LIMIT 1;"
                                                                );

                                                                /**
                                                                 * Verifica que la imagen no exista en la BD y por ende en el servidor
                                                                 */
                                                                if ($db->rows($sql) == 0) {

                                                                    /**
                                                                     * Verifica si se subio correctamente una copia de la imagen al servidor.
                                                                     * De ser true, actualiza los demas campos en la BD.
                                                                     * Luego borra la img anterior del servidor, si no es la establecida por default.
                                                                     */
                                                                    if (move_uploaded_file($nombre_tmp, "views/images/productos/$nombre")){
                                                                        $precio_oferta == $precio_oferBd ? $precio_oferta = $precio_oferBd : $precio_oferta = $precio_oferta;
                                                                        $oferta == 1 ? $precio_oferta = $precio_oferta : $precio_oferta = 0; 
                                                                        $db->query(
                                                                            "UPDATE 
                                                                                productos 
                                                                            SET 
                                                                                nombre          = '$data', 
                                                                                precio          = '$precio', 
                                                                                cantidad        = '$cantidad',  
                                                                                descripcion     = '$detalle', 
                                                                                condicion       = '$condicion', 
                                                                                id_categoria    = '$categoria', 
                                                                                id_subcategoria = '$subcategoria', 
                                                                                marca           = '$marca', 
                                                                                oferta          = '$oferta', 
                                                                                precio_oferta   = '$precio_oferta', 
                                                                                foto1           = '$foto1' 
                                                                            WHERE 
                                                                                id='$id'
                                                                            ;"
                                                                        );
                                                                        $foto1Bd != "default.jpg" ? unlink("views/images/productos/".$foto1Bd) : null;      
                                                                        echo  
                                                                        '<div class="alert alert-dismissible alert-success">
                                                                        <button type="button" class="close" data-dismiss="alert">x</button>
                                                                        <strong>Completado!</strong> El producto ha sido modificado exitosamente.
                                                                        </div>';          
                                                                    } else {
                                                                        echo 
                                                                        '<div class="alert alert-dismissible alert-danger">
                                                                        <button type="button" class="close" data-dismiss="alert">x</button>
                                                                        <strong>ERROR!</strong> Hubo un fallo al subir el archivo: '. $_FILES['foto1']['name'].'.
                                                                        </div>';
                                                                    }
                                                                } else {
                                                                    echo 
                                                                    '<div class="alert alert-dismissible alert-danger">
                                                                    <button type="button" class="close" data-dismiss="alert">x</button>
                                                                    <strong>ERROR!</strong> ya existe un archivo llamado '. $nombre . '.
                                                                    </div>';
                                                                    @unlink(ini_get('upload_tmp_dir').$_FILES['foto1']['name']);
                                                                }
                                                            } else {
                                                                echo 
                                                                '<div class="alert alert-dismissible alert-danger">
                                                                <button type="button" class="close" data-dismiss="alert">x</button>
                                                                <strong>ERROR!</strong> Posible ataque del archivo subido: '. $_FILES['foto1']['name'] .'.
                                                                </div>';
                                                            }
                                                        } else {
                                                            # FOTO 1 Y 3 ADJUNTAS. ACTUALIZO IMAGEN 1 Y 3 SOLAMENTE
                                                            
                                                            /**
                                                             * Verifica que no se haya atacado el servidor
                                                             */
                                                            if (is_uploaded_file($_FILES['foto1']['tmp_name']) && is_uploaded_file($_FILES['foto3']['tmp_name'])) {
                                                                $nombre_tmp  = $_FILES["foto1"]["tmp_name"];
                                                                $nombre_tmp3 = $_FILES["foto3"]["tmp_name"];
                                                                $nombre      = basename($_FILES["foto1"]["name"]);
                                                                $nombre3     = basename($_FILES["foto3"]["name"]);
                                                                $sql         = $db->query(
                                                                    "SELECT 
                                                                        foto1,
                                                                        foto2,
                                                                        foto3 
                                                                    FROM 
                                                                        productos 
                                                                    WHERE 
                                                                        foto1 = '$nombre' OR foto2 = '$nombre' OR foto3 = '$nombre' 
                                                                    LIMIT 1;"
                                                                );

                                                                $sql2 = $db->query(
                                                                    "SELECT 
                                                                        foto1,
                                                                        foto2,
                                                                        foto3 
                                                                    FROM 
                                                                        productos 
                                                                    WHERE 
                                                                        foto1 = '$nombre3' OR foto2 = '$nombre3' OR foto3 = '$nombre3' 
                                                                    LIMIT 1;"
                                                                );

                                                                /**
                                                                 * Verifica que las imagenes no existan en la BD y por ende en el servidor
                                                                 */
                                                                if ($db->rows($sql) == 0) {
                                                                    if ($db->rows($sql2) == 0) {

                                                                        /**
                                                                         * Verifica si se subio correctamente una copia de la imagen al servidor.
                                                                         * De ser true, actualiza los demas campos en la BD.
                                                                         * Luego borra la img anterior del servidor, si no es la establecida por default.
                                                                         */
                                                                        if (move_uploaded_file($nombre_tmp, "views/images/productos/$nombre")){
                                                                            if (move_uploaded_file($nombre_tmp3, "views/images/productos/$nombre3")){
                                                                                $precio_oferta == $precio_oferBd ? $precio_oferta = $precio_oferBd : $precio_oferta = $precio_oferta;
                                                                                $oferta == 1 ? $precio_oferta = $precio_oferta : $precio_oferta = 0; 
                                                                                $db->query(
                                                                                    "UPDATE 
                                                                                        productos 
                                                                                    SET 
                                                                                        nombre          = '$data', 
                                                                                        precio          = '$precio', 
                                                                                        cantidad        = '$cantidad',  
                                                                                        descripcion     = '$detalle', 
                                                                                        condicion       = '$condicion', 
                                                                                        id_categoria    = '$categoria', 
                                                                                        id_subcategoria = '$subcategoria', 
                                                                                        marca           = '$marca', 
                                                                                        oferta          = '$oferta', 
                                                                                        precio_oferta   = '$precio_oferta', 
                                                                                        foto1           = '$foto1', 
                                                                                        foto3           = '$foto3' 
                                                                                    WHERE 
                                                                                        id='$id'
                                                                                    ;"
                                                                                );
                                                                                $foto1Bd != "default.jpg" ? unlink("views/images/productos/".$foto1Bd) : null;      
                                                                                $foto3Bd != "default.jpg" ? unlink("views/images/productos/".$foto3Bd) : null;      
                                                                                echo  
                                                                                '<div class="alert alert-dismissible alert-success">
                                                                                <button type="button" class="close" data-dismiss="alert">x</button>
                                                                                <strong>Completado!</strong> El producto ha sido modificado exitosamente.
                                                                                </div>';
                                                                            } else {
                                                                                echo 
                                                                                '<div class="alert alert-dismissible alert-danger">
                                                                                <button type="button" class="close" data-dismiss="alert">x</button>
                                                                                <strong>ERROR!</strong> Hubo un fallo al subir el archivo: '. $_FILES['foto3']['name'].'.
                                                                                </div>';
                                                                            }          
                                                                        } else {
                                                                            echo 
                                                                            '<div class="alert alert-dismissible alert-danger">
                                                                            <button type="button" class="close" data-dismiss="alert">x</button>
                                                                            <strong>ERROR!</strong> Hubo un fallo al subir el archivo: '. $_FILES['foto1']['name'].'.
                                                                            </div>';
                                                                        }
                                                                    } else {
                                                                        echo 
                                                                        '<div class="alert alert-dismissible alert-danger">
                                                                        <button type="button" class="close" data-dismiss="alert">x</button>
                                                                        <strong>ERROR!</strong> ya existe un archivo llamado '. $nombre3 . '.
                                                                        </div>';
                                                                        @unlink(ini_get('upload_tmp_dir').$_FILES['foto3']['name']);
                                                                    }
                                                                } else {
                                                                    echo 
                                                                    '<div class="alert alert-dismissible alert-danger">
                                                                    <button type="button" class="close" data-dismiss="alert">x</button>
                                                                    <strong>ERROR!</strong> ya existe un archivo llamado '. $nombre . '.
                                                                    </div>';
                                                                    @unlink(ini_get('upload_tmp_dir').$_FILES['foto1']['name']);
                                                                }
                                                            } else {
                                                                echo 
                                                                '<div class="alert alert-dismissible alert-danger">
                                                                <button type="button" class="close" data-dismiss="alert">x</button>
                                                                <strong>ERROR!</strong> Posible ataque de los archivos subido: '. $_FILES['foto1']['name'] .' y/o '. $_FILES['foto3']['name'] .'.
                                                                </div>';
                                                            }
                                                        }
                                                    } elseif ($foto3 == "") {                                                        
                                                        # FOTO 1 Y 2 ADJUNTAS. ACTUALIZO IMAGEN 1 Y 2 SOLAMENTE
                                                            
                                                        /**
                                                         * Verifica que no se haya atacado el servidor
                                                         */
                                                        if (is_uploaded_file($_FILES['foto1']['tmp_name']) && is_uploaded_file($_FILES['foto2']['tmp_name'])) {
                                                            $nombre_tmp  = $_FILES["foto1"]["tmp_name"];
                                                            $nombre_tmp2 = $_FILES["foto2"]["tmp_name"];
                                                            $nombre      = basename($_FILES["foto1"]["name"]);
                                                            $nombre2     = basename($_FILES["foto2"]["name"]);
                                                            $sql         = $db->query(
                                                                "SELECT 
                                                                    foto1,
                                                                    foto2,
                                                                    foto3 
                                                                FROM 
                                                                    productos 
                                                                WHERE 
                                                                    foto1 = '$nombre' OR foto2 = '$nombre' OR foto3 = '$nombre' 
                                                                LIMIT 1;"
                                                            );

                                                            $sql2 = $db->query(
                                                                "SELECT 
                                                                    foto1,
                                                                    foto2,
                                                                    foto3 
                                                                FROM 
                                                                    productos 
                                                                WHERE 
                                                                    foto1 = '$nombre2' OR foto2 = '$nombre2' OR foto3 = '$nombre2' 
                                                                LIMIT 1;"
                                                            );

                                                            /**
                                                             * Verifica que las imagenes no existan en la BD y por ende en el servidor
                                                             */
                                                            if ($db->rows($sql) == 0) {
                                                                if ($db->rows($sql2) == 0) {

                                                                    /**
                                                                     * Verifica si se subio correctamente una copia de la imagen al servidor.
                                                                     * De ser true, actualiza los demas campos en la BD.
                                                                     * Luego borra la img anterior del servidor, si no es la establecida por default.
                                                                     */
                                                                    if (move_uploaded_file($nombre_tmp, "views/images/productos/$nombre")){
                                                                        if (move_uploaded_file($nombre_tmp2, "views/images/productos/$nombre2")){
                                                                            $precio_oferta == $precio_oferBd ? $precio_oferta = $precio_oferBd : $precio_oferta = $precio_oferta;
                                                                            $oferta == 1 ? $precio_oferta = $precio_oferta : $precio_oferta = 0; 
                                                                            $db->query(
                                                                                "UPDATE 
                                                                                    productos 
                                                                                SET 
                                                                                    nombre          = '$data', 
                                                                                    precio          = '$precio', 
                                                                                    cantidad        = '$cantidad',  
                                                                                    descripcion     = '$detalle', 
                                                                                    condicion       = '$condicion', 
                                                                                    id_categoria    = '$categoria', 
                                                                                    id_subcategoria = '$subcategoria', 
                                                                                    marca           = '$marca', 
                                                                                    oferta          = '$oferta', 
                                                                                    precio_oferta   = '$precio_oferta', 
                                                                                    foto1           = '$foto1', 
                                                                                    foto2           = '$foto2' 
                                                                                WHERE 
                                                                                    id='$id'
                                                                                ;"
                                                                            );
                                                                            $foto1Bd != "default.jpg" ? unlink("views/images/productos/".$foto1Bd) : null;      
                                                                            $foto2Bd != "default.jpg" ? unlink("views/images/productos/".$foto2Bd) : null;      
                                                                            echo  
                                                                            '<div class="alert alert-dismissible alert-success">
                                                                            <button type="button" class="close" data-dismiss="alert">x</button>
                                                                            <strong>Completado!</strong> El producto ha sido modificado exitosamente.
                                                                            </div>';
                                                                        } else {
                                                                            echo 
                                                                            '<div class="alert alert-dismissible alert-danger">
                                                                            <button type="button" class="close" data-dismiss="alert">x</button>
                                                                            <strong>ERROR!</strong> Hubo un fallo al subir el archivo: '. $_FILES['foto2']['name'].'.
                                                                            </div>';
                                                                        }          
                                                                    } else {
                                                                        echo 
                                                                        '<div class="alert alert-dismissible alert-danger">
                                                                        <button type="button" class="close" data-dismiss="alert">x</button>
                                                                        <strong>ERROR!</strong> Hubo un fallo al subir el archivo: '. $_FILES['foto1']['name'].'.
                                                                        </div>';
                                                                    }
                                                                } else {
                                                                    echo 
                                                                    '<div class="alert alert-dismissible alert-danger">
                                                                    <button type="button" class="close" data-dismiss="alert">x</button>
                                                                    <strong>ERROR!</strong> ya existe un archivo llamado '. $nombre2 . '.
                                                                    </div>';
                                                                    @unlink(ini_get('upload_tmp_dir').$_FILES['foto2']['name']);
                                                                }
                                                            } else {
                                                                echo 
                                                                '<div class="alert alert-dismissible alert-danger">
                                                                <button type="button" class="close" data-dismiss="alert">x</button>
                                                                <strong>ERROR!</strong> ya existe un archivo llamado '. $nombre . '.
                                                                </div>';
                                                                @unlink(ini_get('upload_tmp_dir').$_FILES['foto1']['name']);
                                                            }
                                                        } else {
                                                            echo 
                                                            '<div class="alert alert-dismissible alert-danger">
                                                            <button type="button" class="close" data-dismiss="alert">x</button>
                                                            <strong>ERROR!</strong> Posible ataque de los archivos subido: '. $_FILES['foto1']['name'] .' y/o '. $_FILES['foto2']['name'] .'.
                                                            </div>';
                                                        }
                                                    } else {
                                                        # FOTO 1, 2 y 3 ADJUNTAS. ACTUALIZO TODAS LAS IMAGENES
                                                        
                                                        /**
                                                         * Verifica que no se haya atacado el servidor
                                                         */
                                                        if (is_uploaded_file($_FILES['foto1']['tmp_name']) && is_uploaded_file($_FILES['foto2']['tmp_name']) && is_uploaded_file($_FILES['foto3']['tmp_name'])) {
                                                            $nombre_tmp  = $_FILES["foto1"]["tmp_name"];
                                                            $nombre_tmp2 = $_FILES["foto2"]["tmp_name"];
                                                            $nombre_tmp3 = $_FILES["foto3"]["tmp_name"];
                                                            $nombre      = basename($_FILES["foto1"]["name"]);
                                                            $nombre2     = basename($_FILES["foto2"]["name"]);
                                                            $nombre3     = basename($_FILES["foto3"]["name"]);
                                                            $sql         = $db->query(
                                                                "SELECT 
                                                                    foto1,
                                                                    foto2,
                                                                    foto3 
                                                                FROM 
                                                                    productos 
                                                                WHERE 
                                                                    foto1 = '$nombre' OR foto2 = '$nombre' OR foto3 = '$nombre' 
                                                                LIMIT 1;"
                                                            );

                                                            $sql2 = $db->query(
                                                                "SELECT 
                                                                    foto1,
                                                                    foto2,
                                                                    foto3 
                                                                FROM 
                                                                    productos 
                                                                WHERE 
                                                                    foto1 = '$nombre2' OR foto2 = '$nombre2' OR foto3 = '$nombre2' 
                                                                LIMIT 1;"
                                                            );

                                                            $sql3 = $db->query(
                                                                "SELECT 
                                                                    foto1,
                                                                    foto2,
                                                                    foto3 
                                                                FROM 
                                                                    productos 
                                                                WHERE 
                                                                    foto1 = '$nombre3' OR foto2 = '$nombre3' OR foto3 = '$nombre3' 
                                                                LIMIT 1;"
                                                            );

                                                            /**
                                                             * Verifica que las imagenes no existan en la BD y por ende en el servidor
                                                             */
                                                            if ($db->rows($sql) == 0) {
                                                                if ($db->rows($sql2) == 0) {
                                                                    if ($db->rows($sql3) == 0) {

                                                                        /**
                                                                         * Verifica si se subio correctamente una copia de la imagen al servidor.
                                                                         * De ser true, actualiza los demas campos en la BD.
                                                                         * Luego borra la img anterior del servidor, si no es la establecida por default.
                                                                         */
                                                                        if (move_uploaded_file($nombre_tmp, "views/images/productos/$nombre")){
                                                                            if (move_uploaded_file($nombre_tmp2, "views/images/productos/$nombre2")){
                                                                                if (move_uploaded_file($nombre_tmp3, "views/images/productos/$nombre3")){
                                                                                    $precio_oferta == $precio_oferBd ? $precio_oferta = $precio_oferBd : $precio_oferta = $precio_oferta; 
                                                                                    $oferta == 1 ? $precio_oferta = $precio_oferta : $precio_oferta = 0; 
                                                                                    $db->query(
                                                                                        "UPDATE 
                                                                                            productos 
                                                                                        SET 
                                                                                            nombre          = '$data', 
                                                                                            precio          = '$precio', 
                                                                                            cantidad        = '$cantidad',  
                                                                                            descripcion     = '$detalle', 
                                                                                            condicion       = '$condicion', 
                                                                                            id_categoria    = '$categoria', 
                                                                                            id_subcategoria = '$subcategoria', 
                                                                                            marca           = '$marca', 
                                                                                            oferta          = '$oferta', 
                                                                                            precio_oferta   = '$precio_oferta', 
                                                                                            foto1           = '$foto1', 
                                                                                            foto2           = '$foto2', 
                                                                                            foto3           = '$foto3' 
                                                                                        WHERE 
                                                                                            id='$id'
                                                                                        ;"
                                                                                    );
                                                                                    $foto1Bd != "default.jpg" ? unlink("views/images/productos/".$foto1Bd) : null;      
                                                                                    $foto2Bd != "default.jpg" ? unlink("views/images/productos/".$foto2Bd) : null;      
                                                                                    $foto3Bd != "default.jpg" ? unlink("views/images/productos/".$foto3Bd) : null;      
                                                                                    echo  
                                                                                    '<div class="alert alert-dismissible alert-success">
                                                                                    <button type="button" class="close" data-dismiss="alert">x</button>
                                                                                    <strong>Completado!</strong> El producto ha sido modificado exitosamente.
                                                                                    </div>';
                                                                                } else {
                                                                                    echo 
                                                                                    '<div class="alert alert-dismissible alert-danger">
                                                                                    <button type="button" class="close" data-dismiss="alert">x</button>
                                                                                    <strong>ERROR!</strong> Hubo un fallo al subir el archivo: '. $_FILES['foto3']['name'].'.
                                                                                    </div>';
                                                                                }
                                                                            } else {
                                                                                echo 
                                                                                '<div class="alert alert-dismissible alert-danger">
                                                                                <button type="button" class="close" data-dismiss="alert">x</button>
                                                                                <strong>ERROR!</strong> Hubo un fallo al subir el archivo: '. $_FILES['foto2']['name'].'.
                                                                                </div>';
                                                                            }          
                                                                        } else {
                                                                            echo 
                                                                            '<div class="alert alert-dismissible alert-danger">
                                                                            <button type="button" class="close" data-dismiss="alert">x</button>
                                                                            <strong>ERROR!</strong> Hubo un fallo al subir el archivo: '. $_FILES['foto1']['name'].'.
                                                                            </div>';
                                                                        }
                                                                    } else {
                                                                        echo 
                                                                        '<div class="alert alert-dismissible alert-danger">
                                                                        <button type="button" class="close" data-dismiss="alert">x</button>
                                                                        <strong>ERROR!</strong> ya existe un archivo llamado '. $nombre3 . '.
                                                                        </div>';
                                                                        @unlink(ini_get('upload_tmp_dir').$_FILES['foto3']['name']);
                                                                        $db->liberar($sql3);
                                                                    }
                                                                } else {
                                                                    echo 
                                                                    '<div class="alert alert-dismissible alert-danger">
                                                                    <button type="button" class="close" data-dismiss="alert">x</button>
                                                                    <strong>ERROR!</strong> ya existe un archivo llamado '. $nombre2 . '.
                                                                    </div>';
                                                                    @unlink(ini_get('upload_tmp_dir').$_FILES['foto2']['name']);
                                                                    $db->liberar($sql2);
                                                                }
                                                            } else {
                                                                echo 
                                                                '<div class="alert alert-dismissible alert-danger">
                                                                <button type="button" class="close" data-dismiss="alert">x</button>
                                                                <strong>ERROR!</strong> ya existe un archivo llamado '. $nombre . '.
                                                                </div>';
                                                                @unlink(ini_get('upload_tmp_dir').$_FILES['foto1']['name']);
                                                                $db->liberar($sql);
                                                            }
                                                        } else {
                                                            echo 
                                                            '<div class="alert alert-dismissible alert-danger">
                                                            <button type="button" class="close" data-dismiss="alert">x</button>
                                                            <strong>ERROR!</strong> Posible ataque de los archivos subido: '. $_FILES['foto1']['name'] .' y/o '. $_FILES['foto2']['name'] .' y/o '. $_FILES['foto3']['name'] .'.
                                                            </div>';
                                                        }
                                                    }  
                                                } else {
                                                   echo 
                                                    '<div class="alert alert-dismissible alert-danger">
                                                    <button type="button" class="close" data-dismiss="alert">x</button>
                                                    <strong>ERROR!</strong> hubo un error subiendo la imagen, intente nuevamente.
                                                    </div>';
                                                    exit; 
                                                }
                                            } else {
                                                /**
                                                 * Si no adjunta imagen, actualizo solo los datos del formulario.
                                                 */
                                                $oferta == 1 ? $precio_oferta = $precio_oferta : $precio_oferta = 0; 
                                                $db->query(
                                                    "UPDATE 
                                                        productos 
                                                    SET 
                                                        nombre='$data', 
                                                        precio='$precio', 
                                                        cantidad='$cantidad',  
                                                        descripcion='$detalle', 
                                                        condicion='$condicion', 
                                                        id_categoria='$categoria', 
                                                        id_subcategoria='$subcategoria', 
                                                        marca='$marca', 
                                                        oferta='$oferta', 
                                                        precio_oferta='$precio_oferta'
                                                    WHERE 
                                                        id='$id'
                                                    ;"
                                                );      
                                                echo  
                                                '<div class="alert alert-dismissible alert-success">
                                                <button type="button" class="close" data-dismiss="alert">x</button>
                                                <strong>Completado!:</strong> El producto ha sido modificado exitosamente
                                                </div>';
                                            }
                                        } else {
                                            echo 
                                            '<div class="alert alert-dismissible alert-danger">
                                            <button type="button" class="close" data-dismiss="alert">x</button>
                                            <strong>ERROR!</strong> La descripción del producto debe contener al menos '. LONGITUD_MIN . ' caracteres.
                                            </div>';
                                        }
                                    } else {
                                        echo '<div class="alert alert-dismissible alert-danger">
                                        <button type="button" class="close" data-dismiss="alert">x</button>
                                        <strong>ERROR!</strong> La marca del producto debe contener entre '. LONGITUD_MIN_MAR . ' y ' . LONGITUD_MAX_MAR . ' caracteres.
                                        </div>';
                                    }
                                } else {
                                    echo 
                                    '<div class="alert alert-dismissible alert-danger">
                                    <button type="button" class="close" data-dismiss="alert">x</button>
                                    <strong>ERROR!</strong> Debes seleccionar una categoría.
                                    </div>';
                                }
                            } else {
                                echo 
                                '<div class="alert alert-dismissible alert-danger">
                                <button type="button" class="close" data-dismiss="alert">x</button>
                                <strong>ERROR!</strong> La condicion del producto no es valida.
                                </div>';
                            }
                        } else {
                            echo 
                            '<div class="alert alert-dismissible alert-danger">
                            <button type="button" class="close" data-dismiss="alert">x</button>
                            <strong>ERROR!</strong> El precio del producto debe ser mayor a ' . PRECIO_MIN_PROD . MONEDA .'.
                            </div>';
                        }           
                    } else {
                        echo 
                        '<div class="alert alert-dismissible alert-danger">
                        <button type="button" class="close" data-dismiss="alert">x</button>
                        <strong>ERROR!</strong> Debe ingresar un numero valido como precio.
                        </div>';
                    }        
                } else {
                    echo '<div class="alert alert-dismissible alert-danger">
                    <button type="button" class="close" data-dismiss="alert">x</button>
                    <strong>ERROR!</strong> La cantidad debe ser un número mayor o igual a 1.
                    </div>';
                }
            } else {
                echo '<div class="alert alert-dismissible alert-danger">
                <button type="button" class="close" data-dismiss="alert">x</button>
                <strong>ERROR!</strong> El nombre del producto debe contener entre '. LONGITUD_MIN_NOM . ' y ' . LONGITUD_MAX_NOM . ' caracteres.
                </div>';
            }    
        } else {
            echo '<div class="alert alert-dismissible alert-danger">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <strong>ERROR!</strong> El producto ya existe.
            </div>';
        }
    } else{
        echo  
        '<div class="alert alert-dismissible alert-info">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <strong>Aviso:</strong> no has modificado nada.
        </div>';
    }
    $db->liberar($sql);
    $db->close();
} else {
  echo '<div class="alert alert-dismissible alert-danger">
  <button type="button" class="close" data-dismiss="alert">x</button>
  <strong>ERROR!</strong> Debe completar los datos obligatorios *.
  </div>';
}
    

?>