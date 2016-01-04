<?php
	$codigo=$_POST["codigo"];
        require_once '../negocio/AccionInstitucional.php';
	$objAccionIns = new AccionInstitucional();
	$objAccionIns->setCodigo($codigo);
	$resultado=$objAccionIns->eliminar();
	echo json_encode($resultado);
?>