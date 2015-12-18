<?php
	require_once '../negocio/personal.class.php';
	$objPersonal = new Personal();
	$resultado=$objPersonal->listar();
	echo json_encode($resultado);
?>