<?php
	$codigo             = $_POST["txtcodigoedit"];
	$variable           = $_POST["txtnombreedit"];
        $sector             = $_POST["txtsectoredit"];
        $objetivo           = $_POST["txtobjetivoedit"];
        
        require_once '../negocio/VariableRegional.class.php';
	$objVariableRegional = new VariableRegional();
	$objVariableRegional->setCodigo($codigo);
	$objVariableRegional->setNombre($variable);
        $objVariableRegional->setSector($sector);
        $objVariableRegional->setObjetivo($objetivo);
	$resultado=$objVariableRegional->editar();
	echo json_encode($resultado);
?>