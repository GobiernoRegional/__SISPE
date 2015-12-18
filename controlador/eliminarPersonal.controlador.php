<?php
	$codigo=$_POST["codigo"];
	require_once '../negocio/personal.class.php';
	$objPersonal = new Personal();
	$objPersonal->setCodpersona($codigo);
	$resultado=$objPersonal->eliminar();
	echo json_encode($resultado);
?>