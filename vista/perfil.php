<?php
    session_name("sistema-spe");
    session_start();
    if( ! isset($_SESSION["usuario"])){
        header("location:index.php");        
    }     
     $nombreUsuario     = ucwords(strtolower($_SESSION["usuario"]));
     $cargo             = ucwords(strtolower($_SESSION["cargo"]));
     $cuenta            = ucwords(strtolower($_SESSION["cuenta"]));
     $clave             = ucwords(strtolower($_SESSION["clave"]));
     $area              = ucwords(strtolower($_SESSION["area"]));
     $correo            = ucwords(strtolower($_SESSION["correo"]));
     $telefono          = ucwords(strtolower($_SESSION["telefono"]));
     $nombre            = ucwords(strtolower($_SESSION["nombres"]));
     $apellido          = ucwords(strtolower($_SESSION["apellidos"]));
     $dni               = ucwords(strtolower($_SESSION["dni"]));
     $direccion         = ucwords(strtolower($_SESSION["direccion"]));
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
                <li class="active"><a href="principal.php"><i class="fa fa-home"></i> SISPE</a></li>
            </ol>
            <div class="alert alert-info fade in">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <div class="box-body">
                    <div class="row">
                        <div class="col-md-3" align="center" ><!--Iniio de Columna-->
                            <div>
                                <img src="../util/imagenes/1.png"  class="img-circle" alt="User Image">
                            </div>
                            <div>
                                <h3 class="text-danger"> <?php echo $cargo; ?></h3>
                            </div><!--Fin de Columna-->
                        </div>   
                        <form name="frmgrabar" id="frmgrabar">
                        <div class="col-lg-7">
                            <div class="row">
                                <div class="form-group">
                                    <p>
                                    <label class="col-lg-2">Nombres: </label>
                                    <input type="text"   style="border-style:hidden;background: #D9EDF7;"  id="txtnombres"  name="txtnombres" readonly="" value="<?php echo $nombre; ?>"/>                            

                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <p>
                                     <label class="col-lg-2">Apellidos: </label> 
                                     <input type="text"   style="border-style:hidden;background: #D9EDF7;"  id="txtapellidos"  name="txtapellidos" readonly="" value="<?php echo $apellido; ?>"/>                            
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <label class="col-lg-2" >DNI: </label>
                                    <input type="text"    style="border-style:hidden;background: #D9EDF7;"  id="txtdni"  name="txtdni"  readonly="" value="<?php echo $dni; ?>"/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <label class="col-lg-2">Teléfono: </label>
                                    <input type="text"    style="border-style:hidden;background: #D9EDF7;"  id="txttelefono"  name="txttelefono"   value="<?php echo $telefono; ?>"/>
                                    <input type="hidden" id="txttelefonoedit"  name="txttelefonoedit"  />
                                    <input type="hidden" id="txttelefonocont"  name="txttelefonocont"  />
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <label class="col-lg-2">Correo: </label>
                                    <input type="text"    style="border-style:hidden;background: #D9EDF7; width: 50%;"  id="txtcorreo"  name="txtcorreo"   value="<?php echo $correo; ?>"/>
                                    <input type="hidden" id="txtcorreoedit"  name="txtcorreoedit"  />
                                    <input type="hidden" id="txtcorreocont"  name="txtcorreocont"  />
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <label class="col-lg-2">Dirección: </label>
                                    <input type="text"    style="border-style:hidden;background: #D9EDF7; width: 50%;"  id="txtdireccion"  name="txtdireccion"   value="<?php echo $direccion; ?>"/>
                                    <input type="hidden" id="txtdireccionedit"  name="txtdireccionedit"  />
                                    <input type="hidden" id="txtdireccioncont"  name="txtdireccioncont"  />
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <label class="col-lg-2">Área:</label>
                                    <input type="text"    style="border-style:hidden;background: #D9EDF7;"  id="txtarea"  name="txtarea"  readonly="" value="<?php echo $area; ?>"/>

                                </div>
                            </div>
                            <input type="hidden" id="txtcontrol"  name="txtcontrol" value="0" />

                            <div class="row">
                                <div class="form-group">
                                    <button type="button"  style="float: right" class="btn btn-success" aria-hidden="true" id="btnperfil" name="btnperfil" onclick="GrabarPerfil()">Grabar los datos</button>

                                </div>
                            </div>
                        </div>
                        </form>
                    </div>             
                </div><!-- /.box-header -->  
            </div>
        </div>
        <?php
            include 'footer.php';
        ?>
     <!-- jQuery 2.1.3 -->
    <script src="../util/jquery/jquery.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="../util/bootstrap/js/bootstrap.js" type="text/javascript"></script>
    <script src="js/perfil.js" type="text/javascript"></script>
    <script src="js/util.js" type="text/javascript"></script>
    <!-- SWEET JS -->
    <script type="text/javascript" src="../util/sweet/sweetalert-dev.js"></script>
  </body>

</html>