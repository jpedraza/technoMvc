<?php

if (!empty($_POST['name'])) {
    if (strlen($_POST['name']) > 3) {
        if (!is_numeric($_POST['name'])) {
            $db     = new Conexion();
            $data   = strtoupper(substr($db->real_escape_string($_POST['name']),0,1)) . strtolower(substr($db->real_escape_string($_POST['name']),1));
            $id     = $db->real_escape_string($_SESSION['app_id']);

            $sql = $db->query(
                "SELECT 
                    name 
                FROM 
                    users 
                WHERE 
                    id='$id'
                LIMIT 1;");
            $BD = $db->recorrer($sql)[0];
            $nombrebd = strtoupper(substr($BD,0,1)).strtolower(substr($BD,1));
            if($nombrebd != $data) {
                $sql = $db->query(
                    "UPDATE 
                        users
                    SET 
                        name='$data'
                    WHERE
                        id='$id';
                    ");
                echo 1;
            } else {
                echo 
                '<div class="alert alert-dismissible alert-info">
                    <button type="button" class="close" data-dismiss="alert">x</button>
                    <strong>AVISO:</strong> el nombre introducido es igual al registrado actualmente.
                </div>';
            }
            $db->close(); 
        } else {
            echo
            '<div class="alert alert-dismissible alert-danger">
                <button type="button" class="close" data-dismiss="alert">x</button>
                <strong>ERROR:</strong> el nombre introducido no puede ser numerico.
            </div>';  
        }            
    } else {
        echo 
        '<div class="alert alert-dismissible alert-danger">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <strong>ERROR:</strong> el nombre introducido es muy corto.
        </div>';        
    }
        
} else {
    echo 
    '<div class="alert alert-dismissible alert-danger">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <strong>ERROR:</strong> debe completar su nombre y apellido.
    </div>';
}

?>