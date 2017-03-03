function goCheckout() {
  	var connect, form, response, result, nombre, apellido, cedula, email, telefono, telefono1, postal, pais, estado, municipio, calle, edificio, transferencia, mercadopago, efectivo, debito;
  	nombre 			= __('nombre').value;
  	apellido 		= __('apellido').value;
  	cedula 			= __('cedula').value;
  	email 			= __('email').value;
  	telefono 		= __('telefono').value;
  	telefono1 		= __('telefono1').value;
  	postal 			= __('postal').value;
  	pais 			= __('pais').value;
  	estado 			= __('estado').value;
  	municipio 		= __('municipio').value;
  	calle 			= __('calle').value;
  	edificio 		= __('edificio').value;
  	transferencia 	= __('transferencia').checked ? true : false;
  	mercadopago 	= __('mercadopago').checked ? true : false;
  	efectivo 		= __('efectivo').checked ? true : false;
  	debito 			= __('debito').checked ? true : false;

  	/**
  	 * Verifica que los parametros obligatoros esten llenos
  	 * @param  nombre,apellido,cedula,telefono,postal,pais,estado,municipio,calle,edificio
  	 */
  	if (nombre != "" && apellido != "" && cedula != "" && telefono != "" && postal != "" && pais != "" && estado != "" && municipio != "" && calle != "" && edificio != "") {

  		/**
  		 * Verifica que no hayan modificado los valores del radio malisiosamente y siempre este seleccionado uno
  		 * @param  tipo de pago
  		 */
  		if (transferencia == true || mercadopago == true || efectivo == true || debito == true) {

  			/**
  			 * Verifica que se haya seleccionado un país y que no lo hayan modificado de forma maliciosa.
  			 * Chequea que sea un numero y mayor que 0
  			 */
  			if (pais > 0 && !isNaN(pais)) {

  				/**
  				 * Verifica que se haya seleccionado un estado y que no lo hayan modificado de forma maliciosa.
  				 * Chequea que sea un numero y mayor que 0.
  				 */
  				if (estado > 0 && !isNaN(estado)) {

  					/**
  					 * Verifica que el codigo postal sea númerico
  					 */
  					if (!isNaN(postal)) {

  						/**
	  					 * Verifica que el telefono sea númerico
	  					 */
	  					if (!isNaN(telefono)) {
	  						form = 'nombre=' + nombre + '&apellido=' + apellido + '&cedula=' + cedula + '&email=' + email + '&telefono=' + telefono + '&telefono1=' + telefono1 + '&postal=' + postal + '&pais=' + pais + '&estado=' + estado + '&municipio=' + municipio + '&calle=' + calle + '&edificio=' + edificio + '&transferencia=' + transferencia + '&mercadopago=' + mercadopago + '&efectivo=' + efectivo + '&debito=' + debito;
						  	connect = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
						  	connect.onreadystatechange = function() {
								if(connect.readyState == 4 && connect.status == 200) {
								    if(connect.responseText == 1) {
								      	result = '<div class="alert alert-dismissible alert-success">';
								      	result += 'Confirmando <img src="views/app/images/loading1.gif" heigth="60%" alt="..." />';
								      	result += '</div>';
								      	__('_AJAX_CHECKOUT_').innerHTML = result;
								      	window.location.replace('Confirmar-Compra/');
								    } else {
										__('_AJAX_CHECKOUT_').innerHTML = connect.responseText;
									}
								} else if(connect.readyState != 4) {
						      		result = '<div class="alert alert-dismissible alert-warning">';
						      		result += '<button type="button" class="close" data-dismiss="alert">x</button>';
						      		result += '<strong>Procesando </strong><img src="views/app/images/loading1.gif" heigth="60%" alt="..." />';
						      		result += '</div>';
						      		__('_AJAX_CHECKOUT_').innerHTML = result;
						    	}
						  	}
							connect.open('POST','ajax.php?mode=confirmCheck',true);
						  	connect.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
						  	connect.send(form);
						} else {
							result = '<div class="alert alert-dismissible alert-danger">';
					        result += '<button type="button" class="close" data-dismiss="alert">x</button>';
					        result += '<strong>ERROR: </strong>el telefono debe contener solo números.';
					        result += '</div>';
					        __('_AJAX_CHECKOUT_').innerHTML = result;
						}
  					} else {
  						result = '<div class="alert alert-dismissible alert-danger">';
				        result += '<button type="button" class="close" data-dismiss="alert">x</button>';
				        result += '<strong>ERROR: </strong>el código postal debe contener solo números.';
				        result += '</div>';
				        __('_AJAX_CHECKOUT_').innerHTML = result;
  					}
  				} else {
  					result = '<div class="alert alert-dismissible alert-danger">';
			        result += '<button type="button" class="close" data-dismiss="alert">x</button>';
			        result += '<strong>ERROR: </strong>debe seleccionar un estado.';
			        result += '</div>';
			        __('_AJAX_CHECKOUT_').innerHTML = result;
  				}
  			} else {
  				result = '<div class="alert alert-dismissible alert-danger">';
		        result += '<button type="button" class="close" data-dismiss="alert">x</button>';
		        result += '<strong>ERROR: </strong>debe seleccionar un país.';
		        result += '</div>';
		        __('_AJAX_CHECKOUT_').innerHTML = result;
	  		}	
  		} else {
	        result = '<div class="alert alert-dismissible alert-danger">';
	        result += '<button type="button" class="close" data-dismiss="alert">x</button>';
	        result += '<strong>ERROR: </strong>debe seleccionar un tipo de pago.';
	        result += '</div>';
	        __('_AJAX_CHECKOUT_').innerHTML = result;
  		}
	  		
  	} else {
        result = '<div class="alert alert-dismissible alert-danger">';
        result += '<button type="button" class="close" data-dismiss="alert">x</button>';
        result += '<strong>ERROR: </strong>debe llenar todos los campos.';
        result += '</div>';
        __('_AJAX_CHECKOUT_').innerHTML = result;
    }
	  	
}

function runScriptCheck(e) {
	if(e.keyCode == 13) { //13 corresponde al boton enter o intro del teclado en Ascii
		goCheckout();
	}
}