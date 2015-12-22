<?php
	$variable           = $_POST["txtnombreedit"];
        $sector             = $_POST["txtsectoredit"];
        $objetivo           = $_POST["txtobjetivoedit"];
       
	require_once '../negocio/VariableRegional.class.php';
	$objVariableRegional = new VariableRegional();
        
	$objVariableRegional->setNombre($variable);
        $objVariableRegional->setSector($sector);
        $objVariableRegional->setObjetivo($objetivo);
        
	$resultado=$objVariableRegional->agregar();
	echo json_encode($resultado);
?>