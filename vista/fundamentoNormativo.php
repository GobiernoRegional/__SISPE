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

        <!-- DATA TABLES -->
        <link href="../util/lte/plugins/datatables/dataTables.bootstrap.css" type="text/css" rel="stylesheet"/>
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
                <section class="content-header">
                    <h1> P.R.D.C <small>Fundamento Normativo</small></h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-home"></i> Principal</a></li>
                        <li><a href="#">P.R.D.C</a></li>
                        <li class="active">Fundamento Normativo</li>
                    </ol>
                </section>
                <section class="content">
                    <div class="row">
                        <div class="col-lg-1"></div>
                        <div class="col-lg-10">
                            <div class="box box-info">
                                <div class="box box-header">
                                    <h3 class="box-title">Registro de documentos</h3>
                                </div>
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <ul class="nav nav-tabs nav-justified">
                                                <li class="active"><a href="#tab1" data-toggle="tab"> Subir archivo</a></li>
                                                <li class=""><a href="#tab2" data-toggle="tab">Registrar manualmente</a></li>
                                            </ul>
                                            <div class="tab-content">
                                                <div class="tab-pane active" id="tab1">
                                                    <br>
                                                    <form id="frmSubirArchivo" enctype="multipart/form-data">
                                                        <div class="col-lg-4">
                                                            <label>Título:</label>
                                                        </div>
                                                        <div class="col-lg-8">
                                                            <input type="text" class="form-control" name="txtitulo" id="txtitulo"><br> 
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <label>Archivo:</label>
                                                        </div>
                                                        <div class="col-lg-8">
                                                            <input type="file" name="txtarchivo" id="txtarchivo" class="form-control"><br>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <label>Descripción:</label>
                                                        </div>
                                                        <div class="col-lg-8">
                                                            <textarea class="form-control" name="txtdescripcion" id="txtdescripcion">
                                                                
                                                            </textarea><br>
                                                        </div>
                                                        <button class="btn btn-success center-block">Guardar documento</button>
                                                    </form>
                                                </div>
                                                <div class="tab-pane" id="tab2">
                                                    <br>
                                                    <form id="frmRegistroManual">
                                                        <div class="col-lg-2">
                                                            <label>Título:</label>
                                                        </div>
                                                        <div class="col-lg-10">
                                                            <input type="text" class="form-control" name="txtitulo" id="txtitulo"><br> 
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <label>Documento:</label>
                                                        </div>
                                                        <div class="col-lg-10">
                                                            <textarea class="form-control" name="txtdescripcioneditor" id="txtdescripcioneditor">
                                                                
                                                            </textarea><br>
                                                        </div>
                                                        <button class="btn btn-success center-block">Guardar documento</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-1"></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="box box-success">
                                <div class="box box-header">
                                    <h3 class="box-title">Listado</h3>
                                </div>
                                <div class="box-body" id="creartabledocumento">
                                    
                                </div>
                            </div>
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
    <!-- DATA TABLE -->
    <script src="../util/lte/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
    <script src="../util/lte/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
    <!-- SlimScroll -->
    <script src="../util/lte/plugins/slimScroll/jquery.slimScroll.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='../util/lte/plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="../util/lte/js/app.js" type="text/javascript"></script>
    <!-- Temas -->
    <script src="../util/lte/js/demo.js" type="text/javascript"></script>
    <script src="js/fundamentonormativo.js"></script>
    <script type="text/javascript" src="../util/ckeditor/ckeditor.js"></script>
  </body>
</html>