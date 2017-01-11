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
					     	       			foreach ($_productos as $id_producto => $producto_array) {
				             				 	$oferta = ($_productos[$id_producto]['oferta'] == 1) ? "Si" : "No";
				             					$HTML .= 
				                 				'<tr>
				                   					<td style="text-align:center;">
				                   						<img src="views/images/productos/' . $_productos[$id_producto]['foto1'] .'" alt="'. $_productos[$id_producto]['nombre'] .'" width="70" height="70">
				                   					</td>
				                   					<td style="text-align:center">'.
				                   						strtoupper(substr($_productos[$id_producto]['nombre'],0,1)).
				                   						strtolower(substr($_productos[$id_producto]['nombre'],1)).
				                   					'</td>
				                   					<td style="text-align:center">'.
				                   						number_format($_productos[$id_producto]['precio'],2,",",".").
				                   					'</td>
				                   					<td style="text-align:center">'.
				                   						$_productos[$id_producto]['cantidad'].
				                   					'</td>
				                   					<td style="text-align:center">'.
				                   						$_categorias[$_productos[$id_producto]['id_categoria']]['nombre'].
				                   					'</td>
				                   					<td style="text-align:center">'.
				                   						$_subcategorias[$_productos[$id_producto]['id_subcategoria']]['nombre'].
				                   					'</td>
				                   					<td style="text-align:center">'.
				                   						$oferta.
				                   					'</td>
				                   					<td style="text-align:center">'.
				                   						number_format($_productos[$id_producto]['precio_oferta'],2,",",".").
				                   					'</td>
				                   					<td style="text-align:center">
				                   						<a class="btn btn-default"  data-target="#Edipro" href="?view=productos&mode=edit&id='. $_productos[$id_producto]['id'] .'" >
					                                        <i class="fa fa-edit" title="Editar"> Editar</i>
					                                    </a>					                                    
				                   					</td>
				                   					<td style="text-align:center">
					                                    <a class="btn btn-default" onclick="DeleteItem(\'¿Está seguro de eliminar este Producto?\',\'?view=productos&mode=delete&id='.$_productos[$id_producto]['id'].'\')"><i class="fa fa-times" title="Eliminar"> Eliminar</i>
					                                    </a>
					                                </td>
								                </tr>';
								            }
								            $HTML .= 
								        '</tbody>
								    </table>'
								;
							} else {
								$HTML = 
									'<div class="alert alert-dismissible alert-info">
										<strong>INFORMACIÓN: </strong> Todavía no existe ningún Producto.
									</div>'
								;
							}
							echo $HTML;							
				           	?>
	            	</div>
	        	</div>
	        </div>

		</div>
	</section>

    <?php include(HTML_DIR . 'overall/footer.php'); ?>
</body>
</html>