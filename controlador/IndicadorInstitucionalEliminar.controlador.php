<?php
	$codigo=$_POST["codigo"];
        require_once '../negocio/IndicadorInstitucional.php';
	$objIndicadorInst = new IndicadorInstitucional();
	$objIndicadorInst->setCodigo($codigo);
	$resultado=$objIndicadorInst->eliminar();
	echo json_encode($resultado);
?>