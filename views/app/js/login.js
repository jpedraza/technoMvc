function goLogin() {
  var connect, form, response, result, user, pass, sesion;
  user = __('user_login').value;
  pass = __('pass_login').value;
  sesion = __('session_login').checked ? true : false;
  form = 'user=' + user + '&pass=' + pass + '&sesion=' + sesion;
  connect = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
  connect.onreadystatechange = function() {
		if(connect.readyState == 4 && connect.status == 200) {
		    if(connect.responseText == 1) {
		      	result = '<div class="alert alert-dismissible alert-success">';
		      	result += '<strong>Conectado!</strong><br />';
		      	result += 'Estamos redireccionandote<img src="views/app/images/loading1.gif" heigth="60%" alt="cargando" />';
		      	result += '</div>';
		      	__('_AJAX_LOGIN_').innerHTML = result;
		      	location.reload();
		    } else {
				__('_AJAX_LOGIN_').innerHTML = connect.responseText;
			}
		} else if(connect.readyState != 4) {
      		result = '<div class="alert alert-dismissible alert-warning">';
      		result += '<button type="button" class="close" data-dismiss="alert">x</button>';
      		result += '<strong>Procesando</strong><img src="views/app/images/loading1.gif" heigth="60%" alt="cargando" />';
      		result += '</div>';
      		__('_AJAX_LOGIN_').innerHTML = result;
    	}
  	}
	connect.open('POST','ajax.php?mode=login',true);
  	connect.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
  	connect.send(form);
}

function runScriptLogin(e) {
	if(e.keyCode == 13) { //13 corresponde al boton enter o intro del teclado en Ascii
		goLogin();
	}
}