<?php
	require_once '../negocio/InversionAno.class.php';
	$objInversionAno = new InversionAno();
	$resultado=$objInversionAno->obtenerProgramaInversion();
	echo json_encode($resultado);
?>
