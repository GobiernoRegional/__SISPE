<?php
	$codigo=$_POST["codigo"];
	require_once '../negocio/Indicador.class.php';
	$objIndicador = new Indicador();
	$resultado=$objIndicador->leerDatos($codigo);
	echo json_encode($resultado);
?>