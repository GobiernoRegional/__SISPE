<?php //

    require_once '../negocio/perfil.class.php';
    require_once '../util/funciones/Funciones.class.php';
   
    $usuario       =$_POST["p_nom_usuario"];   
    $objpefil = new perfil();
    try {
        $registros = 
                $objpefil->obetenerPerfil($usuario);
                    echo json_encode($registros);

    } catch (Exception $exc) {
        Funciones::mensaje($exc->getMessage(), "e");
    }
    
?>