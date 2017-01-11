function goAddpro() {
    var connect, form, response, result, nombre, precio, cantidad, condicion, categoria, subcategoria, detalle, oferta, precio_oferta, marca, imagen;
    nombre    = __('nombre').value;
    precio    = __('precio').value;
    cantidad  = __('cantidad').value;
    marca     = __('marca').value;
    condicion = __('condicion').value;
    categoria = __('categoria').value;
    subcategoria = __('subcategoria').value;
    detalle   = __('detalle').value;
    oferta    = __('oferta').value;
    precio_oferta = __('precio_oferta').value;
    imagen = __('imagen').files;
    tinyMCE.triggerSave();
    
    if (nombre != "" && precio != "" && cantidad != "" && marca != ""){
        if (oferta == 0){
            if (subcategoria > 0){
                if(imagen.length > 0 && imagen.length < 4){
                    for (var x = 0; x < imagen.length; x++) {                        
                        if (imagen[x].type == "image/png" || imagen[x].type == "image/jpg" || imagen[x].type == "image/jpeg" || imagen[x].type == "image/gif") {
                            if (imagen[x].size < 1024 * 1024 * 0.5) {
                                var formData = new FormData(document.getElementById("form"));                                
                                connect = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                                connect.onreadystatechange = function() {
                                    if(connect.readyState == 4 && connect.status == 200) {
                                        if(connect.responseText == 1) {
                                            result = '<div class="alert alert-dismissible alert-success">';
                                            result += '<strong>Producto Agregado!</strong> ';
                                            result += '</div>';
                                            __('_AJAX_ADDPRO_').innerHTML = result;
                                            location.reload();
                                        } else {
                                            __('_AJAX_ADDPRO_').innerHTML = connect.responseText;
                                        }
                                    } else if(connect.readyState != 4) {
                                        result = '<div class="alert alert-dismissible alert-warning">';
                                        result += '<button type="button" class="close" data-dismiss="alert">x</button>';
                                        result += '<strong>Procesando...</strong><br />';
                                        result += 'Estamos intentando agregar producto....';
                                        result += '</div>';
                                        __('_AJAX_ADDPRO_').innerHTML = result;
                                    }
                                }
                                connect.open('POST','ajax.php?mode=addpro',true);
                                connect.send(formData);
                            } else {
                                result = '<div class="alert alert-dismissible alert-danger">';
                                result += '<button type="button" class="close" data-dismiss="alert">x</button>';
                                result += '<strong>Error: </strong><br />el archivo ' + imagen[x].name + ' supera los 500Kb.';
                                result += '</div>';
                                __('_AJAX_ADDPRO_').innerHTML = result;
                            }                            
                        } else {
                            result = '<div class="alert alert-dismissible alert-danger">';
                            result += '<button type="button" class="close" data-dismiss="alert">x</button>';
                            result += '<strong>Error: </strong>el archivo ' + imagen[x].name + ' no es una imagen';
                            result += '</div>';
                            __('_AJAX_ADDPRO_').innerHTML = result;
                        }
                    }                    
                } else {
                    result = '<div class="alert alert-dismissible alert-danger">';
                    result += '<button type="button" class="close" data-dismiss="alert">x</button>';
                    result += '<strong>ERROR: </strong> Debes ingresar al menos una imagen';
                    result += '</div>';
                    __('_AJAX_ADDPRO_').innerHTML = result;
                }                
            } else {
                result = '<div class="alert alert-dismissible alert-danger">';
                result += '<button type="button" class="close" data-dismiss="alert">x</button>';
                result += '<strong>ERROR: </strong> Debes seleccionar una subcategoria';
                result += '</div>';
                __('_AJAX_ADDPRO_').innerHTML = result;
            }
        } else if (oferta == 1 && precio_oferta == "" && isNaN(precio_oferta)) {
            result = '<div class="alert alert-dismissible alert-danger">';
            result += '<button type="button" class="close" data-dismiss="alert">x</button>';
            result += '<strong>ERROR: </strong> Debes ingresar un precio de oferta';
            result += '</div>';
            __('_AJAX_ADDPRO_').innerHTML = result;
        } else if (oferta == 1 && precio_oferta <= 350) {
            result = '<div class="alert alert-dismissible alert-danger">';
            result += '<button type="button" class="close" data-dismiss="alert">x</button>';
            result += '<strong>ERROR: </strong> Debes ingresar un precio de oferta mayor a 350Bs.';
            result += '</div>';
            __('_AJAX_ADDPRO_').innerHTML = result;
        } else if (oferta == 1 && parseFloat(precio_oferta) >= parseFloat(precio)) {
            result = '<div class="alert alert-dismissible alert-danger">';
            result += '<button type="button" class="close" data-dismiss="alert">x</button>';
            result += '<strong>ERROR: </strong> Debes ingresar un precio de oferta menor al precio del producto.';
            result += '</div>';
            __('_AJAX_ADDPRO_').innerHTML = result;
        } else {
            var formData = new FormData(document.getElementById("form"));
            connect = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            connect.onreadystatechange = function() {
                if(connect.readyState == 4 && connect.status == 200) {
                    if(connect.responseText == 1) {
                        result = '<div class="alert alert-dismissible alert-success">';
                        result += '<strong>Producto Agregado!</strong> ';
                        result += '</div>';
                        __('_AJAX_ADDPRO_').innerHTML = result;
                        location.reload();
                    } else {
                        __('_AJAX_ADDPRO_').innerHTML = connect.responseText;
                    }
                } else if(connect.readyState != 4) {
                    result = '<div class="alert alert-dismissible alert-warning">';
                    result += '<button type="button" class="close" data-dismiss="alert">x</button>';
                    result += '<strong>Procesando...</strong><br />';
                    result += 'Estamos intentando agregar producto....';
                    result += '</div>';
                    __('_AJAX_ADDPRO_').innerHTML = result;
                }
            }
            connect.open('POST','ajax.php?mode=addpro',true);
            connect.send(formData);
        }
    } else {
        result = '<div class="alert alert-dismissible alert-danger">';
        result += '<button type="button" class="close" data-dismiss="alert">x</button>';
        result += '<strong>ERROR:</strong> Debe completar los datos obligatorios *.';
        result += '</div>';
        __('_AJAX_ADDPRO_').innerHTML = result;
    }
}



function goEdipro() {
    var connect, form, response, result, id, nombre, precio, cantidad, condicion, categoria, subcategoria, detalle, oferta, precio_oferta, marca, imagen;
    id = __('id').value;
    nombre    = __('nombre').value;
    precio    = __('precio').value;
    cantidad  = __('cantidad').value;
    marca     = __('marca').value;
    condicion = __('condicion').value;
    categoria = __('categoria').value;
    subcategoria = __('subcategoria').value;
    detalle   = __('detalle').value;
    oferta    = __('oferta').value;
    precio_oferta = __('precio_oferta').value;
    imagen = __('imagen').files;
    tinyMCE.triggerSave();
    
    if (nombre != "" && precio != "" && cantidad != "" && marca != ""){
        if (oferta == 0){
            if (subcategoria > 0){
                                var formData = new FormData(document.getElementById("form"));                                
                                connect = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                                connect.onreadystatechange = function() {
                                    if(connect.readyState == 4 && connect.status == 200) {
                                        if(connect.responseText == 1) {
                                            result = '<div class="alert alert-dismissible alert-success">';
                                            result += '<strong>Producto Agregado!</strong> ';
                                            result += '</div>';
                                            __('_AJAX_EDIPRO_').innerHTML = result;
                                            location.reload();
                                        } else {
                                            __('_AJAX_EDIPRO_').innerHTML = connect.responseText;
                                        }
                                    } else if(connect.readyState != 4) {
                                        result = '<div class="alert alert-dismissible alert-warning">';
                                        result += '<button type="button" class="close" data-dismiss="alert">x</button>';
                                        result += '<strong>Procesando...</strong><br />';
                                        result += 'Estamos intentando agregar producto....';
                                        result += '</div>';
                                        __('_AJAX_EDIPRO_').innerHTML = result;
                                    }
                                }
                                connect.open('POST','ajax.php?mode=edipro',true);
                                connect.send(formData);                            
            } else {
                result = '<div class="alert alert-dismissible alert-danger">';
                result += '<button type="button" class="close" data-dismiss="alert">x</button>';
                result += '<strong>ERROR: </strong> Debes seleccionar una subcategoria';
                result += '</div>';
                __('_AJAX_EDIPRO_').innerHTML = result;
            }
        } else if (oferta == 1 && precio_oferta == "" && isNaN(precio_oferta)) {
            result = '<div class="alert alert-dismissible alert-danger">';
            result += '<button type="button" class="close" data-dismiss="alert">x</button>';
            result += '<strong>ERROR: </strong> Debes ingresar un precio de oferta';
            result += '</div>';
            __('_AJAX_EDIPRO_').innerHTML = result;
        } else if (oferta == 1 && precio_oferta <= 350) {
            result = '<div class="alert alert-dismissible alert-danger">';
            result += '<button type="button" class="close" data-dismiss="alert">x</button>';
            result += '<strong>ERROR: </strong> Debes ingresar un precio de oferta mayor a 350Bs.';
            result += '</div>';
            __('_AJAX_EDIPRO_').innerHTML = result;
        } else if (oferta == 1 && parseFloat(precio_oferta) >= parseFloat(precio)) {
            result = '<div class="alert alert-dismissible alert-danger">';
            result += '<button type="button" class="close" data-dismiss="alert">x</button>';
            result += '<strong>ERROR: </strong> Debes ingresar un precio de oferta menor al precio del producto.';
            result += '</div>';
            __('_AJAX_EDIPRO_').innerHTML = result;
        } else {
            var formData = new FormData(document.getElementById("form"));
            connect = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            connect.onreadystatechange = function() {
                if(connect.readyState == 4 && connect.status == 200) {
                    if(connect.responseText == 1) {
                        result = '<div class="alert alert-dismissible alert-success">';
                        result += '<strong>Producto Agregado!</strong> ';
                        result += '</div>';
                        __('_AJAX_EDIPRO_').innerHTML = result;
                        location.reload();
                    } else {
                        __('_AJAX_EDIPRO_').innerHTML = connect.responseText;
                    }
                } else if(connect.readyState != 4) {
                    result = '<div class="alert alert-dismissible alert-warning">';
                    result += '<button type="button" class="close" data-dismiss="alert">x</button>';
                    result += '<strong>Procesando...</strong><br />';
                    result += 'Estamos intentando agregar producto....';
                    result += '</div>';
                    __('_AJAX_EDIPRO_').innerHTML = result;
                }
            }
            connect.open('POST','ajax.php?mode=edipro',true);
            connect.send(formData);
        }
    } else {
        result = '<div class="alert alert-dismissible alert-danger">';
        result += '<button type="button" class="close" data-dismiss="alert">x</button>';
        result += '<strong>ERROR:</strong> Debe completar los datos obligatorios *.';
        result += '</div>';
        __('_AJAX_EDIPRO_').innerHTML = result;
    }
}



function runScriptAddpro(e) {
	if(e.keyCode == 13) { //13 corresponde al boton enter o intro del teclado en Ascii
		goAddpro();
	}
}


function runScriptEdipro(e) {
    if(e.keyCode == 13) { //13 corresponde al boton enter o intro del teclado en Ascii
        goEdipro();
    }
}


function Desactivo(v) {
    if (v == 0) {
        document.getElementById('precio_oferta').disabled = true;
    } else {
        document.getElementById('precio_oferta').disabled = false;
    }
}