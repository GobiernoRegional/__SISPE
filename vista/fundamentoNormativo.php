<?php
    session_name("sistema-spe");
    session_start();
    
    if( ! isset($_SESSION["usuario"])){
        header("location:index.php");
    }
        
    $nombreUsuario = ucwords(strtolower($_SESSION["usuario"]));
    $cargo = ucwords(strtolower($_SESSION["cargo"]));

    
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
        <!-- DATA TABLES -->
        <link href="../util/lte/plugins/datatables/dataTables.bootstrap.css" type="text/css" rel="stylesheet"/>
        <!-- SWEET ALERT -->
        <link rel="stylesheet" href="../util/sweet/sweetalert.css">
	    <!-- CSS Propio -->
	    <link href="../util/css/style.css" rel="stylesheet" type="text/css" />
	    <!-- ICONO -->
	    <link rel="shortcut icon" href="../util/logins/img/grl2.png">
    </head>
    <body >
        <?php
            include 'menu.php';
        ?>
        <br>
        <div class="container">
            <ol class="breadcrumb">
                <li><a href="principal.php"><i class="fa fa-home"></i> SISPE</a></li>
                <li><a href="#">PRDC</a></li>
                <li class="active">Indicadores</li>
            </ol>
        	<div class="row">
               <div style="text-align:center;">
                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#myModal" style="display: inline-block;"><i class="fa fa-suitcase"></i></a>
                </div>
                <div style="text-align:center;">
                    <label style="display: inline-block; font-size:16px; margin-top: 10px; margin-bottom: 20px;">Agregar Indicadores</label>
                </div>
            </div>
          
                         
            <!-- FIN del formulario modal -->  
            <!-- INICIO del formulario modal GRABAR -->
            <form name="frmeditar" id="frmeditar">
             
                <div>
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
                      <div class="modal-footer">
                          <button type="submit" class="btn btn-success" aria-hidden="true">Grabar los datos</button>
                          <button type="button" class="btn btn-default" data-dismiss="modal" id="btncerrar">Cerrar</button>
                      </div>
                    </div>
      
            <!-- FIN del formulario modal -->   
        
        <?php
            include 'footer.php';
        ?>
     <!-- jQuery 2.1.3 -->
    <script src="../util/jquery/jquery.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="../util/bootstrap/js/bootstrap.js" type="text/javascript"></script>
    <!-- DATA TABLE -->
    <script src="../util/lte/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
    <script src="../util/lte/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
    <!-- SWEET JS -->
    <script type="text/javascript" src="../util/sweet/sweetalert-dev.js"></script>
    <!-- JS Propio -->
    <script type="text/javascript" src="js/prIndicador.js"></script>
    <script type="text/javascript" src="js/util.js"></script>
<!--        ----------------
        <div class="wrapper">
            <?php
//            include './cabecera.php';
            ?>
            <aside class="main-sidebar">
                <?php
//                    include './menu.php';
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
             INICIO del formulario modal eLIMINAR             
                <div class="modal fade" id="myModale" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="titulomodal">ESTA SEGURO DE ELIMINAR ESTE ELEMENTO</h4>
                      </div>
                      <div class="modal-footer">
                          <input type="hidden" name="txtcodigoeliminar" id="txtcodigoeliminar">
                          <button type="submit" class="btn btn-success" aria-hidden="true" onclick="eliminardato('si')">Aceptar</button>
                          <button type="button" class="btn btn-default" data-dismiss="modal" name="btncerrareliminar"id="btncerrareliminar" onclick="eliminardato('no')">Cancelar</button>
                      </div>
                    </div>
                  </div>
                </div>        
             FIN del formulario Eliminar   
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
            Contenido de la Página
            <footer class="main-footer">
                <div class="pull-right hidden-xs">
                    <b>Versión</b> 1.0
                </div>
                <strong>Copyright &copy; <?php echo date('Y'); ?> <a href="principal.php">Sistema SISPE</a>.</strong> Todos los derechos reservados.
            </footer>
        </div>
         jQuery 2.1.3 
    <script src="../util/jquery/jquery.min.js"></script>
     Bootstrap 3.3.2 JS 
    <script src="../util/bootstrap/js/bootstrap.js" type="text/javascript"></script>
     DATA TABLE 
    <script src="../util/lte/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
    <script src="../util/lte/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
     SlimScroll 
    <script src="../util/lte/plugins/slimScroll/jquery.slimScroll.min.js" type="text/javascript"></script>
     FastClick 
    <script src='../util/lte/plugins/fastclick/fastclick.min.js'></script>
     AdminLTE App 
    <script src="../util/lte/js/app.js" type="text/javascript"></script>
     Temas 
    <script src="../util/lte/js/demo.js" type="text/javascript"></script>
    <script src="js/fundamentonormativo.js"></script>
    <script type="text/javascript" src="../util/ckeditor/ckeditor.js"></script>
  </body>-->
</html>