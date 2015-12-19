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
                        <div class="col-lg-7">
                            <div class="form-group">
                                <label>Nombres: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>   
                                <input type="text"  style="border-style:hidden" id="txtnombres"  name="txtnombres"  readonly=""/>
                            </div>
                            <div class="form-group">
                                <label>Apellidos: &nbsp;&nbsp;&nbsp;&nbsp;</label> 
                                <input type="text"   style="border-style:hidden" id="txtapellidos"  name="txtapellidos" readonly=""/>
                            </div>
                            <div class="form-group">
                                <label>DNI: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                <input type="text"   style="border-style:hidden" id="txtdni"  name="txtdni"  readonly=""/>
                            </div>
                            <div class="form-group">
                                <label>Teléfono: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                <input type="text"   style="border-style:hidden" id="txttelefono"  name="txttelefono"  readonly=""/>
                            </div>
                            <div class="form-group">
                                <label>Correo: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                <input type="text"   style="border-style:hidden; width: 50% " id="txtcorreo"  name="txtcorreo"  readonly=""/>
                            </div>
                            <div class="form-group">
                                <label>Área: &nbsp;&nbsp;</label>
                                <input type="text"  style="border-style:hidden; width: 50% " id="txtinstitucion"  name="txtinstitucion"  readonly=""/>
                            </div>
                        </div>
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
  </body>

</html>