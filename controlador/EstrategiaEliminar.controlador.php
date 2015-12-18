<?php
	$codigo=$_POST["codigo"];
        require_once '../negocio/Estrategia.class.php';
	$objEstrategia = new Estrategia();
	$objEstrategia->setCodigo($codigo);
	$resultado=$objEstrategia->eliminar();
	echo json_encode($resultado);
?>