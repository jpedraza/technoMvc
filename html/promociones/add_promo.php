<div class="modal fade" id="Addpromo" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">

            <div id="_AJAX_ADDPROMO_"></div>

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="aviso-luis">
                    <span class="glyphicon glyphicon-gift"></span> 
                    Agregar Promoción
                </h4>
            </div>
            <div class="modal-body">
                <form role="form" method="post" enctype="multipart/form-data" id="form" onkeypress="return runScriptAddpromo(event)">
                    <div class="form-group" onkeypress="return runScriptAddpromo(event)">
                        <label for="titulo">
                            <span class="glyphicon glyphicon-pencil"></span> 
                            Titulo
                        </label>
                        <input type="text" class="form-control" id="titulo" maxlength="25" placeholder="Introduce el titulo">
                    </div>
                    <div class="form-group">
                        <label for="detalle">
                            <span class="glyphicon glyphicon-pencil"></span> 
                            Detalle de Promoción
                        </label>
                        <textarea class="form-control" maxlength="90" id="detalle_promo" placeholder="Introduce el detalle de la Promoción"></textarea> 
                    </div>
                    <div class="form-group" onkeypress="return runScriptAddpromo(event)">
                        <input type="file" nombre="imagen" class="form-control" id="imagen" data-field-type="bootstrap-file-filed" 
                        data-label='<i class="fa fa-folder-open"></i>Insertar Imagen' 
                        data-btn-class="btn-default" 
                        data-file-types="image/jpeg,image/png,image/gif"
                        data-max-file-size="500000"
                        data-max-num-files="1" 
                        data-preview="on">
                    </div>
                    <div class="form-group" onkeypress="return runScriptAddpromo(event)">
                        <label for="sale">
                            <span class="glyphicon glyphicon-picture"></span> 
                            Agregar Imagen de Oferta
                        </label>
                        <select class="form-control" id="oferta">
                            <option value="0">No</option>
                            <option value="1">Si</option>
                        </select> 
                    </div>
                    <button type="button" class="btn btn-default btn-success btn-block" onclick="goAddpromo()">
                        <span class="glyphicon glyphicon-saved"></span> 
                        Crear Promoción
                    </button>
                </form>
            </div>
            <div class="modal-footer">
                
            </div>
        </div>
    </div>
 </div>

 <script src="views/app/js/promociones.js"></script>