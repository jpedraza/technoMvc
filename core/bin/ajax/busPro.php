<?php

if(!empty($_POST['buscar'])) {
    $db = new Conexion();
    $data = $db->real_escape_string($_POST['buscar']);
    $sql = $db->query("
        SELECT
            foto1,
            nombre,
            precio,
            cantidad,
            id_categoria,
            id_subcategoria,
            oferta,
            precio_oferta,
            id
        FROM
            productos 
        WHERE 
            (nombre LIKE '$data%' OR marca LIKE '$data%'); ");
    
    if($db->rows($sql) > 0) {
        echo 1;
    } else {
        echo 
        '<span class="label label-danger">
            <strong>ERROR:</strong> no hay productos con ese nombre.
        </span>';
    }
    $db->liberar($sql);
    $db->close();
} else {
    echo
    '<span class="label label-danger">
        <strong>ERROR:</strong> Todos los datos deben estar llenos.
    </span>';
}

?>