<!--Footer--> 
<footer id="footer">
  <div class="footer-top">
    <div class="container">
      <div class="row">
        <div class="col-sm-2">
          <div class="companyinfo">
            <h2><span>Techno</span>tronic</h2>
            <p class="pjustify">Te traemos la mejor y m&aacute;s grande variedad de videojuegos y productos elect&oacute;nicos, al mejor precio del mercado</p>
          </div>
        </div>
        <div class="col-sm-7">
          <div class="col-sm-3">
            <div class="video-gallery text-center">
              <a href="#">
                <div class="iframe-img">
                  <img src="views/images/home/iframe1.png" alt="" />
                </div>
                <div class="overlay-icon">
                  <i class="fa fa-play-circle-o"></i>
                </div>
              </a>
              <p>Lanzamiento del PlayStation 5</p>
              <h2>Proximamente</h2>
            </div>
          </div>

          <div class="col-sm-3">
            <div class="video-gallery text-center">
              <a href="#">
                <div class="iframe-img">
                  <img src="views/images/home/iframe2.png" alt="" />
                </div>
                <div class="overlay-icon">
                  <i class="fa fa-play-circle-o"></i>
                </div>
              </a>
              <p>Call of Duty Modern Warfare 4</p>
              <h2>Finales de 2016</h2>
            </div>
          </div>

          <div class="col-sm-3">
            <div class="video-gallery text-center">
              <a href="#">
                <div class="iframe-img">
                  <img src="views/images/home/iframe3.png" alt="" />
                </div>
                <div class="overlay-icon">
                  <i class="fa fa-play-circle-o"></i>
                </div>
              </a>
              <p>La Realidad Virtual de tu PS4</p>
              <h2>Actualidad</h2>
            </div>
          </div>

          <div class="col-sm-3">
            <div class="video-gallery text-center">
              <a href="#">
                <div class="iframe-img">
                  <img src="views/images/home/iframe4.png" alt="" />
                </div>
                <div class="overlay-icon">
                  <i class="fa fa-play-circle-o"></i>
                </div>
              </a>
              <p>Volante con Cambios</p>
              <h2>Actualidad</h2>
            </div>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="address">
            <img src="views/images/home/map.png" alt="" />
            <p>Calle las colinas local 1, parroquia Caucagua, municipio Acevedo. Estado Miranda - Venezuela</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="footer-widget">
    <div class="container">
      <div class="row">
        <div class="col-sm-2">
          <div class="single-widget">
            <h2>Servicios</h2>
            <ul class="nav nav-pills nav-stacked">
              <li><a href="#">Ayuda en Línea</a></li>
              <li><a href="#">Contactenos</a></li>
              <li><a href="#">Productos en Reparación</a></li>
            </ul>
          </div>
        </div>
          <div class="col-sm-2">
          <div class="single-widget">
            <h2>Compra Rápida</h2>
            <ul class="nav nav-pills nav-stacked">
              <li><a href="#">Consolas</a></li>
              <li><a href="#">Reproductores</a></li>
              <li><a href="#">Accesorios</a></li>
              <li><a href="#">Otros Productos</a></li>
            </ul>
          </div>
        </div>
        <div class="col-sm-3 col-sm-offset-1">
          <div class="single-widget">
            <h2>Recibe Actualizaciones en tu correo</h2>
            <form action="#" class="searchform">
              <input type="email" placeholder="Ingresa tu correo" required="" />
              <button type="submit" class="btn btn-default">
                <i class="fa fa-arrow-circle-o-right"></i>
              </button>
              <p class="pjustify">
                Recibe las actualizaciones más recientes de nuestro sitio en tu correo electrónico
              </p>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="footer-bottom">
    <div class="container">
      <div class="row">
        <p class="pull-left"><?php echo APP_COPY ?></p>
        <p class="pull-right">Diseñado por <span><a target="_blank" href="www.lcdesign.com.ve">LC Design</a></span></p>
      </div>
    </div>
  </div>
</footer>

  <script src="views/app/js/jquery.js"></script>
  <script src="views/app/js/jquery.scrollUp.min.js"></script>
  <script src="views/app/js/price-range.js"></script>
  <script src="views/app/js/jquery.prettyPhoto.js"></script>
  <script src="views/app/js/main.js"></script>  

  <script src="views/web/assets/jquery/jquery.min.js"></script>
  <script src="views/bootstrap/js/bootstrap.min.js"></script>
  <script src="views/bootstrap/js/bootstrap_file_field.js"></script>
  <script src="views/smooth-scroll/SmoothScroll.js"></script>
  <script src="views/jarallax/jarallax.js"></script>
  <script src="views/mobirise/js/script.js"></script>
  
  <script language="javascript">
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
  </script>
  