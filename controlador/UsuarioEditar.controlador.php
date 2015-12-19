<?php
	$usuario    =   $_POST["txtusuario"];
	$claveAntigua  =   $_POST["txtclave_antigua"];
        $claveNueva     =   $_POST["txtclave_nueva"];
        
	require_once '../negocio/usuario.class.php';
	
        $objUsuario = new Usuario();
	$objUsuario->setUsuario($usuario);
	$objUsuario->setClave_antigua($clave_antigua);
        $objUsuario->setClave_nueva($clave_nueva);
        $objUsuario->setRepeti_clave($clave_nueva);
        
	$resultado=$objUsuario->ModificarClaveUsuario();
	echo json_encode($resultado);
?>