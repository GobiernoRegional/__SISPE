<?php
	$accion = $_POST["txtaccion"];
        $indicador = $_POST["txtindicador"];
    require_once '../negocio/AccionInstitucional.php';
    
	$objAccionIns = new AccionInstitucional();
	$objAccionIns->setCodigo($codigo);
	$objAccionIns->setDescripcion($accion);
        $objAccionIns->setIndicador($indicador);
        
	$resultado=$objAccionIns->agregar();
	echo json_encode($resultado);
?>