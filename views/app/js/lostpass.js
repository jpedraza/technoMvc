function goLostpass() {
	var connect, form, response, result, email;
	email = __('email_lostpass').value;
	if (email != '') {
		form = 'email=' + email;	
	  	connect = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
	  	connect.onreadystatechange = function() {
			if(connect.readyState == 4 && connect.status == 200) {
			    if(connect.responseText == 1) {
			      	result = '<div class="alert alert-dismissible alert-success">';
			      	result += '<strong>Recuperando contraseña!</strong><br />';
			      	result += 'Verifica tu correo y has click en el enlace';
			      	result += '</div>';
			      	__('_AJAX_LOSTPASS_').innerHTML = result;
			      	location.reload();
			    } else {
					__('_AJAX_LOSTPASS_').innerHTML = connect.responseText;
				}
			} else if(connect.readyState != 4) {
	      		result = '<div class="alert alert-dismissible alert-warning">';
	      		result += '<button type="button" class="close" data-dismiss="alert">x</button>';
	      		result += '<strong>Procesando...</strong><br />';
	      		result += 'Estamos verificando la información....';
	      		result += '</div>';
	      		__('_AJAX_LOSTPASS_').innerHTML = result;
	    	}
	  	}
		connect.open('POST','ajax.php?mode=lostpass',true);
	  	connect.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	  	connect.send(form);
  	} else {
  		result = '<div class="alert alert-dismissible alert-danger">';
	    result += '<button type="button" class="close" data-dismiss="alert">x</button>';
	    result += '<strong>ERROR!: </strong>Debes llenar el campo de email.';
	    result += '</div>';
	    __('_AJAX_LOSTPASS_').innerHTML = result;
  	}
}


function runScriptLostpass(e) {
	if(e.keyCode == 13) { //13 corresponde al boton enter o intro del teclado en Ascii
		goLostpass();
	}
}