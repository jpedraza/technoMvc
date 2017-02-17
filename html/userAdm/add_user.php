<div class="modal fade" id="Adduser" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">

            <div id="_AJAX_ADDUSER_"></div>

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="aviso-luis">
                    <span class="glyphicon glyphicon-lock"></span> 
                    Agregar Administrador
                </h4>
            </div>
            <div class="modal-body">
                <form role="form">
                    <div class="form-group" onkeypress="return runScriptAdduser(event)">
                        <label for="nombre">
                            <span class="glyphicon glyphicon-user"></span> 
                            Nombre y Apellido
                        </label>
                        <input type="text" class="form-control" id="name_reg" placeholder="Introduce el Nombre y Apellido">
                    </div>
                    <div class="form-group" onkeypress="return runScriptAdduser(event)">
                        <label for="usrname">
                            <span class="glyphicon glyphicon-user"></span> 
                            Usuario
                        </label>
                        <input type="text" class="form-control" id="user_reg" placeholder="Introduce el nombre de usuario">
                    </div>
                    <div class="form-group" onkeypress="return runScriptAdduser(event)">
                        <label for="email">
                            <span class="glyphicon glyphicon-envelope"></span> 
                            Email
                        </label>
                        <input type="email" class="form-control" id="email_reg" placeholder="Introduce el correo electrónico">
                    </div>
                    <div class="form-group" onkeypress="return runScriptAdduser(event)">
                        <label for="psw">
                            <span class="glyphicon glyphicon-eye-open"></span> 
                            Contraseña
                        </label>
                        <input type="password" class="form-control" id="pass_reg" placeholder="Introduce la contraseña">
                    </div>
                    <div class="form-group" onkeypress="return runScriptAdduser(event)">
                        <label for="psw_two">
                            <span class="glyphicon glyphicon-eye-open"></span> 
                            Repite la Contraseña
                        </label>
                        <input type="password" class="form-control" id="pass_reg_dos" placeholder="Introduce la contraseña de nuevo">
                    </div>
                    <button type="button" onclick="goAdduser()" class="btn btn-default btn-success btn-block">
                        <span class="glyphicon glyphicon-off"></span> 
                        Agregar Administrador
                    </button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-default pull-left" data-dismiss="modal">
                    <span class="glyphicon glyphicon-remove"></span> 
                    Cancelar
                </button>
            </div>
        </div>
    </div>
 </div>

 <script src="views/app/js/userAdm.js"></script>