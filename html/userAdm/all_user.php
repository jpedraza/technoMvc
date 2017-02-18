<?php include(HTML_DIR . 'overall/header.php'); ?>

<body>
    <section class="engine"><a rel="nofollow" href="#"><?php echo APP_TITLE ?></a></section>

    <?php include(HTML_DIR . 'overall/topnav.php'); ?>

    <section class="cart_items">
        <div class="container">
            <div class="row container col-sm-12">                
                <div class="pull-right">
                    <div>
                        <ul class="mbr-navbar__items mbr-buttons--active">
                        	<li>
                                <a class="btn btn-default active" data-toggle="modal" href="Usuarios/">
                                    Gestionar
                                </a>
                                <a class="btn btn-default" data-target="#Adduser" data-toggle="modal">
                                    Crear
                                </a>
                                <?php  include(HTML_DIR . '/userAdm/add_user.php'); ?>
                            </li>
                        </ul>
                    </div>
                </div>
                <ol class="breadcrumb">
                  <li><a href="home/"><i class="fa fa-home"></i>Inicio</a></li>
                  <li><a href="#"><i class="fa fa-folder-open-o"></i>Usuarios</a></li>
                </ol>
            </div>
			
			<div class="row cart_info col-sm-12">
				<div class="table-responsive cart_info">
				  <div class="titulo_categoria">Gestión de Usuarios</div>
				  	<div class="cajas">
		                <?php
				           	if(false != $_users) {
					            $HTML = '
					            	<table class="table table-condensed">
					            		<thead>
					            			<tr>
					            				<th style="text-align:center; width: 10%">
					            					Usuario
					            				</th>
					            				<th style="text-align:center; width: 20%">
					            					Nombre
					            				</th>
					            				<th style="text-align:center; width: 10%">
					            					Email
					            				</th>
					            				<th style="text-align:center; width: 10%">
					            					Tipo de Usuario
					            				</th>
					            				<th style="text-align:center; width: 10%">
					            					Estatus
					            				</th>
					            				<th style="text-align:center; width: 10%" colspan="2">
					            					Acciones
					            				</th>
					            			</tr>
					            		</thead>				     
					     	       		<tbody>';
					     	       			$db = new Conexion();
					     	       			$compag = (int)(!isset($_GET['pag'])) ? 1 : $_GET['pag']; 
											$TotalReg = $_users;
											$TotalRegistro  =ceil(count($TotalReg) / CANTIDAD_PRODUCTOS);
											$consultavistas ="
												SELECT
													user,
													name,
													email,
													permisos,
													activo,
													id
												FROM
													users
												ORDER BY
													name ASC
												LIMIT ".(($compag-1) * CANTIDAD_PRODUCTOS)." , ".CANTIDAD_PRODUCTOS
											;
											$consulta=$db->query($consultavistas);
											while ($lista = $consulta->fetch_row()) {
												/**
												 * Condición que determina que permisos tiene el Usuario
												 * @return $permiso 
												 */
												
												if (isset($lista[3]) && $lista[3]==2) {
													$permiso = 'Administrador';
												} else if(isset($lista[3]) && $lista[3] == 1) {
													$permiso = 'Cliente';
												} else{
													$permiso = 'Cliente Sancionado';
												}
												
												$estatus = ($lista[4] == 1) ? "Activo" : "Inactivo";
												$HTML .=  
												'
												<tr>
													<td style="text-align:center;">'.
														$lista[0].'
													</td>
													<td style="text-align:center">'.
				                   						strtoupper(substr($lista[1],0,1)).
				                   						substr($lista[1],1).
				                   					'</td>
													<td style="text-align:center">'.
				                   						$lista[2].
				                   					'</td>
				                   					<td style="text-align:center">'.
				                   						$permiso.
				                   					'</td>
				                   					<td style="text-align:center">'.
				                   						$estatus.
				                   					'</td>
				                   					<td style="text-align:center">
				                   						<a class="btn btn-default"  data-target="#Ediuser" href="?view=userAdm&mode=edit&id='. $lista[5] .'" >
					                                        <i class="fa fa-edit" title="Editar"> Editar</i>
					                                    </a>					                                    
				                   					</td>
				                   					<td style="text-align:center">
					                                    <a class="btn btn-default" onclick="DeleteItem(\'¿Está seguro de eliminar este Usuario?\',\'?view=userAdm&mode=delete&id='.$lista[5] .'\')"><i class="fa fa-times" title="Eliminar"> Eliminar</i>
					                                    </a>
					                                </td>
												</tr>'
												;
											}
								            $HTML .= 
								        '</tbody>
								    </table>';

								/*Sector de Paginacion */
																	
								//Operacion matematica para botón siguiente y atrás 
								$IncrimentNum = (($compag + 1) <= $TotalRegistro) ? ($compag + 1) : 1;
								$DecrementNum = (($compag - 1)) < 1 ? 1 :( $compag - 1);
																	
								$HTML .=  
									'<div style="text-align:center">
									<ul class="pagination"> ';
								if($TotalRegistro > 3){
									$HTML .= 
										'<li>
											<a href=?view=userAdm&pag=1>
												◀◀
											</a>
										</li>';
								} else { 
									$HTML .= 
										'';
								}
								if($TotalRegistro > 1){
								$HTML .=
									'<li>
										<a href=?view=userAdm&pag=' . $DecrementNum . '>
											◀
										</a>
									</li>';
								} else { 
									$HTML .= 
										'';
								}
									
								//Se resta y suma con el numero de pag actual con el cantidad de 
								//números  a mostrar
								$Desde = $compag - (ceil(CANTIDAD_PRODUCTOS / 2) - 1);
								$Hasta = $compag + (ceil(CANTIDAD_PRODUCTOS / 2) - 1);
																	
								//Se valida
								$Desde = ($Desde < 1) ? 1 : $Desde;
								$Hasta = ($Hasta < CANTIDAD_PRODUCTOS) ? CANTIDAD_PRODUCTOS : $Hasta;
								//Se muestra los números de paginas
								for($i = $Desde; $i <= $Hasta; $i++) {
								//Se valida la paginacion total de registros
									if($i <= $TotalRegistro){
								 	//Validamos la pag activo
										if($i == $compag){
											$HTML .=  
											"<li class=\"active\">
												<a href=\"?view=userAdm&pag=".$i."\">
													".$i."
												</a>
											</li>";
										} else {
											$HTML .=  
											"<li>
												<a href=\"?view=userAdm&pag=".$i."\">
													" . $i . "
												</a>
											</li>";
										}     		
									}
								}
								if ($TotalRegistro > 1) {
									$HTML .=  
									'<li>
										<a href=?view=userAdm&pag=' . $IncrimentNum . '>
											▶
										</a>
									</li>';
									if ($TotalRegistro > 3){
										$HTML .= 
										'<li>
											<a href=?view=userAdm&pag=' . $TotalRegistro . '>
												▶▶
											</a>
										</li>';
									}
								} else {
									$HTML .= 
										'</ul>
									</div>';
								}
							} else {
								$HTML = 
									'<div class="alert alert-dismissible alert-info">
										<strong>INFORMACIÓN: </strong> Todavía no existe ningún Usuario.
									</div>'
								;
							}
							echo $HTML;
							$db->close();							
				           	?>
	            	</div>
	        	</div>
	        </div>

		</div>
	</section>

    <?php include(HTML_DIR . 'overall/footer.php'); ?>
</body>
</html>