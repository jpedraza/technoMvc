<!--header-->
<header id="header">
   <!--header_top-->
   <div class="header_top">
      <div class="container">
         <div class="row">
            <div class="col-sm-6">
              <div class="contactinfo">
                <ul class="nav nav-pills">
                  <li><a href="#"><i class="fa fa-phone"></i> +58 234 5157913</a></li>
                  <li><a href="mailto:inv.technotronicgame.rk@gmail.com"><i class="fa fa-envelope"></i> inv.technotronicgame.rk@gmail.com</a></li>
                </ul>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="social-icons pull-right">
                  <ul class="nav navbar-nav">
                     <li>
                       <a href="https://www.facebook.com/inv.Technotronicgame.rk" target="_blank"><i class="fa fa-facebook"></i></a>
                     </li>
                     <li>
                       <a href="https://twitter.com/romuloantonio19" target="_blank"><i class="fa fa-twitter"></i></a>
                     </li>
                     <li>
                       <a href="https://instagram.com/oropeza19" target="_blank"><i class="fa fa-instagram"></i></a>
                     </li>
                   </ul>
              </div>
            </div>
         </div>
      </div>
   </div>
   <!--/header_top-->
   
   <!--header-middle-->
   <div class="header-middle">
      <div class="container">
         <div class="row">
            <div class="col-sm-4">
               <div class="logo pull-left">
                  <a href="home/"><img src="views/images/home/logo.png" alt="Technotronic Game RK" /></a>
               </div>
                  <div class="btn-group pull-right">
                     <div class="btn-group">
                        <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                           VENEZUELA
                           <span class="caret"></span>
                        </button>
                        <!-- <ul class="dropdown-menu">
                           <li><a href="#">ARGENTINA</a></li>
                        </ul> -->
                     </div>
                     <div class="btn-group">
                        <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                           BOLIVARES
                           <span class="caret"></span>
                        </button>
                        <!-- <ul class="dropdown-menu">
                           <li><a href="#">PESO ARGENTINO</a></li>
                        </ul> -->
                     </div>
                  </div>
            </div>
            <div class="col-sm-8">
               <div class="shop-menu pull-right">
                  <ul class="nav navbar-nav">
                  <?php
                  $db  = new Conexion();
                  /**
                   * Comportamiento de las variables de Session para verificar los productos en el carrito
                   * Determinando si no existe usuario logeado crea la variable con el date actual, mientras
                   * que si existe uno logeado actua de diferente manera.
                   */
                  
                  if (!isset($_SESSION['carrito']) && !isset($_SESSION['app_id'])){
                    $_SESSION['carrito'] = md5(date("d-m-Y H:i:s"));
                    $sql = $db->query(
                      "SELECT
                          id_producto
                      FROM
                          carrito
                      WHERE
                          id_usuario='$_SESSION[carrito]';");
                    $cantidadProducto = $db->rows($sql);
                  } else if (!isset($_SESSION['carrito']) && isset($_SESSION['app_id'])) {
                    $_SESSION['carrito'] = $_SESSION['app_id'];
                    $sql = $db->query(
                      "SELECT
                          id_producto
                      FROM
                          carrito
                      WHERE
                          id_usuario='$_SESSION[carrito]';");
                    $cantidadProducto = $db->rows($sql);
                  } else if (isset($_SESSION['carrito']) && isset($_SESSION['app_id'])){
                    $sql = $db->query(
                      "SELECT
                          id_producto
                      FROM
                          carrito
                      WHERE
                          id_usuario='$_SESSION[carrito]' OR id_usuario='$_SESSION[app_id]';");
                    $cantidadProducto = $db->rows($sql);
                  }

                  /**
                   * Comportamiento de las variables de Session para verificar los productos que tiene un 
                   * usuario en favoritos. Se comporta similar a la variable de SESSION del carrito.
                   */
                  
                  if (!isset($_SESSION['favoritos']) && !isset($_SESSION['app_id'])){
                    $_SESSION['favoritos'] = md5(date("d-m-Y H:i:s"));
                    $sql = $db->query(
                      "SELECT
                          id_producto
                      FROM
                          favoritos
                      WHERE
                          id_usuario='$_SESSION[favoritos]';");
                    $cantidadFavoritos = $db->rows($sql);
                  } else if (!isset($_SESSION['favoritos']) && isset($_SESSION['app_id'])) {
                    $_SESSION['favoritos'] = $_SESSION['app_id'];
                    $sql = $db->query(
                      "SELECT
                          id_producto
                      FROM
                          favoritos
                      WHERE
                          id_usuario='$_SESSION[favoritos]';");
                    $cantidadFavoritos = $db->rows($sql);
                  } else if (isset($_SESSION['favoritos']) && isset($_SESSION['app_id'])){
                    $sql = $db->query(
                      "SELECT
                          id_producto
                      FROM
                          favoritos
                      WHERE
                          id_usuario='$_SESSION[favoritos]' OR id_usuario='$_SESSION[app_id]';");
                    $cantidadFavoritos = $db->rows($sql);
                  }
                     
                  if(!isset($_SESSION['app_id'])) {
                    if (isset($cantidadProducto)) {
                      $cantidadProducto = $cantidadProducto; 
                    } else {
                        $sql = $db->query(
                        "SELECT
                            id_producto
                        FROM
                            carrito
                        WHERE
                            id_usuario = '$_SESSION[carrito]';");
                      $cantidadProducto = $db->rows($sql);
                    }

                    if (isset($cantidadFavoritos)) {
                      $cantidadFavoritos = $cantidadFavoritos; 
                    } else {
                        $sql = $db->query(
                        "SELECT
                            id_producto
                        FROM
                            favoritos
                        WHERE
                            id_usuario = '$_SESSION[favoritos]';");
                      $cantidadFavoritos = $db->rows($sql);
                    }

                    /**
                     * Muestra el MENU de la página dependiendo el tipo de usuario que inicia sesion.
                     */

                    echo '
                     <li><a href="favoritos/"><i class="fa fa-star"></i> Favoritos <b style="color:#ffffff; background-color:#00b6b4; border:none; border-radius:100%; padding:4px 7px">'.$cantidadFavoritos.'</b></a></li>
                     <li><a href="#"><i class="fa fa-crosshairs"></i> Caja </a></li>
                     <li><a href="carrito/"><i class="fa fa-shopping-cart"></i> Carrito <b style="color:#ffffff; background-color:#00b6b4; border:none; border-radius:100%; padding:4px 7px">'.$cantidadProducto.'</b></a></li>
                     <li>
                        <a data-toggle="modal" data-target="#Login"><i class="fa fa-lock"></i>
                           Login
                        </a>
                     </li>
                     <li>
                        <a data-toggle="modal" data-target="#Registro"><i class="fa fa-user-plus"></i>
                          Registro
                        </a>
                     </li>';
                     include(HTML_DIR . '/public/login.html');
                     include(HTML_DIR . '/public/reg.html');
                     include(HTML_DIR . '/public/lostpass.html');
                  }elseif ($_users[$_SESSION['app_id']]['permisos'] != 2) {
                     echo '
                     <li><a href="favoritos/"><i class="fa fa-star"></i> Favoritos <b style="color:#ffffff; background-color:#00b6b4; border:none; border-radius:100%; padding:4px 7px">'.$cantidadFavoritos.'</b></a></li>
                     <li><a href="#"><i class="fa fa-crosshairs"></i> Caja </a></li>
                     <li><a href="carrito/"><i class="fa fa-shopping-cart"></i> Carrito <b style="color:#ffffff; background-color:#00b6b4; border:none; border-radius:100%; padding:4px 7px">'.$cantidadProducto.'</b></a></li>
                     <li>
                        <a href="perfil/"><i class="fa fa-user"></i>'
                        . strtolower($_users[$_SESSION['app_id']]['user']) .
                        '</a>
                     </li>
                     <li>
                        <a href="?view=logout"><i class="fa fa-user-times"></i>
                           Salir
                        </a>
                     </li>';
                  } else{
                     echo '
                     <li>
                        <span>ADMINISTRADOR</span>
                     </li>
                     <li>
                        <a href="perfil/"><i class="fa fa-user"></i>'
                        . strtolower($_users[$_SESSION['app_id']]['user']) .
                        '</a>
                     </li>
                     <li>
                        <a href="?view=logout"><i class="fa fa-user-times"></i>
                           Salir
                        </a>
                     </li>';
                  }
                  $db->close();
                  ?>
                  </ul>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!--/header-middle-->

   <!--header-bottom-->
   <div class="header-bottom">
       <div class="container">
           <nav role="navigation" class="navbar navbar-inverse">
               <div class="navbar-header">
                   <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
                       <span class="sr-only">Alternar Navegador</span>
                       <span class="icon-bar"></span>
                       <span class="icon-bar"></span>
                       <span class="icon-bar"></span>
                   </button>
               </div>

               <div id="navbarCollapse" class="collapse navbar-collapse">
                  <?php if (isset($_SESSION['app_id']) and ($_users[$_SESSION['app_id']]['permisos'] == 2)) { ?>
                     <ul class="nav navbar-nav">
                         <li><a href="home/">Inicio</a></li>
                         <li><a href="Categorias/">Categorías</a></li>
                         <li><a href="Subcategorias/">Sub-Categorías</a></li>
                         <li><a href="Stock/">Productos</a></li>
                         <li><a href="?view=userAdm">Usuarios</a></li>                         
                     </ul>
                     <form role="search" class="navbar-form navbar-right">
                         <div class="form-group">
                             <input type="text" placeholder="Buscar" class="form-control">
                         </div>
                     </form>
                  <?php   
                  } else {?>                            
                     <ul class="luis nav navbar-nav">
                       <li>
                           <a href="home/">Inicio</a>
                       </li>
                       <?php 
                        if (false != $_categorias){
                            $db = new Conexion();
                            $prepare_sql = $db->prepare(
                                "SELECT 
                                    id 
                                FROM 
                                    subcategorias 
                                WHERE 
                                    id_categoria = ? 
                                ;"
                            );
                            $prepare_sql->bind_param('i',$id_categoria);
                            foreach ($_categorias as $id_categoria => $array_categoria) {
                                $prepare_sql->execute();
                                $prepare_sql->store_result();
                                echo 
                                '
                                <li class="dropdown">
                                  <a data-toggle="dropdown" class="dropdown-toggle" href="#">' . 
                                    strtoupper(substr($_categorias[$id_categoria]['nombre'],0,1)) .
                                    strtolower(substr($_categorias[$id_categoria]['nombre'],1)) .' 
                                    <b class="caret"></b>
                                  </a>
                                ';
                                if ($prepare_sql->num_rows > 0) {
                                    $prepare_sql->bind_result($id_de_subcategoria);
                                    echo '<ul role="menu" class="dropdown-menu">';
                                    while ($prepare_sql->fetch()) {
                                        echo '
                                            <li>
                                                <a href="mostrar/'. UrlAmigable($id_de_subcategoria, $_subcategorias[$id_de_subcategoria]['nombre']) . '">'
                                                    . $_subcategorias[$id_de_subcategoria]['nombre'] .
                                                '</a> 
                                            </li>'
                                        ;
                                    }
                                    echo '</ul>';
                                } else {
                                    echo 
                                    '
                                    <ul role="menu" class="dropdown-menu">
                                        <li>
                                            <a href="#">
                                                Sin Sub-Categorías
                                            </a> 
                                        </li>
                                    </ul>
                                    ';
                                }
                                echo '</li>';
                            }
                            $prepare_sql->close(); 
                        } else {
                            echo '
                                <li>
                                    <a href="#">
                                        No Hay Categorias
                                    </a>
                                </li>
                            ';
                        }
                       ?>
                       <li>
                           <a href="contacto/">Contacto</a>
                       </li>
                     </ul>
                   <form role="search" class="navbar-form navbar-right">
                       <div class="form-group search_box pull-left">
                           <input type="text" placeholder="Buscar" id="bus" name="bus" onkeyup="loadXMLDoc()" class="form-control">
                       </div>
                   </form> <?php
                  }
                  

                  ?>
                   
               </div>
           </nav>
       </div>
   </div>
   <!--/header-bottom-->
</header>
<!--/header-->