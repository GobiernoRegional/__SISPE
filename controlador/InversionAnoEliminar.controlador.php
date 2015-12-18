<?php
	$codigo=$_POST["codigo"];
        require_once '../negocio/InversionAno.class.php';
	$objInversionAno = new InversionAno();
	$objInversionAno->setCodigo($codigo);
	$resultado=$objInversionAno->eliminar();
	echo json_encode($resultado);
?>