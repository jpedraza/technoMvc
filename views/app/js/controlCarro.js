function ctrCar() {
    var connect, form, response, result, cantidad, idPrd, idCar;
    cantidad = __('cantidad').value;
    idPrd = __('idPrd').value;
    idCar = __('idCar').value;

    if (cantidad >= 1 && cantidad != "") {
        form = 'cantidad=' + cantidad + '&idPrd=' + idPrd + '&idCar=' + idCar;
        connect = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        connect.onreadystatechange = function() {
            if(connect.readyState == 4 && connect.status == 200) {
                if(connect.responseText == 1) {
                    result = '<span class="label label-success">';
                    result += 'Modificando...';
                    result += '</button>';
                    __('_AJAX_CTRCAR_').innerHTML = result;
                    location.reload();
                } else {
                    __('_AJAX_CTRCAR_').innerHTML = connect.responseText;
                }
            } else if(connect.readyState != 4) {
                result = '<span class="label label-info">';
                result += 'Comprobando...';
                result += '</span>';
                __('_AJAX_CTRCAR_').innerHTML = result;
            }
        }
        connect.open('POST','ajax.php?mode=ctrcar',true);
        connect.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
        connect.send(form);
    } else {
        result = '<span class="label label-danger">';
        result += 'Cantidad Invalida';
        result += '</span>';
         __('_AJAX_CTRCAR_').innerHTML = result;
    }
   
}