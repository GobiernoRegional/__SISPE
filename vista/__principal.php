<?php //
    session_name("sistema-spe");
    session_start();
    
    if( ! isset($_SESSION["usuario"])){
        header("location:index.php");        
    }        
    
    $nombreUsuario = ucwords(strtolower($_SESSION["usuario"]));
    $cargo = ucwords(strtolower($_SESSION["cargo"]));
    $cuenta = ucwords(strtolower($_SESSION["cuenta"]));
    $clave = ucwords(strtolower($_SESSION["clave"]));   
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Principal: SISPE</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="../util/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="../util/lte/css/font-awesome.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="../util/lte/css/AdminLTE.css" rel="stylesheet" type="text/css" />
    
    <!-- Extilos extras-->
    <link href="../util/lte/css/extras.css" rel="stylesheet" type="text/css" />
    
    <!-- Ionicons -->
    <link href="../util/lte/css/ionicons.css" rel="stylesheet" type="text/css" />
    
    <!-- Theme style -->
    <link href="../util/lte/skins/_all-skins.css" rel="stylesheet" type="text/css" />
    </head>
    <body class="skin-blue">
        <div class="wrapper">
            <?php
            include './cabecera.php';
            ?>
            <aside class="main-sidebar">
                <?php
                            include './menu.php';
                ?>
            </aside>
            <div class="content-wrapper">
                <section class="content">
                    <div>
                        <div class="col-xs-12">
                            Bienvenido al Sistema
                        </div>
                    </div>
                </section>
            </div>
<!--            Contenido de la Página-->
            <footer class="main-footer">
                <div class="pull-right hidden-xs">
                    <b>Versión</b> 1.0
                </div>
                <strong>Copyright &copy; <?php echo date('Y'); ?> <a href="principal.php">Sistema SISPE</a>.</strong> Todos los derechos reservados.
            </footer>
        </div>
        <!-- jQuery 2.1.3 -->
    <script src="../util/jquery/jquery.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="../util/bootstrap/js/bootstrap.js" type="text/javascript"></script>
    <!-- SlimScroll -->
    <script src="../util/lte/plugins/slimScroll/jquery.slimScroll.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='../util/lte/plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="../util/lte/js/app.js" type="text/javascript"></script>
    <!-- Temas -->
    <script src="../util/lte/js/demo.js" type="text/javascript"></script>
    <script src="js/permisos.js"></script>
  </body>
</html>