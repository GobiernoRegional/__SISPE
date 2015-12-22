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
            <!-- INICIO del formulario modal GRABAR -->
            <form name="frmgrabar" id="frmgrabar">
                <div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="titulomodal">Agregar nuevo indicador</h4>
                      </div>
                      <div class="modal-body">                         
                          <div class="row">
                              <div class="col-lg-4">
                                  <label>Variable:</label>
                              </div>
                              <div class="col-lg-8">
                                  <select class="form-control" name="txtvariable" id="txtvariable">
                                    <option value="0">Elegir Variable</option>
                                  </select><br>
                              </div>
                              <div class="col-lg-4">
                                  <label>Indicador:</label>
                              </div>
                              <div class="col-lg-8">
                                  <input type="text" class="form-control" name="txtindicador" id="txtindicador" onchange="camposMayus(this)"><br>
                              </div>
                              <div class="col-lg-4">
                                  <label>Línea Base - Cantidad:</label>
                              </div>
                              <div class="col-lg-8">
                                  <input type="text" class="form-control" name="txtlbcantidad" id="txtlbcantidad" onchange="camposMayus(this)" onkeypress="return soloNumeros(event)"><br>
                              </div>
                              <div class="col-lg-4">
                                  <label>Línea Base - Año:</label>
                              </div>
                              <div class="col-lg-8">
                                  <input type="text" class="form-control" name="txtlbanio" id="txtlbanio" onchange="camposMayus(this)" onkeypress="return soloNumeros(event)"><br>
                              </div>
                              <div class="col-lg-4">
                                  <label>Meta 2014:</label>
                              </div>
                              <div class="col-lg-8">
                                  <input type="text" class="form-control" name="txtmeta2014" id="txtmeta2014" onchange="camposMayus(this)" onkeypress="return soloNumeros(event)"><br>
                              </div>
                              <div class="col-lg-4">
                                  <label>Meta 2018:</label>
                              </div>
                              <div class="col-lg-8">
                                  <input type="text" class="form-control" name="txtmeta2018" id="txtmeta2018" onchange="camposMayus(this)" onkeypress="return soloNumeros(event)"><br>
                              </div>
                              <div class="col-lg-4">
                                  <label>Meta 2021:</label>
                              </div>
                              <div class="col-lg-8">
                                  <input type="text" class="form-control" name="txtmeta2021" id="txtmeta2021" onchange="camposMayus(this)" onkeypress="return soloNumeros(event)"><br>
                              </div>
                              <div class="col-lg-4">
                                  <label>Fuente:</label>
                              </div>
                              <div class="col-lg-8">
                                  <input type="text" class="form-control" name="txtfuente" id="txtfuente" onchange="camposMayus(this)"><br>
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
                        <h4 class="modal-title" id="titulomodal">Editar Variable</h4>
                      </div>
                      <div class="modal-body">
                          <div class="row">
                              <input type="hidden" name="txtcodigo" id="txtcodigo">
                              <div class="col-lg-4">
                                  <label>Variable:</label>
                              </div>
                              <div class="col-lg-8">
                                  <select class="form-control" name="txtvariableedit" id="txtvariableedit">
                                    <option value="0">Elegir Variable</option>
                                  </select><br>
                              </div>
                              <div class="col-lg-4">
                                  <label>Indicador:</label>
                              </div>
                              <div class="col-lg-8">
                                  <input type="text" class="form-control" name="txtindicadoredit" id="txtindicadoredit" onchange="camposMayus(this)"><br>
                              </div>
                              <div class="col-lg-4">
                                  <label>Línea Base - Cantidad:</label>
                              </div>
                              <div class="col-lg-8">
                                  <input type="text" class="form-control" name="txtlbcantidadedit" id="txtlbcantidadedit" onchange="camposMayus(this)" onkeypress="return soloNumeros(event)"><br>
                              </div>
                              <div class="col-lg-4">
                                  <label>Línea Base - Año:</label>
                              </div>
                              <div class="col-lg-8">
                                  <input type="text" class="form-control" name="txtlbanioedit" id="txtlbanioedit" onchange="camposMayus(this)" onkeypress="return soloNumeros(event)"><br>
                              </div>
                              <div class="col-lg-4">
                                  <label>Meta 2014:</label>
                              </div>
                              <div class="col-lg-8">
                                  <input type="text" class="form-control" name="txtmeta2014edit" id="txtmeta2014edit" onchange="camposMayus(this)" onkeypress="return soloNumeros(event)"><br>
                              </div>
                              <div class="col-lg-4">
                                  <label>Meta 2018:</label>
                              </div>
                              <div class="col-lg-8">
                                  <input type="text" class="form-control" name="txtmeta2018edit" id="txtmeta2018edit" onchange="camposMayus(this)" onkeypress="return soloNumeros(event)"><br>
                              </div>
                              <div class="col-lg-4">
                                  <label>Meta 2021:</label>
                              </div>
                              <div class="col-lg-8">
                                  <input type="text" class="form-control" name="txtmeta2021edit" id="txtmeta2021edit" onchange="camposMayus(this)" onkeypress="return soloNumeros(event)"><br>
                              </div>
                              <div class="col-lg-4">
                                  <label>Fuente:</label>
                              </div>
                              <div class="col-lg-8">
                                  <input type="text" class="form-control" name="txtfuenteedit" id="txtfuenteedit" onchange="camposMayus(this)"><br>
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
            <!-- INICIO del formulario modal eLIMINAR -->            
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
            <div class="row">
                <div class="table-responsive">
                    <table class="table table-bordered" id="tableindicador">
                        <thead>
                            <tr>
                              <th rowspan="2">Variable</th>
                              <th rowspan="2">Indicador</th>
                              <th colspan="2">Línea Base</th>
                              <th colspan="3">Metas</th>
                              <th rowspan="2">Fuente</th>
                              <th rowspan="2">Acción</th>
                            </tr>
                            <tr>
                                <th>Cantidad</th>
                                <th>Año</th>
                                <th>2014</th>
                                <th>2018</th>
                                <th>2021</th>
                            </tr>
                        </thead>
                        <tbody id="bodyindicador">
                            
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
    <script type="text/javascript" src="js/prIndicador.js"></script>
    <script type="text/javascript" src="js/util.js"></script>
  </body>
</html>