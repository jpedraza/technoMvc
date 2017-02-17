function goSearch() {
  var connect, form, response, result, search;
  search = __('search').value;
  form = 'search=' + search;
  connect = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
  connect.onreadystatechange = function() {
		if(connect.readyState == 4 && connect.status == 200) {
		    if(connect.responseText == 1) {
		      	result = '<div class="alert alert-dismissible alert-success">';
		      	result += '<strong>Buscando!</strong><br />';
		      	result += 'Cargando coincidencias <img src="views/app/images/loading1.gif" heigth="60%" alt="..." />';
		      	result += '</div>';
		      	__('_AJAX_SEARCH_').innerHTML = result;
		      	location.reload();
		    } else {
				__('_AJAX_SEARCH_').innerHTML = connect.responseText;
			}
		} else if(connect.readyState != 4) {
      		result = '<div class="alert alert-dismissible alert-warning">';
      		result += '<button type="button" class="close" data-dismiss="alert">x</button>';
      		result += '<strong>Procesando </strong><img src="views/app/images/loading1.gif" heigth="60%" alt="..." />';
      		result += '</div>';
      		__('_AJAX_SEARCH_').innerHTML = result;
    	}
  	}
	connect.open('POST','ajax.php?mode=search',true);
  	connect.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
  	connect.send(form);
}

function runScriptSearch(e) {
	if(e.keyCode == 13) { //13 corresponde al boton enter o intro del teclado en Ascii
		goSearch();
	}
}