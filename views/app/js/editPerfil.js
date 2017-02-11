function editPass() {
    var connect, form, response, result, pass_bd, pass, pass_dos;
    pass_bd  = __('pass_bd').value;
    pass     = __('pass_reg').value;
    pass_dos = __('pass_reg_dos').value;

    if (pass_bd != "" && pass != "" && pass_dos != "") {
    	if (pass_bd != pass || pass_bd != pass_dos) {
            if (pass == pass_dos) {
                form     = 'pass=' + pass + '&pass_bd=' + pass_bd;
                connect  = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                connect.onreadystatechange = function() {
                    if(connect.readyState == 4 && connect.status == 200) {
                        if(connect.responseText == 1) {
                            result = '<div class="alert alert-dismissible alert-success">';
                            result += '<strong>Confirme la contraseña!</strong><br />';
                            result += 'Enviando email <img src="views/app/images/loading1.gif" heigth="60%" alt="..." />';
                        	result += '</div>';
                            __('_AJAX_EDITPASS_').innerHTML = result;
                            location.reload();
                        } else {
                            __('_AJAX_EDITPASS_').innerHTML = connect.responseText;
                        }
                    } else if(connect.readyState != 4) {
                        result = '<div class="alert alert-dismissible alert-warning">';
                        result += '<button type="button" class="close" data-dismiss="alert">x</button>';
                        result += '<strong>Procesando </strong><img src="views/app/images/loading1.gif" heigth="60%" alt="..." />';
                        result += '</div>';
                        __('_AJAX_EDITPASS_').innerHTML = result;
                    }
                }
                connect.open('POST','ajax.php?mode=editpass',true);
                connect.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
                connect.send(form);
            } else {
                result = '<div class="alert alert-dismissible alert-danger">';
                result += '<button type="button" class="close" data-dismiss="alert">x</button>';
                result += '<strong>ERROR: </strong>Las contraseñas no coinciden.';
                result += '</div>';
                __('_AJAX_EDITPASS_').innerHTML = result;  
            }
        } else {
            result = '<div class="alert alert-dismissible alert-danger">';
            result += '<button type="button" class="close" data-dismiss="alert">x</button>';
            result += '<strong>ERROR: </strong>La nueva contraseña es igual a la anterior';
            result += '</div>';
            __('_AJAX_EDITPASS_').innerHTML = result;  
        }
    } else {
        result = '<div class="alert alert-dismissible alert-danger">';
        result += '<button type="button" class="close" data-dismiss="alert">x</button>';
        result += '<strong>ERROR: </strong>Debe llenar todos los campos.';
        result += '</div>';
        __('_AJAX_EDITPASS_').innerHTML = result;      
    }
} 




function ediPerfil() {
  var connect, form, response, result, name;
  name     = __('name_reg').value;
  form = 'name=' + name;
  connect = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
  connect.onreadystatechange = function() {
		if(connect.readyState == 4 && connect.status == 200) {
		    if(connect.responseText == 1) {
		      	result = '<div class="alert alert-dismissible alert-success">';
		      	result += '<strong>Completado!</strong> se modifico con éxito su nombre y apellido';
		      	result += '';
		      	result += '</div>';
		      	__('_AJAX_EDIPERFIL_').innerHTML = result;
		      	location.reload();
		    } else {
				__('_AJAX_EDIPERFIL_').innerHTML = connect.responseText;
			}
		} else if(connect.readyState != 4) {
      		result = '<div class="alert alert-dismissible alert-warning">';
      		result += '<button type="button" class="close" data-dismiss="alert">x</button>';
      		result += '<strong>Procesando </strong><img src="views/app/images/loading1.gif" heigth="60%" alt="..." />';
      		result += '</div>';
      		__('_AJAX_EDIPERFIL_').innerHTML = result;
    	}
  	}
	connect.open('POST','ajax.php?mode=ediperfil',true);
  	connect.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
  	connect.send(form);
}


/**
 * Funcion para que procese el Form de editar Nombre al pulsar Enter
 */
function runScriptEditPer(e) {
	if(e.keyCode == 13) { //13 corresponde al boton enter o intro del teclado en Ascii
		ediPerfil();
	}
}


/**
 * Funcion para que modifique la contraseña al pulsar Enter
 */
function runScriptEditPass(e) {
	if(e.keyCode == 13) { //13 corresponde al boton enter o intro del teclado en Ascii
		editPass();
	}
}

/**
 * Activa el boton de envio al pulsar el nombre
 */
function activo() {
	document.getElementById('editar').disabled = false;
}