<?php
	$codigo=$_POST["txtcodigo"];
	$accion = $_POST["txtaccionedit"];
        $indicador = $_POST["txtindicadoredit"];
    require_once '../negocio/AccionInstitucional.php';
    
	$objAccionIns = new AccionInstitucional();
	$objAccionIns->setCodigo($codigo);
	$objAccionIns->setDescripcion($accion);
        $objAccionIns->setIndicador($indicador);
        
	$resultado=$objAccionIns->editar();
	echo json_encode($resultado);
?>