<?php
	/*
    session_name("sistema-spe");
    session_start();
    
    if( ! isset($_SESSION["usuario"])){
        header("location:index.php");        
    }        
    
    $nombreUsuario = ucwords(strtolower($_SESSION["usuario"]));
    $cargo = ucwords(strtolower($_SESSION["cargo"]));
    $cuenta = ucwords(strtolower($_SESSION["cuenta"]));
    $clave = ucwords(strtolower($_SESSION["clave"]));
    */   
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>HOME | SISPE</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
	    <!-- Bootstrap 3.3.2 -->
	    <link href="../util/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />
	    <!-- Font Awesome Icons -->
	    <link href="../util/lte/css/font-awesome.css" rel="stylesheet" type="text/css" />
	    <!-- CSS Propio -->
	    <link href="../util/css/style.css" rel="stylesheet" type="text/css" />
	    <!-- ICONO -->
	    <link rel="shortcut icon" href="../util/logins/img/grl2.png">
    </head>
    <body>
        <?php
            include 'menu.php';
        ?>
        <br>
        <div class="container">
            <ol class="breadcrumb">
                <li class="active"><a href="principal.php"><i class="fa fa-home"></i> SISPE</a></li>
            </ol>
        	<div class="alert alert-info fade in">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4>Sistema de Plan Estratégico</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            </div>
        </div>
        <?php
            include 'footer.php';
        ?>
     <!-- jQuery 2.1.3 -->
    <script src="../util/jquery/jquery.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="../util/bootstrap/js/bootstrap.js" type="text/javascript"></script>
  </body>
</html>