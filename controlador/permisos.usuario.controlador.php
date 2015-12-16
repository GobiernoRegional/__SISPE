<?php //

    require_once '../negocio/Sesion.class.php';
    require_once '../util/funciones/Funciones.class.php';
//    $cosdu="LTERRONES";
    $nomusuario       =$_POST["p_nom_usuario"];
    $objpermiso = new Sesion();
    $objpermiso->setUsuario($nomusuario);
    try {
        $registros = 
                $objpermiso->obtenerCodPermisos();
        
                echo $registros["usu_upe_Codigo"];

    } catch (Exception $exc) {
        Funciones::mensaje($exc->getMessage(), "e");
    }    
?>