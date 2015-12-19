<?php
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
                                <label class="col-lg-3">Nombres:</label>   
                                <input type="text" class="col-lg-5"  style="border-style:hidden" id="txtnomb"  name="txtnomb" value="<?php echo $nombreUsuario;?>" readonly=""/>
                            </div><br>
                            <div class="form-group">
                                <label class="col-lg-3">Usuario: </label> 
                                <input type="text" class="col-lg-5"  style="border-style:hidden" id="txtusuario"  name="txtusuario" value="<?php echo $cuenta;?>"  readonly=""/>
                            </div><br>
                            <div class="form-group">
                                <label class="col-lg-3">Clave Antigua: </label>
                                <input type="password"  class="col-lg-4" style="border-style: dotted" id="txtclaveantigua"  name="txtclaveantigua"  required=""/>
                            </div><br>
                            <div class="form-group">
                                <label class="col-lg-3">Clave Nueva:</label>
                                <input type="password" class="col-lg-4"  style="border-style: dotted" id="txtclavenueva"  name="txtclavenueva"   required=""/>
                            </div><br>
                            <div class="form-group">
                                <label class="col-lg-3">Repita Clave: </label>
                                <input type="password"  class="col-lg-4"  style="border-style: dotted" id="txtclaverepetida"  name="txtclaverepetida"   required=""/>
                            </div><br>
                            <div class="form-group">
                                <input type="hidden"   style="border-style: dotted" id="txtclav"  name="txtclav" value="<?php echo $clave;?>"  required=""/>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-lg-3">&nbsp;</label>
                                <br>
                                <button type="submit" class="btn btn-success" id="btnagregar" name="btnagregar">Guardar Cambios</button>
                                <label></label>
                                <a href="principal.php"><button  type="button" class="btn btn-danger"  id="btncancelar">Cancelar.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button></a>
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
