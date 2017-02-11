<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <base href="<?php echo APP_URL ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="generator" content="Mobirise v2.8.3, mobirise.com">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="views/images/ico/favicon.ico" />
  <meta name="description" content="">
  <meta name="author" content="Luis Candelario">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:700,400&amp;subset=cyrillic,latin,greek,vietnamese">
  <link rel="stylesheet" href="views/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="views/bootstrap/css/bootstrap_file_field.css">
  <link rel="stylesheet" href="views/socicon/css/socicon.min.css">
  <link rel="stylesheet" href="views/mobirise/css/style.css">
  <link rel="stylesheet" href="views/mobirise/css/mbr-additional.css" type="text/css">
  <link rel="stylesheet" href="views/fontawesome/css/fonts.css" type="text/css">
  <link rel="stylesheet" href="views/app/css/format.css" type="text/css">
  <link rel="stylesheet" href="views/app/css/prettyPhoto.css" type="text/css">
  <link rel="stylesheet" href="views/app/css/price-range.css" type="text/css">
  <link rel="stylesheet" href="views/app/css/animate.css" type="text/css">
  <link rel="stylesheet" href="views/app/css/main.css" type="text/css">
  <link rel="stylesheet" href="views/responsive/css/responsive.css" type="text/css">

  <script src="vendor/path/to/tinymce/js/tinymce/tinymce.min.js"></script>
  <script type="text/javascript">
    tinymce.init({
      selector: '#detalle',
      language_url : 'vendor/path/to/tinymce/js/tinymce/langs/es.js',  // site absolute URL
      language: 'es',
      entity_encoding: 'raw',
      height: 300,
      menubar: false,
    plugins: [
      'advlist autolink lists link image charmap print preview hr anchor pagebreak',
      'searchreplace wordcount visualblocks visualchars code fullscreen',
      'insertdatetime nonbreaking save table contextmenu directionality',
      'emoticons template paste textcolor colorpicker textpattern imagetools toc'
    ],
    toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | forecolor backcolor emoticons',
    image_advtab: true,
    templates: [
      { title: 'Test template 1', content: 'Test 1' },
      { title: 'Test template 2', content: 'Test 2' }
    ]
   });
  </script>
  
  <script src="views/app/js/generales.js"></script>
  <!--[if lt IE 9]>
    <script src="views/app/js/html5shiv.js"></script>
    <script src="views/app/js/respond.min.js"></script>
  <![endif]--> 
  <title>
    <?php 
      $archivo_actual   = !isset($_GET['view']) ? "index" : $_GET['view'];    
      $modo_actual      = !isset($_GET['mode']) ? "" : $_GET['mode'];    
        switch ($archivo_actual) {
            case "index":
                echo "Home";
                break;
            case "categorias":
                echo "Categorías";
                break;
            case "productos":
                echo "Productos";
                break;
            case "subcategorias":
                echo "Subcategorías";
                break;            
            case "login":
                echo "Login";
                break;            
            case "reg":
                echo "Registro";
                break;            
            case "lostpass":
                echo "Recuperar Clave";
                break;            
            case "detalles":
                echo "Detalle " . strtoupper(substr($modo_actual,0,1)) . substr($modo_actual,1) . " ";
                break;            
            case "mostrar":
                echo "Productos";
                break;            
            case "carrito":
                echo "Carrito";
                break;
            case "favoritos":
                echo "Favoritos";
                break;
            case "perfil":
                echo "Mi Perfil";
                break;
            case "editpass":
                echo "Cambio exitoso";
                break;
            case "lostpass":
                echo "Recuperar Clave";
                break;
            case "activar":
                echo "Activar Usuario";
                break;
            default:
                echo "404";
                break;
        }
    echo ' '. APP_TITLE ?></title>
</head>
   