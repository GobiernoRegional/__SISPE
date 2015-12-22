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
                <li><a href="#">Gestiones</a></li>
                <li class="active">Personal</li>
            </ol>
            <div class="row">
               <div style="text-align:center;">
                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#myModal" style="display: inline-block;"><i class="fa fa-user-plus"></i></a>
                </div>
                <div style="text-align:center;">
                    <label style="display: inline-block; font-size:16px; margin-top: 10px; margin-bottom: 20px;">Agregar personal</label>
                </div>
            </div>

            <!-- INICIO del formulario modal -->
            <form name="frmgrabar" id="frmgrabar">
                <div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="titulomodal">Agregar nuevo personal</h4>
                      </div>
                      <div class="modal-body">
                          <div class="row">
                              <div class="col-lg-4">
                                  <label>Nombres:</label>
                              </div>
                              <div class="col-lg-8">
                                  <input type="text" class="form-control" name="txtnombres" id="txtnombres" onchange="camposMayus(this)" required=""><br>
                              </div>
                              <div class="col-lg-4">
                                  <label>Apellidos:</label>
                              </div>
                              <div class="col-lg-8">
                                  <input type="text" class="form-control" name="txtapellidos" id="txtapellidos" onchange="camposMayus(this)" required=""><br>
                              </div>
                              <div class="col-lg-2">
                                  <label>DNI:</label>
                              </div>
                              <div class="col-lg-4">
                                  <input type="text" class="form-control" name="txtdni" id="txtdni" maxlength="8" onkeypress="return soloNumeros(event)" required=""><br>
                              </div>
                              <div class="col-lg-2">
                                  <label>F. Nac:</label>
                              </div>
                              <div class="col-lg-4">
                                  <input type="date" class="form-control" name="txtfechanacimiento" id="txtfechanacimiento" required=""><br>
                              </div>
                              <div class="col-lg-2">
                                  <label>Dirección:</label>
                              </div>
                              <div class="col-lg-4">
                                  <input type="text" class="form-control" name="txtdireccion" id="txtdireccion" onchange="camposMayus(this)" required=""><br>
                              </div>
                              <div class="col-lg-2">
                                  <label>Sexo:</label>
                              </div>
                              <div class="col-lg-4">
                                  <select class="form-control" name="txtsexo" id="txtsexo" required="">
                                    <option value="1">MASCULINO</option>
                                    <option value="2">FEMENINO</option>
                                  </select><br>
                              </div>
                              <div class="col-lg-2">
                                  <label>Email:</label>
                              </div>
                              <div class="col-lg-4">
                                  <input type="email" class="form-control" name="txtemail" id="txtemail" required=""><br>
                              </div>
                              <div class="col-lg-2">
                                  <label>Teléfono:</label>
                              </div>
                              <div class="col-lg-4">
                                  <input type="text" class="form-control" name="txttelefono" id="txttelefono" onkeypress="return soloNumeros(event)" required=""><br>
                              </div>
                              <div class="col-lg-2">
                                  <label>Cargo:</label>
                              </div>
                              <div class="col-lg-4">
                                  <select class="form-control" name="txtcargo" id="txtcargo" required="">
                                    <option value="0">Elegir Cargo</option>
                                  </select><br>
                              </div>
                              <div class="col-lg-2">
                                  <label>Área:</label>
                              </div>
                              <div class="col-lg-4">
                                  <select class="form-control" name="txtarea" id="txtarea" required="">
                                    <option value="0">Elegir Área</option>
                                  </select><br>
                              </div>
                              <div class="col-lg-4">
                                <label>Acceso:</label>
                              </div>
                              <div class="col-lg-8">
                                  <select class="form-control" name="txtacceso" id="txtacceso" onchange="visible(this.value)">
                                  <option value="1">NO TIENE ACCESO</option>
                                  <option value="2">TIENE ACCESO</option>
                                </select><br>
                              </div>
                              <div id="divacceso">
                                <div class="col-lg-2">
                                  <label>Usuario:</label>
                                </div>
                                <div class="col-lg-4">
                                    <input type="text" class="form-control" name="txtusuario" id="txtusuario"><br>
                                </div>
                                <div class="col-lg-2">
                                  <label>Password:</label>
                                </div>
                                <div class="col-lg-4">
                                    <input type="password" class="form-control" name="txtpassword" id="txtpassword"><br>
                                </div>
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
            <!-- INICIO del formulario modal -->
            <form name="frmeditar" id="frmeditar">
                <div class="modal fade" id="myModal2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="titulomodal">Editar personal</h4>
                      </div>
                      <div class="modal-body">
                          <div class="row">
                              <input type="hidden" class="form-control" name="txtcodigo" id="txtcodigo" readonly="readonly"><br>
                              <div class="col-lg-4">
                                  <label>Nombres:</label>
                              </div>
                              <div class="col-lg-8">
                                  <input type="text" class="form-control" name="txtnombresedit" id="txtnombresedit" onchange="camposMayus(this)" required=""><br>
                              </div>
                              <div class="col-lg-4">
                                  <label>Apellidos:</label>
                              </div>
                              <div class="col-lg-8">
                                  <input type="text" class="form-control" name="txtapellidosedit" id="txtapellidosedit" onchange="camposMayus(this)" required=""><br>
                              </div>
                              <div class="col-lg-2">
                                  <label>DNI:</label>
                              </div>
                              <div class="col-lg-4">
                                  <input type="text" class="form-control" name="txtdniedit" id="txtdniedit" maxlength="8" onkeypress="return soloNumeros(event)" required=""><br>
                              </div>
                              <div class="col-lg-2">
                                  <label>F. Nac:</label>
                              </div>
                              <div class="col-lg-4">
                                  <input type="date" class="form-control" name="txtfechanacimientoedit" id="txtfechanacimientoedit" required=""><br>
                              </div>
                              <div class="col-lg-2">
                                  <label>Dirección:</label>
                              </div>
                              <div class="col-lg-4">
                                  <input type="text" class="form-control" name="txtdireccionedit" id="txtdireccionedit" onchange="camposMayus(this)" required=""><br>
                              </div>
                              <div class="col-lg-2">
                                  <label>Sexo:</label>
                              </div>
                              <div class="col-lg-4">
                                  <select class="form-control" name="txtsexoedit" id="txtsexoedit" required="">
                                    <option value="1">MASCULINO</option>
                                    <option value="2">FEMENINO</option>
                                  </select><br>
                              </div>
                              <div class="col-lg-2">
                                  <label>Email:</label>
                              </div>
                              <div class="col-lg-4">
                                  <input type="email" class="form-control" name="txtemailedit" id="txtemailedit" required=""><br>
                              </div>
                              <div class="col-lg-2">
                                  <label>Teléfono:</label>
                              </div>
                              <div class="col-lg-4">
                                  <input type="text" class="form-control" name="txttelefonoedit" id="txttelefonoedit" onkeypress="return soloNumeros(event)" required=""><br>
                              </div>
                              <div class="col-lg-2">
                                  <label>Cargo:</label>
                              </div>
                              <div class="col-lg-4">
                                  <select class="form-control" name="txtcargoedit" id="txtcargoedit" required="">
                                    <option value="0">Elegir Cargo</option>
                                  </select><br>
                              </div>
                              <div class="col-lg-2">
                                  <label>Área:</label>
                              </div>
                              <div class="col-lg-4">
                                  <select class="form-control" name="txtareaedit" id="txtareaedit" required="">
                                    <option value="0">Elegir Área</option>
                                  </select><br>
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
                    <table class="table" id="tablepersonal">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Personal</th>
                                <th>Área</th>
                                <th>Cargo</th>
                                <th>DNI</th>
                                <th>Email</th>
                                <th>Teléfono</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody id="bodypersonal">
                            
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
    <!-- DATA TABLE -->
    <script src="../util/lte/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
    <script src="../util/lte/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
    <!-- SWEET JS -->
    <script type="text/javascript" src="../util/sweet/sweetalert-dev.js"></script>
    <!-- JS Propio -->
    <script type="text/javascript" src="js/personal.js"></script>
    <script type="text/javascript" src="js/util.js"></script>
  </body>
</html>