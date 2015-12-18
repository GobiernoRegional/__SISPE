<?php
	$codigo=$_POST["codigo"];
        require_once '../negocio/Indicador.class.php';
	$objIndicador = new Indicador();
	$objIndicador->setCodigo($codigo);
	$resultado=$objIndicador->eliminar();
	echo json_encode($resultado);
?>