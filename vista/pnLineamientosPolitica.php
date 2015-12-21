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
    <body>
        <?php
            include 'menu.php';
        ?>
        <br>
        <div class="container">
            <ol class="breadcrumb">
                <li><a href="principal.php"><i class="fa fa-home"></i> SISPE</a></li>
                <li><a href="#">Plan Perú</a></li>
                <li class="active">Lineamientos de Política</li>
            </ol>
        	<div class="row">
               <div style="text-align:center;">
                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#myModal" style="display: inline-block;"><i class="fa fa-tasks"></i></a>
                </div>
                <div style="text-align:center;">
                    <label style="display: inline-block; font-size:16px; margin-top: 10px; margin-bottom: 20px;">Agregar Lineamientos</label>
                </div>
            </div>
            <!-- INICIO del formulario modal GRABAR -->
            <form name="frmgrabar" id="frmgrabar">
                <div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="titulomodal">Agregar nuevo lineamiento</h4>
                      </div>
                      <div class="modal-body">
                          <div class="row">
                              <div class="col-lg-4">
                                <label>Eje Estratégico:</label>
                              </div>
                              <div class="col-lg-8">
                                <select class="form-control" name="txteje" id="txteje">
                                  <option value="0">Elegir Eje</option>
                                </select><br>
                              </div>
                              <div class="col-lg-4">
                                  <label>Nombre:</label>
                              </div>
                              <div class="col-lg-8">
                                  <input type="text" class="form-control" name="txtnombre" id="txtnombre" onchange="camposMayus(this)" required><br>
                              </div>
                              <div class="col-lg-2">
                                <label>Descripción</label>
                              </div>
                              <div class="col-lg-10">
                                <textarea class="form-control" name="txtdescripcion" id="txtdescripcion">
                                  
                                </textarea><br>
                              </div>
                          </div>
                      </div>
                      <div class="modal-footer">
                          <button type="submit" class="btn btn-success" aria-hidden="true">Grabar los datos</button>
                          <button type="button" class="btn btn-default" data-dismiss="modal" id="btncerrar">Cerrar</button>
                      </div>
                    </div>
                  </div>
                </div>
            </form>
            <!-- FIN del formulario modal -->  
            <!-- INICIO del formulario modal GRABAR -->
            <form name="frmeditar" id="frmeditar">
                <div class="modal fade" id="myModal2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="titulomodaledi">Editar lineamiento</h4>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                              <input type="hidden" name="txtcodigo" id="txtcodigo">
                              <div class="col-lg-4">
                                  <label id="labeltext1">Eje Estratégico:</label>
                              </div>
                              <div class="col-lg-8">
                                <select class="form-control" name="txtejeedit" id="txtejeedit">
                                  <option value="0">Elegir Eje</option>
                                </select><br>
                              </div>
                              <div class="col-lg-4">
                                  <label id="labeltex2t">Nombre:</label>
                              </div>
                              <div class="col-lg-8">
                                  <input type="text" class="form-control" name="txtnombreedit" id="txtnombreedit" onchange="camposMayus(this)" required><br>
                              </div>
                              <div class="col-lg-2">
                                <label id="labeltext3">Descripción</label>
                              </div>
                              <div class="col-lg-10">
                                  <textarea class="form-control" name="txtdescripcionedit" id="txtdescripcionedit" >
                                  
                                </textarea><br>
                              </div>
                          </div>
                      </div>
                      <div class="modal-footer">
                          <button type="submit" class="btn btn-success" aria-hidden="true">Grabar los datos</button>
                          <button type="button" class="btn btn-default" data-dismiss="modal" id="btncerrar">Cerrar</button>
                      </div>
                    </div>
                  </div>
                </div>
            </form>
            <!-- FIN del formulario modal -->  
            <!-- INICIO del formulario modal eliminar -->            
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
            <!-- FIN del formulario Eliminar --> 
            
                <!-- INICIO del formulario modal GRABAR -->
                <div class="modal fade" id="myModaldetalle" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="titulomodaledi">Detalle de Descripción</h4>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                              <input type="hidden" name="txtcodigo" id="txtcodigo">                              
                              <div class="col-lg-12">
                                  <textarea class="form-control" name="txtdescripcionvista" id="txtdescripcionvista" readonly="" >
                                  
                                </textarea><br>
                              </div>
                          </div>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-danger" data-dismiss="modal" id="btncerrar">Salir</button>
                      </div>
                    </div>
                  </div>
                </div>
            <!-- FIN del formulario modal -->  
            <div class="row">
                <div class="table-responsive">
                    <table class="table" id="tablelineamientos" > 
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Eje Estratégico</th>
                                <th>Lineamiento</th>
                                <th>Descripción</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody id="bodylineamientos">
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
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
    <script type="text/javascript" src="js/pnLineamientoPolitica.js"></script>
    <script type="text/javascript" src="../util/ckeditor/ckeditor.js"></script>
  </body>
</html>