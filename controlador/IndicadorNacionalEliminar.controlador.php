<?php
	$codigo=$_POST["codigo"];
        require_once '../negocio/IndicadorNacional.class.php';
	$objIndicadorNacional = new IndicadorNacional();
	$objIndicadorNacional->setCodigo($codigo);
	$resultado=$objIndicadorNacional->eliminar();
	echo json_encode($resultado);
?>