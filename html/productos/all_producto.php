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
                                <a class="btn btn-default active" data-toggle="modal" href="?view=productos">
                                    Gestionar
                                </a>
                                <a class="btn btn-default" data-target="#Addpro" data-toggle="modal">
                                    Crear
                                </a>
                                <?php  include(HTML_DIR . '/productos/add_producto.php'); ?>
                            </li>
                        </ul>
                    </div>
                </div>
                <ol class="breadcrumb">
                  <li><a href="?view=index"><i class="fa fa-home"></i>Inicio</a></li>
                  <li><a href="#"><i class="fa fa-folder-open-o"></i>Productos</a></li>
                </ol>
            </div>
			
			<div class="row cart_info col-sm-12">
				<div class="table-responsive cart_info">
				  <div class="titulo_categoria">Gestión de Productos</div>
				  	<div class="cajas">
		                <?php
				           	if(false != $_productos) {
					            $HTML = '
					            	<table class="table table-condensed">
					            		<thead>
					            			<tr>
					            				<th style="text-align:center; width: 10%">
					            					Imagen
					            				</th>
					            				<th style="text-align:center; width: 20%">
					            					Producto
					            				</th>
					            				<th style="text-align:center; width: 9%">
					            					Precio
					            				</th>
					            				<th style="text-align:center; width: 5%">
					            					Cantidad
					            				</th>
					            				<th style="text-align:center; width: 10%">
					            					Categoria
					            				</th>
					            				<th style="text-align:center; width: 10%">
					            					Sub-Categoria
					            				</th>
					            				<th style="text-align:center; width: 10%">
					            					En Oferta
					            				</th>
					            				<th style="text-align:center; width: 8%">
					            					Precio
					            				</th>
					            				<th style="text-align:center; width: 10%" colspan="2">
					            					Acciones
					            				</th>
					            			</tr>
					            		</thead>				     
					     	       		<tbody>';
					     	       			$db = new Conexion();
					     	       			$compag = (int)(!isset($_GET['pag'])) ? 1 : $_GET['pag']; 
											$TotalReg = $_productos;
											$TotalRegistro  =ceil(count($TotalReg) / CANTIDAD_PRODUCTOS);
											$consultavistas ="
												SELECT
													foto1,
													nombre,
													precio,
													cantidad,
													id_categoria,
													id_subcategoria,
													oferta,
													precio_oferta,
													id
												FROM
													productos
												ORDER BY
													id ASC
												LIMIT ".(($compag-1) * CANTIDAD_PRODUCTOS)." , ".CANTIDAD_PRODUCTOS
											;
											$consulta=$db->query($consultavistas);
											while ($lista = $consulta->fetch_row()) {
												$oferta = ($lista[6] == 1) ? "Si" : "No";
												$HTML .=  
												'
												<tr>
													<td style="text-align:center;">
													<img src="views/images/productos/' . $lista[0] .'" alt="'. $lista[1].'" width="70" height="70">
													</td>
													<td style="text-align:center">'.
				                   						strtoupper(substr($lista[1],0,1)).
				                   						substr($lista[1],1).
				                   					'</td>
													<td style="text-align:center">'.
				                   						number_format($lista[2],2,",",".").
				                   					'</td>
				                   					<td style="text-align:center">'.
				                   						$lista[3].
				                   					'</td>
				                   					<td style="text-align:center">'.
				                   						$_categorias[$lista[4]]['nombre'].
				                   					'</td>
				                   					<td style="text-align:center">'.
				                   						$_subcategorias[$lista[5]]['nombre'].
				                   					'</td>
				                   					<td style="text-align:center">'.
				                   						$oferta.
				                   					'</td>
				                   					<td style="text-align:center">'.
				                   						number_format($lista[7],2,",",".").
				                   					'</td>
				                   					<td style="text-align:center">
				                   						<a class="btn btn-default"  data-target="#Edipro" href="?view=productos&mode=edit&id='. $lista[8] .'" >
					                                        <i class="fa fa-edit" title="Editar"> Editar</i>
					                                    </a>					                                    
				                   					</td>
				                   					<td style="text-align:center">
					                                    <a class="btn btn-default" onclick="DeleteItem(\'¿Está seguro de eliminar este Producto?\',\'?view=productos&mode=delete&id='.$lista[8] .'\')"><i class="fa fa-times" title="Eliminar"> Eliminar</i>
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
											<a href=?view=productos&pag=1>
												◀◀
											</a>
										</li>';
								} else { 
									$HTML .= 
										'';
								}
								$HTML .=
									'<li>
										<a href=?view=productos&pag=' . $DecrementNum . '>
											◀
										</a>
									</li>';
									
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
												<a href=\"?view=productos&pag=".$i."\">
													".$i."
												</a>
											</li>";
										} else {
											$HTML .=  
											"<li>
												<a href=\"?view=productos&pag=".$i."\">
													" . $i . "
												</a>
											</li>";
										}     		
									}
								}
								$HTML .=  
									'<li>
										<a href=?view=productos&pag=' . $IncrimentNum . '>
											▶
										</a>
									</li>';
									if ($TotalRegistro > 3){
										$HTML .= 
										'<li>
											<a href=?view=productos&pag=' . $TotalRegistro . '>
												▶▶
											</a>
										</li>';
								} else {
									$HTML .= 
										'</ul>
									</div>';
								}
							} else {
								$HTML = 
									'<div class="alert alert-dismissible alert-info">
										<strong>INFORMACIÓN: </strong> Todavía no existe ningún Producto.
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