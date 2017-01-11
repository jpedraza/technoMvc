function goReg() {
    var connect, form, response, result, user, name, pass, email, tyc, pass_dos;
    user     = __('user_reg').value;
    name     = __('name_reg').value;
    pass     = __('pass_reg').value;
    email    = __('email_reg').value;
    pass_dos = __('pass_reg_dos').value;
    tyc      = __('tyc_reg').checked ? true : false;

    if (tyc) {
        if (user != "" && name != "" && pass != "" && pass_dos != "" && email != "") {
            if (pass == pass_dos) {
                form     = 'user=' + user + '&name=' + name + '&pass=' + pass + '&email=' + email;
                connect  = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                connect.onreadystatechange = function() {
                    if(connect.readyState == 4 && connect.status == 200) {
                        if(connect.responseText == 1) {
                            result = '<div class="alert alert-dismissible alert-success">';
                            result += '<strong>Registro Completado!</strong><br />';
                            result += 'Estamos redireccionandote...';
                            result += '</div>';
                            __('_AJAX_REG_').innerHTML = result;
                            location.reload();
                        } else {
                            __('_AJAX_REG_').innerHTML = connect.responseText;
                        }
                    } else if(connect.readyState != 4) {
                        result = '<div class="alert alert-dismissible alert-warning">';
                        result += '<button type="button" class="close" data-dismiss="alert">x</button>';
                        result += '<strong>Procesando...</strong><br />';
                        result += 'Estamos procesando tu registro...';
                        result += '</div>';
                        __('_AJAX_REG_').innerHTML = result;
                    }
                }
                connect.open('POST','ajax.php?mode=reg',true);
                connect.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
                connect.send(form);
            } else {
                result = '<div class="alert alert-dismissible alert-danger">';
                result += '<button type="button" class="close" data-dismiss="alert">x</button>';
                result += '<strong>ERROR: </strong>Las contraseñas no coinciden.';
                result += '</div>';
                __('_AJAX_REG_').innerHTML = result;  
            }
        } else {
            result = '<div class="alert alert-dismissible alert-danger">';
            result += '<button type="button" class="close" data-dismiss="alert">x</button>';
            result += '<strong>ERROR: </strong>Debe llenar todos los campos.';
            result += '</div>';
            __('_AJAX_REG_').innerHTML = result;      
        }
    } else {
        result = '<div class="alert alert-dismissible alert-danger">';
        result += '<button type="button" class="close" data-dismiss="alert">x</button>';
        result += '<strong>ERROR: </strong>Los términos y condiciones deben ser aceptados.';
        result += '</div>';
        __('_AJAX_REG_').innerHTML = result;
    }
}  

function runScriptReg(e) {
	if(e.keyCode == 13) { //13 corresponde al boton enter o intro del teclado en Ascii
		goReg();
	}
}