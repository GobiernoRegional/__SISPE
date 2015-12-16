<?php
require_once '../negocio/usuario.class.php';

//$usuario="practicante";
//$claveveAntigua="123456";
//$claveNueva="1234";
$usuario=$_POST["p_usuario"];
$claveveAntigua=$_POST["p_clave_antigua"];
$claveNueva=$_POST["p_clave_nueva"];

$objUsuario = new Usuario();

$objUsuario->setUsuario($usuario);
$objUsuario->setClave_antigua($claveveAntigua);
$objUsuario->setClave_nueva($claveNueva);

if ($operacion=="llenarCombox"){ 
     $tabla = $_POST["p_tabla"];        
        if($tabla=="personal"){
            $registros = $objUsuario->obtenerPersonal();
        }
}

try{
    if($operacion== "llenarCombox"){
        if($tablas=="personal"){       
            for ($i=0; $i<count($registros); $i++) {
                echo '<option value="'.$registros[$i]["per_codigo"].'">'.$registros[$i]["per_apellido"].'</option>';            
            }
        }
    }
} catch (Exception $ex) {

}

try {
    
//    $resu=$objUsuario->ModificarClaveUsuario();
//    print_r($resu);
    if ($objUsuario->ModificarClaveUsuario()==true){
            echo "Se Cambio la Contraseña Satisfactoriamente";
        }
     
} catch (Exception $ex) {
    header("HTTP/1.1 500");
    echo $ex->getMessage();
}





