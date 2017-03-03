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
                                <a class="btn btn-default active" data-toggle="modal" href="Promociones/">
                                    Gestionar
                                </a>
                                <a class="btn btn-default" data-target="#Addpromo" data-toggle="modal">
                                    Crear
                                </a>
                                <?php  include(HTML_DIR . '/promociones/add_promo.php'); ?>
                            </li>
                        </ul>
                    </div>
                </div>
                <ol class="breadcrumb">
                  <li><a href="home/"><i class="fa fa-home"></i>Inicio</a></li>
                  <li><a href="Promociones/"><i class="fa fa-folder-open-o"></i>Promociones</a></li>
                </ol>
            </div>
			
			<div class="row cart_info col-sm-12">
				<div class="table-responsive cart_info">
				  <div class="titulo_categoria">Gestión de Promociones</div>
				  	<?php 
				  	if(isset($_GET['error'])) {
				        echo 
				        '<div class="alert alert-dismissible alert-danger">
						    <button type="button" class="close" data-dismiss="alert">x</button>
						    <strong>Error!</strong> debe tener al menos una promoción.
						</div>';
				    }?>
				  	<div class="cajas">
		                <?php
				           	if(false != $_promociones) {
					            $HTML = '
					            	<table class="table table-condensed">
					            		<thead>
					            			<tr>
					            				<th style="text-align:center; width: 15%">
					            					Titulo
					            				</th>
					            				<th style="text-align:center; width: 40%">
					            					Detalle
					            				</th>
					            				<th style="text-align:center; width: 20%">
					            					Imagen
					            				</th>
					            				<th style="text-align:center; width: 10%">
					            					Imagen de Oferta
					            				</th>
					            				<th style="text-align:center; width: 10%" colspan="2">
					            					Acciones
					            				</th>
					            			</tr>
					            		</thead>				     
					     	       		<tbody>';
					     	       			$db = new Conexion();
					     	       			$compag = (int)(!isset($_GET['pag'])) ? 1 : $_GET['pag']; 
											$TotalReg = $_promociones;
											$TotalRegistro  =ceil(count($TotalReg) / CANTIDAD_PRODUCTOS);
											$consultavistas ="
												SELECT
													id,
													titulo,
													detalle,
													imagen,
													oferta
												FROM
													promociones
												LIMIT ".(($compag-1) * CANTIDAD_PRODUCTOS)." , ".CANTIDAD_PRODUCTOS
											;
											$consulta=$db->query($consultavistas);
											while ($lista = $consulta->fetch_row()) {
												$oferta = ($lista[4] == 1) ? "Si" : "No";
												$HTML .=  
												'
												<tr>
													<td style="text-align:center">'.
				                   						strtoupper(substr($lista[1],0,1)).
				                   						substr($lista[1],1).
				                   					'</td>
													<td style="text-align:center">'.
				                   						$lista[2].
				                   					'</td>
													<td style="text-align:center;">
														<img src="views/images/home/promociones/' . $lista[3] .'" alt="'. $lista[1].'" width="70" height="70">
													</td>
				                   					<td style="text-align:center">'.
				                   						$oferta.
				                   					'</td>
				                   					<td style="text-align:center">
				                   						<a class="btn btn-default"  data-target="#Ediuser" href="?view=promociones&mode=edit&id='. $lista[0] .'" >
					                                        <i class="fa fa-edit" title="Editar"> Editar</i>
					                                    </a>					                                    
				                   					</td>
				                   					<td style="text-align:center">
					                                    <a class="btn btn-default" onclick="DeleteItem(\'¿Está seguro de eliminar esta promoción? Se borrará del Home\',\'?view=promociones&mode=delete&id='.$lista[0] .'\')"><i class="fa fa-times" title="Eliminar"> Eliminar</i>
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
											<a href=?view=promociones&pag=1>
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
										<a href=?view=promociones&pag=' . $DecrementNum . '>
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
												<a href=\"?view=promociones&pag=".$i."\">
													".$i."
												</a>
											</li>";
										} else {
											$HTML .=  
											"<li>
												<a href=\"?view=promociones&pag=".$i."\">
													" . $i . "
												</a>
											</li>";
										}     		
									}
								}
								if ($TotalRegistro > 1) {
									$HTML .=  
									'<li>
										<a href=?view=promociones&pag=' . $IncrimentNum . '>
											▶
										</a>
									</li>';
									if ($TotalRegistro > 3){
										$HTML .= 
										'<li>
											<a href=?view=promociones&pag=' . $TotalRegistro . '>
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
										<strong>INFORMACIÓN: </strong> Todavía no existe ninguna Promoción.
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