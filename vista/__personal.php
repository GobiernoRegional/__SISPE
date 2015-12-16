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
<!DOCTYPE: html>
<html>
    <head>
        <meta charset="UTF-8">
        <title> SISPE: Mantenimientos de Personal</title>
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
        
       <!-- HACIENDO REFERENCIA AL CONTENIDO DE PÁGINA -->
        <div class="wrapper">
            <?php
            
            include './cabecera.php';
            ?>
            <aside class="main-sidebar">
                <?php
                include './menu.php';
                ?>
            </aside>
           
            
            <!-- INICIO: Contenido de la página -->
            <div class="content-wrapper">
                <section class="content-header">
                    <h1> Mantenimiento de Personal</h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-home"></i> Principal</a></li>
                        <li><a href="#">Mantenimientos</a></li>
                        <li class="active">Personal</li>
                    </ol>
                </section>
              
                <!--INICIO DE SECCIÓN DE TRABAJO-->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12"> 
                            
                            <!--PREMER BOX-->
                            <div class="box">
                                <div class="box-body">
                                    <div id="listados">
                                    </div>
                                 </div><!-- /.box-body -->
                            </div><!-- /.box -->
                            
                            <!--SEGUNO BOX-->
                            <div class="box">
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <button type="submit" class="btn btn-success" data-toggle="modal" 
                                                    data-target="#myModal" onclick="agregarPersonal(2)">Registrar Nuevo Personal
                                            </button>
                                        </div>
                                        <div class="col-xs-2">
                                            
                                        </div>
                                        <div class="col-xs-2">
                                            <div class="radio">
                                                <label>
                                                    &nbsp;&nbsp;&nbsp;
                                                    <input type="radio" name="marcar" id="marcar" onclick="SeleccionarPersonal(1)" value="1">
                                                  <b>Marcar Todos</b>
                                                </label>
                                            </div>                                            
                                        </div>
                                        <div class="col-xs-3">                                            
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="marcar" id="desmarcar"  onclick="SeleccionarPersonal(2)"value="2">
                                                  <b>Desmarcar Todos</b>
                                                </label>                                                 
                                            </div>
                                        </div>
                                        <div class="col-xs-2">
                                            <div class="pull-right hidden-xs">
                                                <button type="submit" class="btn btn-danger" 
                                                        onclick="EliminarVariosPersonales()(1)">Eliminar Seleccionados
                                                </button>
                                            </div>    
                                        </div>
                                    </div>
                                </div><!-- /.FIN box-body -->
                            </div><!-- /.FIN BOX -->  
                            
                        </div><!-- /.FIN DE COLUMNA -->
                    </div><!-- /. FIN DE FILA -->
                </section><!-- /.FIN DE SECCIÓN DE TRABAJO--> 
                
                <!--INICIO: DE FORMULARIOS MODALES-->
                <form name="frmgrabar" id="frmgrabar" method="post" action="/">
                    <div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="myModalLabel" onclick="agregarPersonal();">AGREGAR PERSONAL</h4>
                                </div>
                                <div class="modal-body">
                                    <p><input type="hidden" name="txttipooperacion" id="txttipooperacion" class="form-control" required=""><p>
                                    
                                     <div class="row">
                                         <div class="col-xs-3">
                                             <div class="form-group">
                                                 <input type="text" class="form-control input-sm" readonly="" id="txtcodigoper" name="txtcodigoper"/>
                                             </div>
                                         </div>
                                    </div><!-- /row -->
                                    <div class="row">
                                        <div class="col-xs-5">
                                            <div class="form-group">
                                                <input type="text" class="form-control input-sm" id="txnombres" name="txnombres" placeholder="Ingrese Nombres" required="">
                                            </div>
                                        </div>
                                        <div class="col-xs-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control input-sm" id="txtapellido" name="txtapellido"  placeholder="Ingrese Apellidos"required="">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-xs-5">
                                            <div class="form-group">
                                                <input type="text" class="form-control input-sm" id="txtdni" name="txtdni"  placeholder="Ingrese DNI" required="">
                                            </div>
                                        </div>
                                        <div class="col-xs-6">
                                            <div class="form-group">
                                              <select class="form-control input-sm" name="cbosexo_modal" id="cbosexo_modal"  required="" >
                                                  <option value="" >---------------------&nbsp; Sexo &nbsp;--------------------- </option>
                                                  <option value="H">MASCULINO</option>
                                                  <option value="M">FEMENINO</option>
                                              </select> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-5">
                                            <div class="form-group">
                                                <input type="text" class="form-control input-sm" id="txtdireccion" name="txtdireccion"  placeholder="Ingrese Dirección" required="">
                                            </div>
                                        </div>
                                        <div class="col-xs-5">
                                            <div class="form-group">
                                              <div class="input-group">
                                                  <div class="input-group-addon">
                                                      <span class="text-blue">Nacimiento:&nbsp;<i class="fa fa-calendar"></i></span>
                                                  </div>
                                                  <input type="date" id="txtfechanacimiento" name="txtfechanacimiento" class="form-control input-sm" value="<?php echo date('Y-m-d'); ?>" required=""/>
                                              </div>

                                            </div>
                                        </div>
                                    </div>   
                                    <div class="row">
                                        <div class="col-xs-5">
                                            <div class="form-group">
                                                <input type="text" class="form-control input-sm" id="txtcorreo" name="txtcorreo"  placeholder="Correo Electrónico" required="">
                                            </div>
                                        </div>
                                        <div class="col-xs-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control input-sm" id="txttelefono" name="txttelefono"  placeholder="Número Telefonico" required="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-5">
                                            <div class="form-group">
                                              <select class="form-control input-sm" name="cboinstitucion_modal" id="cboinstitucion_modal"  required="" >
                                                  <option value="">---------&nbsp; Institución &nbsp;---------</option>
                                              </select> 
                                            </div>
                                        </div>
                                        <div class="col-xs-6">
                                            <div class="form-group">
                                              <select class="form-control input-sm" name="cbocargo_modal" id="cbocargo_modal"  required="" >
                                                  <option value="">---------&nbsp; Cargo &nbsp;---------</option>
                                              </select> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-5">
                                            <div class="form-group">
                                                <input type="hidden" id="txtcoddistrito" name="txtcoddistrito"/>
                                                <input class="form-control input-sm" type="text" list="cbodistrito_modal" id="dtdistrito_modal" name="dtdistrito_modal" placeholder="Ubicación" required=""/>
                                                <datalist name="dtdistrito_modal" id="cbodistrito_modal">
                                                    
                                                </datalist>
<!--                                              <select class="form-control input-sm" name="cbodistrito_modal" id="cbodistrito_modal"  required="" >  
                                                  <option value="">---------&nbsp; Distritos &nbsp;---------</option>
                                              </select> -->
                                            </div>
                                        </div>
                                        <div class="col-xs-6">
                                            <div class="form-group">
                                              <select class="form-control input-sm" name="cboestado_modal" id="cboestado_modal"  required="" >
                                                  <option value="">---------&nbsp; Estado &nbsp;---------</option>
                                                  <option value="A">Activo &nbsp</option>
                                                  <option value="I"> Inactivo &nbsp;</option>
                                              </select> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-success" aria-hidden="true">Aceptar</button>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal" id="btncerrar">Cancelar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <!--FIN: DE FORMULARIOS MODALES--> 
                
            </div>
              <!-- FIN: Contenido de la página -->
        </div>
        <!-- FIN DE LA REFERENCIA DEL CONTENIDO PÀGINA-->
        
        
        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                <b> Version </b> 1.0
            </div>
            <strong> Copyright &nbsp; <?php echo date("Y");?> <a href="#"> Sitema Comercial </a></strong>
            Todos los Derechos Reservados
        </footer>
        
        <div>
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
            
            <!-- Comportamientos -->  
            <script src="js/personal.js"></script>
        </div>
    </body>
</html>