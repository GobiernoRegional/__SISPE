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
                <li class="active">Objetivo Nacional</li>
            </ol>
        	<div class="row">
               <div style="text-align:center;">
                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#myModal" style="display: inline-block;"><i class="fa fa-hand-o-right"></i></a>
                </div>
                <div style="text-align:center;">
                    <label style="display: inline-block; font-size:16px; margin-top: 10px; margin-bottom: 20px;">Agregar Objetivo Nacional</label>
                </div>
            </div>
            <!-- INICIO del formulario modal GRABAR -->
            <form name="frmgrabar" id="frmgrabar">
                <div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="titulomodal">Agregar nuevo objetivo</h4>
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
                                <label>Objetivo Nacional:</label>
                              </div>
                              <div class="col-lg-8">
                                <input type="text" class="form-control" name="txtobjetivo" id="txtobjetivo" onchange="camposMayus(this)"><br>
                              </div>
                              <div class="col-lg-4">
                                  <label>Descripción:</label>
                              </div>
                              <div class="col-lg-8">
                                  <textarea class="form-control" name="txtdescripcion" id="txtdescripcion"></textarea><br>
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
                        <h4 class="modal-title" id="titulomodal">Editar objetivo</h4>
                      </div>
                      <div class="modal-body">
                          <div class="row">
                              <input type="hidden" name="txtcodigo" id="txtcodigo">
                              <div class="col-lg-4">
                                <label>Eje Estratégico:</label>
                              </div>
                              <div class="col-lg-8">
                                <select class="form-control" name="txtejeedit" id="txtejeedit">
                                  <option value="0">Elegir Eje</option>
                                </select><br>
                              </div>
                              <div class="col-lg-4">
                                <label>Objetivo Nacional:</label>
                              </div>
                              <div class="col-lg-8">
                                <input type="text" class="form-control" name="txtobjetivoedit" id="txtobjetivoedit" onchange="camposMayus(this)"><br>
                              </div>
                              <div class="col-lg-4">
                                  <label>Descripción:</label>
                              </div>
                              <div class="col-lg-8">
                                  <textarea class="form-control" name="txtdescripcionedit" id="txtdescripcionedit"></textarea><br>
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

            <div class="row">
                <div class="table-responsive">
                    <table class="table" id="tableobjetivonacional">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Eje Estratégico</th>
                                <th>Objetivo Nacional</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody id="bodyobjetivonacional">
                            
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
    <script type="text/javascript" src="js/pnObjetivoNacional.js"></script>
  </body>
</html>