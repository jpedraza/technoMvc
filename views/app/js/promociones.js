function goAddpromo() {
    var connect, form, response, result, titulo, detalle_promo, oferta, imagen;
    titulo          = __('titulo').value;
    detalle_promo   = __('detalle_promo').value;
    oferta          = __('oferta').value;
    imagen          = __('imagen').files;
    
    if (titulo != "" && detalle_promo != "" && oferta != ""){
        if(imagen.length == 1){
            if (imagen[0].type == "image/png" || imagen[0].type == "image/jpg" || imagen[0].type == "image/jpeg" || imagen[0].type == "image/gif") {
                if (imagen[0].size < 1024 * 1024 * 0.5) {
                    var formData = new FormData();
                    formData.append('imagen', $('#imagen')[0].files[0]);
                    formData.append('titulo', $('#titulo').prop('value'));
                    formData.append('detalle_promo', $('#detalle_promo').prop('value'));
                    formData.append('oferta', $('#oferta').prop('value'));
                    connect = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                    connect.onreadystatechange = function() {
                        if(connect.readyState == 4 && connect.status == 200) {
                            if(connect.responseText == 1) {
                                result = '<div class="alert alert-dismissible alert-success">';
                                result += '<strong>Promocion Agregada!</strong> ';
                                result += '</div>';
                                __('_AJAX_ADDPROMO_').innerHTML = result;
                                window.location.replace("view=?promociones");
                            } else {
                                __('_AJAX_ADDPROMO_').innerHTML = connect.responseText;
                            }
                        } else if(connect.readyState != 4) {
                            result = '<div class="alert alert-dismissible alert-warning">';
                            result += '<button type="button" class="close" data-dismiss="alert">x</button>';
                            result += '<strong>Procesando </strong><img src="views/app/images/loading1.gif" heigth="60%" alt="..." />';
                            result += '</div>';
                            __('_AJAX_ADDPROMO_').innerHTML = result;
                        }
                    }
                    connect.open('POST','ajax.php?mode=promocionAdd',true);
                    connect.send(formData);
                } else {
                    result = '<div class="alert alert-dismissible alert-danger">';
                    result += '<button type="button" class="close" data-dismiss="alert">x</button>';
                    result += '<strong>Error: </strong><br />la imagen ' + imagen[0].name + ' supera los 500Kb.';
                    result += '</div>';
                    __('_AJAX_ADDPROMO_').innerHTML = result;
                }                            
            } else {
                result = '<div class="alert alert-dismissible alert-danger">';
                result += '<button type="button" class="close" data-dismiss="alert">x</button>';
                result += '<strong>Error: </strong>el archivo ' + imagen[0].name + ' no es una imagen';
                result += '</div>';
                __('_AJAX_ADDPROMO_').innerHTML = result;
            }               
        } else {
            result = '<div class="alert alert-dismissible alert-danger">';
            result += '<button type="button" class="close" data-dismiss="alert">x</button>';
            result += '<strong>ERROR: </strong> Debes ingresar una imagen';
            result += '</div>';
            __('_AJAX_ADDPROMO_').innerHTML = result;
        } 
    } else {
        result = '<div class="alert alert-dismissible alert-danger">';
        result += '<button type="button" class="close" data-dismiss="alert">x</button>';
        result += '<strong>ERROR:</strong> Debe completar los datos obligatorios *.';
        result += '</div>';
        __('_AJAX_ADDPROMO_').innerHTML = result;
    }
}


/**
 * Funcion para editar las promociones, la cual valida los valores ingresados.
 * Luego los remite metiante el ajax al php para que actualice si corresponde
 */

function goEdipromo() {
    var connect, form, response, result, titulo, detalle_promo, oferta, imagen, id;
    titulo          = __('titulo').value;
    detalle_promo   = __('detalle_promo').value;
    oferta          = __('oferta').value;
    id              = __('id').value;
    imagen          = __('imagen').files;
    
    if (titulo != "" && detalle_promo != "" && oferta != ""){
        if(imagen.length == 1){
            if (imagen[0].type == "image/png" || imagen[0].type == "image/jpg" || imagen[0].type == "image/jpeg" || imagen[0].type == "image/gif") {
                if (imagen[0].size < 1024 * 1024 * 0.5) {
                    var formData = new FormData();
                    formData.append('imagen', $('#imagen')[0].files[0]);
                    formData.append('id', $('#id').prop('value'));
                    formData.append('titulo', $('#titulo').prop('value'));
                    formData.append('detalle_promo', $('#detalle_promo').prop('value'));
                    formData.append('oferta', $('#oferta').prop('value'));
                    connect = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                    connect.onreadystatechange = function() {
                        if(connect.readyState == 4 && connect.status == 200) {
                            if(connect.responseText == 1) {
                                result = '<div class="alert alert-dismissible alert-success">';
                                result += '<strong>Promocion Editada!</strong> ';
                                result += '</div>';
                                __('_AJAX_EDIPROMO_').innerHTML = result;
                                window.location.replace("view=?promociones");
                            } else {
                                __('_AJAX_EDIPROMO_').innerHTML = connect.responseText;
                            }
                        } else if(connect.readyState != 4) {
                            result = '<div class="alert alert-dismissible alert-warning">';
                            result += '<button type="button" class="close" data-dismiss="alert">x</button>';
                            result += '<strong>Procesando </strong><img src="views/app/images/loading1.gif" heigth="60%" alt="..." />';
                            result += '</div>';
                            __('_AJAX_EDIPROMO_').innerHTML = result;
                        }
                    }
                    connect.open('POST','ajax.php?mode=promocionEdi',true);
                    connect.send(formData);
                } else {
                    result = '<div class="alert alert-dismissible alert-danger">';
                    result += '<button type="button" class="close" data-dismiss="alert">x</button>';
                    result += '<strong>Error: </strong><br />la imagen ' + imagen[0].name + ' supera los 500Kb.';
                    result += '</div>';
                    __('_AJAX_EDIPROMO_').innerHTML = result;
                }                            
            } else {
                result = '<div class="alert alert-dismissible alert-danger">';
                result += '<button type="button" class="close" data-dismiss="alert">x</button>';
                result += '<strong>Error: </strong>el archivo ' + imagen[0].name + ' no es una imagen';
                result += '</div>';
                __('_AJAX_EDIPROMO_').innerHTML = result;
            }               
        } else {
            var formData = new FormData();
            formData.append('id', $('#id').prop('value'));
            formData.append('titulo', $('#titulo').prop('value'));
            formData.append('detalle_promo', $('#detalle_promo').prop('value'));
            formData.append('oferta', $('#oferta').prop('value'));
            connect = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            connect.onreadystatechange = function() {
                if(connect.readyState == 4 && connect.status == 200) {
                    if(connect.responseText == 1) {
                        result = '<div class="alert alert-dismissible alert-success">';
                        result += '<strong>Promocion Editada!</strong> ';
                        result += '</div>';
                        __('_AJAX_EDIPROMO_').innerHTML = result;
                        window.location.assign("?view=promociones");
                    } else {
                        __('_AJAX_EDIPROMO_').innerHTML = connect.responseText;
                    }
                } else if(connect.readyState != 4) {
                    result = '<div class="alert alert-dismissible alert-warning">';
                    result += '<button type="button" class="close" data-dismiss="alert">x</button>';
                    result += '<strong>Procesando </strong><img src="views/app/images/loading1.gif" heigth="60%" alt="..." />';
                    result += '</div>';
                    __('_AJAX_EDIPROMO_').innerHTML = result;
                }
            }
            connect.open('POST','ajax.php?mode=promocionEdi',true);
            connect.send(formData);
        } 
    } else {
        result = '<div class="alert alert-dismissible alert-danger">';
        result += '<button type="button" class="close" data-dismiss="alert">x</button>';
        result += '<strong>ERROR:</strong> debe completar los datos obligatorios *.';
        result += '</div>';
        __('_AJAX_EDIPROMO_').innerHTML = result;
    }
}


function runScriptAddpromo(e) {
    if(e.keyCode == 13) { //13 corresponde al boton enter o intro del teclado en Ascii
        return false;
    }
}