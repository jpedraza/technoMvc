function __(id){
	return document.getElementById(id);
}

function DeleteItem(contenido,url) {
  	var action = window.confirm(contenido);
  	if (action) {
      	window.location = url;
  	}
}

function Dependientes(){
	$(document).ready(function(){
    $("#categoria").change(function () {
      $("#categoria option:selected").each(function () {
          elegido=$(this).val();
          $.post("core/bin/ajax/SelectDependientes.php", { elegido: elegido }, function(data){
            $("#subcategoria").html(data);
          });            
      });
    })
  });
}

/**
 * Funcion para desactivar los estados hasta que seleccione el país
 */
function Desactivo(v) {
    if (v == 0) {
        document.getElementById('estado').disabled = true;
    } else {
        document.getElementById('estado').disabled = false;
    }
}