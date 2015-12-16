<?php //

    require_once '../negocio/Sesion.class.php';
    require_once '../util/funciones/Funciones.class.php';
//    
    $nomTabla       =$_POST["p_nom_tabla"];
    $usuario       =$_POST["p_cod_usuario"];
    
//    $nomTabla       ="institucion";
//    $usuario       ="UPER000001";
    
    $cont=0;
    $objpermiso = new Sesion();;
    try {
        $registros = 
                $objpermiso->obtenerPermisos($usuario,$nomTabla);
//                echo $registros["upe_Permiso"];
                 $cont++;
                
                for ($i = 0; $i < $cont; $i++) {
                    $array [$i ] = array($nomTabla => $registros["upe_Permiso"]);
//                    print_r($array [$i ] );
       
                    echo json_encode($array [$i ] );
                   
                }
//                 echo($array[0]);
    } catch (Exception $exc) {
        Funciones::mensaje($exc->getMessage(), "e");
    }
    
?>