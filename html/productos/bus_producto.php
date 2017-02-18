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
                                <a class="btn btn-default active" data-toggle="modal" href="Stock/">
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
                  <li><a href="home/"><i class="fa fa-home"></i>Inicio</a></li>
                  <li><a href="Stock/"><i class="fa fa-folder-open-o"></i>Productos</a></li>
                </ol>
               	<form role="form">
		            <input type="text" name="buscar" id="buscar" placeholder="Buscar Producto" onkeypress="return runScriptBuspro(event)">
		            <button type="button" class="btn btn-default fa fa-search" onclick="goBuscarStock"></button>
	            </form>
            </div>
			
			<div class="row cart_info col-sm-12">
				<div class="table-responsive cart_info">
				  <div class="titulo_categoria">Gestión de Productos</div>
				  	<div class="cajas">
		                <?php
				           	if(!empty($_GET['buscar'])) {
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
											$buscar = $db->real_escape_string($_GET['buscar']);
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
												WHERE
													(marca LIKE '%$buscar%' OR nombre LIKE '%$buscar%')";
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
							} else {
								$HTML = 
									'<div class="alert alert-dismissible alert-info">
										<strong>INFORMACIÓN: </strong> no existe ningún Producto con ese nombre.
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

    <script src=views/app/js/producto.js></script>
    <?php include(HTML_DIR . 'overall/footer.php'); ?>
</body>
</html>