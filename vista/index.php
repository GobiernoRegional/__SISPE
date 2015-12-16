<?php
    if (isset($_COOKIE["emailusuario"])){
        $email = $_COOKIE["emailusuario"];
    }else{
        $email = "";
    }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Sistema De Plan Estratégico</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="../util/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="../util/lte/css/font-awesome.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="../util/lte/css/AdminLTE.css" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="../util/lte/plugins/iCheck/square/blue.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="../util/logins/css/main.css" />
    <link rel="stylesheet" href="../util/lte/css/estilos.css"
    </head>
    <body>
        <header>
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col col-sm-6 col-md-8 col-lg-8">
                        <h1 class="texto tamtex1"> &nbsp;S I S P E</h1>
                        <h4 class="texto tamtex2">Sistema de Plan Estratégico</h4>
                    </div>
                    <div class="hidden-xs col-sm-7 col-md-4 col-lg-4">
                        <a href="https://www.facebook.com/gobiernoregional.lambayeque/?fref=ts" target="new"><img src="../util/logins/img/facebook.png" align="center" alt="" width="40" height="40"></a>
                        <a href="https://twitter.com/search?q=gobierno%20regional%20lambayeque&src=typd" target="new"><img src="../util/logins/img/twitter.png" align="center" alt="" width="40" height="40"></a>
                        <a href="http://www.regionlambayeque.gob.pe/" target="new"><img src="../util/logins/img/grl2.png" alt="" width="120" height="120"></a>
                    </div>
                </div>
            </div>
        </header>
        <div class="login-box">
            <div class="Titulo">
            </div>
            <div>
                
                <form action="../controlador/sesion.controlador.php" method="POST">
                    <h2 class="texto2 text-aqua">INICIO DE SESIÓN</h2>
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" placeholder="Cuenta Usuario" autofocus="" id="txtusuario" name="txtusuario" required="" value="<?php echo $email?>"/>
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" class="form-control" placeholder="Contraseña" name="txtclave"/>
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div class="row">
                    <div class="col-xs-8">    
                        <div class="checkbox icheck">
                            <label color="white">
                              <input type="checkbox" name="chkrecordar" value="S"/> Recordar Datos
                            </label>
                      </div>                        
                    </div><!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-danger btn-block btn-flat" onclick="valor()">Ingresar</button>
                    </div><!-- /.col --><br>           
                    </div><br>
                    <div class="row">
                        <div class="col-lg-8">
                            <p><a href="#" class="recuperar">Recuperar Contraseña</a></p>
                        </div>
                    </div>
                </form>
                
            </div><!--/.login-box-body -->
        </div><!--/.login-box -->     

    <script src="../util/jquery/jquery.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="../util/bootstrap/js/bootstrap.js" type="text/javascript"></script>
    <!-- iCheck -->
    <script src="../util/lte/plugins/iCheck/icheck.js" type="text/javascript"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
  </body>
</html>