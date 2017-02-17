/**
 * [goAdduser Valida el ingreso de nuevos usuarios Administradores]
 * 
 * @return [Boolean] envia una variable por get al archivo ajax cuando pasa la validación JS
 */
function goAdduser() {
    var connect, form, response, result, user, name, pass, email, pass_dos;
    user     = __('user_reg').value;
    name     = __('name_reg').value;
    pass     = __('pass_reg').value;
    email    = __('email_reg').value;
    pass_dos = __('pass_reg_dos').value;
    
    if (user != "" && name != "" && pass != "" && pass_dos != "" && email != "") {
        if (pass == pass_dos) {
            form     = 'user=' + user + '&name=' + name + '&pass=' + pass + '&email=' + email;
            connect  = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            connect.onreadystatechange = function() {
                if(connect.readyState == 4 && connect.status == 200) {
                    if(connect.responseText == 1) {
                        result = '<div class="alert alert-dismissible alert-success">';
                        result += '<strong>Administrador Agregado!</strong><br />';
                        result += 'Revise el mail enviado';
                        result += '</div>';
                        __('_AJAX_ADDUSER_').innerHTML = result;
                        location.reload();
                    } else {
                        __('_AJAX_ADDUSER_').innerHTML = connect.responseText;
                    }
                } else if(connect.readyState != 4) {
                    result = '<div class="alert alert-dismissible alert-warning">';
                    result += '<button type="button" class="close" data-dismiss="alert">x</button>';
                    result += '<strong>Agregando </strong><img src="views/app/images/loading1.gif" heigth="60%" alt="..." />';
                    result += '</div>';
                    __('_AJAX_ADDUSER_').innerHTML = result;
                }
            }
            connect.open('POST','ajax.php?mode=addUserAdm',true);
            connect.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
            connect.send(form);
        } else {
            result = '<div class="alert alert-dismissible alert-danger">';
            result += '<button type="button" class="close" data-dismiss="alert">x</button>';
            result += '<strong>ERROR: </strong>Las contraseñas no coinciden.';
            result += '</div>';
            __('_AJAX_ADDUSER_').innerHTML = result;  
        }
    } else {
        result = '<div class="alert alert-dismissible alert-danger">';
        result += '<button type="button" class="close" data-dismiss="alert">x</button>';
        result += '<strong>ERROR: </strong>Debe llenar todos los campos.';
        result += '</div>';
        __('_AJAX_ADDUSER_').innerHTML = result;      
    }
}  

/**
 * [runScriptAdduser Funcion para captar la tecla ENTER y ejecutar la funcion de validación correspondiente]
 * @param  {Tecla enter en codigo ANSI}
 * @return Ejecuta la funcion de validación
 */
function runScriptAdduser(e) {
	if(e.keyCode == 13) { //13 corresponde al boton enter o intro del teclado en Ascii
		goAdduser();
	}
}


/**
 * [goEdituser Valida la edicion de usuarios Administradores]
 * 
 * @return [Boolean] envia una variable por get al archivo ajax cuando pasa la validación JS
 */
function goEdituser() {
    var connect, form, response, result, user, name, email, permisos, estatus;
    user     = __('user_reg').value;
    name     = __('name_reg').value;
    email    = __('email_reg').value;
    permisos = __('tipo_user').value;
    estatus  = __('estatus_user').value;
    
    if (user != "" && name != "" && permisos != "" && estatus != "" && email != "") {
        if (estatus == 0 || estatus == 1) {
            if (permisos == 0 || permisos == 1 || permisos == 2){
                form     = 'user=' + user + '&name=' + name + '&permisos=' + permisos + '&email=' + email + '&estatus=' + estatus;
                connect  = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                connect.onreadystatechange = function() {
                    if(connect.readyState == 4 && connect.status == 200) {
                        if(connect.responseText == 1) {
                            result = '<div class="alert alert-dismissible alert-success">';
                            result += '<strong>Usuario editado con éxito!</strong>';
                            result += '</div>';
                            __('_AJAX_EDITUSER_').innerHTML = result;
                            window.location.assign("?view=userAdm");
                        } else {
                            __('_AJAX_EDITUSER_').innerHTML = connect.responseText;
                        }
                    } else if(connect.readyState != 4) {
                        result = '<div class="alert alert-dismissible alert-warning">';
                        result += '<button type="button" class="close" data-dismiss="alert">x</button>';
                        result += '<strong>Editando </strong><img src="views/app/images/loading1.gif" heigth="60%" alt="..." />';
                        result += '</div>';
                        __('_AJAX_EDITUSER_').innerHTML = result;
                    }
                }
                connect.open('POST','ajax.php?mode=editUserAdm',true);
                connect.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
                connect.send(form);
            } else {
                result = '<div class="alert alert-dismissible alert-danger">';
                result += '<button type="button" class="close" data-dismiss="alert">x</button>';
                result += '<strong>ERROR: </strong>Tipo de Usuario invalido.';
                result += '</div>';
                __('_AJAX_EDITUSER_').innerHTML = result;  
            }
        } else {
            result = '<div class="alert alert-dismissible alert-danger">';
            result += '<button type="button" class="close" data-dismiss="alert">x</button>';
            result += '<strong>ERROR: </strong>estatus invalido.';
            result += '</div>';
            __('_AJAX_EDITUSER_').innerHTML = result;  
        }
    } else {
        result = '<div class="alert alert-dismissible alert-danger">';
        result += '<button type="button" class="close" data-dismiss="alert">x</button>';
        result += '<strong>ERROR: </strong>Debe llenar todos los campos.';
        result += '</div>';
        __('_AJAX_EDITUSER_').innerHTML = result;      
    }
}  


/**
 * [runScriptEdituser Funcion para captar la tecla ENTER y ejecutar la funcion de validación correspondiente]
 * @param  {Tecla enter en codigo ANSI}
 * @return Ejecuta la funcion de validación
 */
function runScriptEdituser(e) {
    if(e.keyCode == 13) { //13 corresponde al boton enter o intro del teclado en Ascii
        goEdituser();
    }
}