<div class="modal fade" id="Addpro" role="dialog">             
    <div class="modal-dialog">  
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="aviso-luis">
                    <span class="glyphicon glyphicon-shopping-cart"></span>
                    Registrar Producto
                </h4>
            </div>
    
            <div id="_AJAX_ADDPRO_"></div>

            <div class="modal-body">
                <form role="form" enctype="multipart/form" id="form" onkeypress="return runScriptAddpro(event)">
                    <div class="form-group col-sm-6">
                        <label for="inputEmail" class="col-lg-4 control-label">Nombre del Producto <b class="aviso-luis">*</b></label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre del producto">
                        </div>
                    </div>
                    <div class="form-group col-sm-6" onkeypress="return runScriptAddpro(event)">
                        <label for="inputEmail" class="col-lg-6 control-label">Precio <b class="aviso-luis">*</b></label>
                        <div class="col-lg-10">
                            <input type="number" class="form-control" id="precio" name="precio" placeholder="Precio">
                        </div>
                    </div>
                    <div class="form-group col-sm-3" onkeypress="return runScriptAddpro(event)">
                        <label for="inputEmail" class="col-lg-4 control-label">Cantidad <b class="aviso-luis">*</b></label>
                        <div class="col-lg-10">
                            <input type="number" class="form-control" id="cantidad" name="cantidad" placeholder="Stock">
                        </div>
                    </div>
                    <div class="form-group col-sm-4" onkeypress="return runScriptAddpro(event)">
                        <label for="inputEmail" class="col-lg-4 control-label">Condicion <b class="aviso-luis">*</b></label>
                        <div class="col-lg-10">
                            <select name="condicion" id="condicion" class="form-control">
                                <option value="1">Nuevo</option>
                                <option value="2">Usado</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-sm-5" onkeypress="return runScriptAddpro(event)">
                        <label for="inputEmail" class="col-lg-4 control-label">Categoría <b class="aviso-luis">*</b></label>
                        <div class="col-lg-10">
                            <select name="categoria" id="categoria" class="form-control">
                                <?php 
                                    if ($_categorias) {
                                        echo '<option value="0">Elige la categoría</option>';
                                        foreach ($_categorias as $id_categoria => $array_categoria) {
                                            echo 
                                            '<option value="' . $id_categoria . '">' 
                                            . strtoupper(substr($_categorias[$id_categoria]['nombre'],0,1)).strtolower(substr($_categorias[$id_categoria]['nombre'],1)).
                                            '</option>';
                                        } 
                                    } else {
                                        echo '<option value="0">No existen categorías</option>';
                                    }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group col-sm-6" enctype="multipart/form-data" onkeypress="return runScriptAddpro(event)">
                        <label for="inputEmail" class="col-lg-4 control-label">Sub-Categoría <b class="aviso-luis">*</b></label>
                        <div class="col-lg-10">
                            <select name="subcategoria" id="subcategoria" class="form-control">
                                <option value="0">Elige la Subcategoría</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-sm-6" onkeypress="return runScriptAddpro(event)">
                        <label for="inputEmail" class="col-lg-4 control-label">Marca <b class="aviso-luis">*</b></label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="marca" name="marca" placeholder="Marca del producto">
                        </div>
                    </div>

                    <div class="form-group col-sm-6" onkeypress="return runScriptAddpro(event)">
                        <label for="inputEmail" class="col-lg-4 control-label">¿Esta en Oferta? <b class="aviso-luis">*</b></label>
                        <div class="col-lg-10">
                            <select name="oferta" id="oferta" class="form-control" onclick="return Desactivo(this.value)">
                                <option value="0">No</option>
                                <option value="1">Si</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-sm-6" onkeypress="return runScriptAddpro(event)">
                        <label for="inputEmail" class="col-lg-4 control-label">Precio de oferta</label>
                        <div class="col-lg-10">
                            <input type="number" class="form-control" id="precio_oferta" name="precio_oferta" disabled="" placeholder="Precio de Oferta">
                        </div>
                    </div>
                    <div class="form-group col-sm-12" onkeypress="return runScriptAddpro(event)">
                        <label for="inputEmail" class="col-lg-4 control-label">Foto <b class="aviso-luis">*</b></label>
                        <div class="col-lg-10">
                           <!--  <input type="file" multiple name="imagen" id="imagen" class="form-control"></input> -->
                            <input type="file" name="imagen[]" class="form-control" id="imagen" data-field-type="bootstrap-file-filed" 
                            data-label='<i class="fa fa-folder-open"></i>Insertar Imagen' 
                            data-btn-class="btn-default" 
                            data-file-types="image/jpeg,image/png,image/gif"
                            data-max-file-size="500000"
                            data-max-num-files="3" 
                            data-preview="on" 
                            multiple >
                        </div>
                    </div>

                    <div class="form-group col-sm-12">
                        <label for="textArea" class="col-lg-4 control-label">Descripción <b class="aviso-luis">*</b></label>
                          
                        <div class="col-lg-8">
                            <textarea rows="5" name="detalle" id="detalle" class="form-control" placeholder="Descripción del producto"></textarea>
                        </div>
                    </div>
                    
                    <button type="button" class="btn btn-default btn-success btn-block" onclick="goAddpro()">
                        <span class="glyphicon glyphicon-saved"></span> 
                        Crear producto
                    </button>
                </form>
            </div>
            <div class="modal-footer">
                
            </div>
        </div>
    </div>
</div>


<script src=views/app/js/producto.js></script>
