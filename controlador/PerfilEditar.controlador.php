<?php
	$dni        =   $_POST["txtdni"];
	$direccion  =   $_POST["txtdireccion"];
        $correo     =   $_POST["txtcorreo"];
	$telefono   =   $_POST["txttelefono"];
        
	require_once '../negocio/Perfil.class.php';
	$objPerfil = new Perfil();
	$objPerfil->setDni($dni);
	$objPerfil->setDirecion($direccion);
        $objPerfil->setNom_Correo($correo);
        $objPerfil->setNumeroTelefono($telefono);
	$resultado=$objPerfil->editar();
	echo json_encode($resultado);
?>