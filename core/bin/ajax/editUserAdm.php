<?php

if (!empty($_POST['user']) && !empty($_POST['name']) && !empty($_POST['email']) && (!empty($_POST['permisos']) || isset($_POST['permisos'])) && (!isset($_POST['estatus']) || isset($_POST['estatus']))) {
    if ($_POST['permisos'] >= 0 && $_POST['permisos'] < 3) {
        if ($_POST['estatus'] == 0 || $_POST['estatus'] == 1) {
            $db     = new Conexion();
            $sql = $db->query(
                "SELECT 
                    activo,permisos 
                FROM 
                    users 
                WHERE 
                    user='$_POST[user]'
                LIMIT 1;");
            $data       = $db->recorrer($sql);
            $activoBd   = $data[0];
            $permisosBd = $data[1];
            if($activoBd != $_POST['estatus'] || $permisosBd != $_POST['permisos']) {
                $sql = $db->query(
                    "UPDATE 
                        users
                    SET 
                        activo='$_POST[estatus]',
                        permisos='$_POST[permisos]'
                    WHERE
                        user='$_POST[user]';
                    ");
                echo 1;
            } else {
                echo 
                '<div class="alert alert-dismissible alert-info">
                    <button type="button" class="close" data-dismiss="alert">x</button>
                    <strong>AVISO:</strong> no has modificado ningún campo.
                </div>';
            }
            $db->close(); 
        } else {
            echo
            '<div class="alert alert-dismissible alert-danger">
                <button type="button" class="close" data-dismiss="alert">x</button>
                <strong>ERROR:</strong> el estatus del usuario es invalido.
            </div>';  
        }            
    } else {
        echo 
        '<div class="alert alert-dismissible alert-danger">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <strong>ERROR:</strong> el tipo de usuario es invalido.
        </div>';        
    }
        
} else {
    echo 
    '<div class="alert alert-dismissible alert-danger">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <strong>ERROR:</strong> debe llenar todos los campos.
    </div>';
}

?>