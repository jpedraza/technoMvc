<?php include(HTML_DIR . 'overall/header.php'); ?>

<body>
<section class="engine"><a rel="nofollow" href="#"><?php echo APP_TITLE ?></a></section>


<?php include(HTML_DIR . '/overall/topnav.php'); ?>


<section>
    <!--PAGINA DE CONTACTO-->
    <div id="contact-page" class="container">
        <div class="bg">
            <div class="row">           
                <div class="col-sm-12">                         
                    <h2 class="title text-center">Contactanos</h2>
                    <iframe class="contact-map" src="https://www.google.com/maps/embed?pb=!1m23!1m12!1m3!1d3925.74555622869!2d-66.37574706711685!3d10.282073781813889!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m8!3e6!4m0!4m5!1s0x8c2b0e54fa3b7291%3A0xc2efda86e00413fc!2sCalle+Las+Clavellinas%2C+Caucagua%2C+Miranda%2C+Venezuela!3m2!1d10.2842459!2d-66.37767149999999!5e0!3m2!1ses-419!2s!4v1467674296035" frameborder="0" style="border:0" allowfullscreen></iframe>
                </div>                  
            </div>      
            <div class="row">   
                <div class="col-sm-7">
                    <div class="contact-form">
                        <h2 class="title text-center">Contacto Web</h2>
                        <div class="status alert alert-success" style="display: none"></div>
                        <form id="main-contact-form" class="contact-form row" name="contact-form" method="post">
                            <div class="form-group col-md-6">
                                <input type="text" name="name" class="form-control" required="required" placeholder="Nombre y Apellido">
                            </div>
                            <div class="form-group col-md-6">
                                <input type="email" name="email" class="form-control" required="required" placeholder="Correo Electr&oacute;nico">
                            </div>
                            <div class="form-group col-md-12">
                                <input type="text" name="subject" class="form-control" required="required" placeholder="Asunto">
                            </div>
                            <div class="form-group col-md-12">
                                <textarea name="message" id="message" required="required" class="form-control" rows="8" placeholder="Escribe tu mensaje aqu&iacute;"></textarea>
                            </div>                        
                            <div class="form-group col-md-12">
                                <input type="submit" name="submit" class="btn btn-primary pull-right" value="Enviar">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-sm-5">
                    <div class="contact-info">
                        <h2 class="title text-center">Informaci&oacute;n de Contacto</h2>
                        <address>
                            <p>Technotronic Game RK. C.A.</p>
                            <p style="text-align: justify;">Calle las colinas local 1, parroquia Caucagua, municipio Acevedo. Estado Miranda - Venezuela</p>
                            <p>Celular: +58 424 2228991</p>
                            <p>Local:   +58 239 5555555</p>
                            <p>Email: <a href="mailto:inv.technotronicgame.rk@gmail.com" style="text-decoration: none;">inv.technotronicgame.rk@gmail.com</a></p>
                        </address>
                        <div class="social-icons">
                            <h2 class="title text-center">Redes Sociales</h2>
                            <ul class="title text-center">
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
    </div>
    <!--/FIN DE PAGINA DE CONTACTO-->
</section>

<?php include(HTML_DIR . 'overall/footer.php'); ?>

</body>
</html>
