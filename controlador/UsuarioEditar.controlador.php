<?php
	$usuario    =   $_POST["txtusuario"];
	$claveAntigua  =   $_POST["txtclaveantigua"];
        $claveNueva     =   $_POST["txtclavenueva"];
//$usuario    =   "12";
//	$claveAntigua  =   "administrador";
//        $claveNueva     =   "1245";
                
	require_once '../negocio/usuario.class.php';
	
        $objUsuario = new Usuario();
	$objUsuario->setUsuario($usuario);
	$objUsuario->setClave_antigua($claveAntigua);
        $objUsuario->setClave_nueva($claveNueva);
        
	$resultado=$objUsuario->ModificarClaveUsuario();
	echo json_encode($resultado);
?>