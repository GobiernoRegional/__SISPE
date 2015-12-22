<?php
	$variable           = $_POST["txtvariable"];
    $sector             = $_POST["txtsector"];
    $objetivo           = $_POST["txtobjetivo"];
       
	require_once '../negocio/VariableRegional.class.php';
	$objVariableRegional = new VariableRegional();
        
	$objVariableRegional->setNombre($variable);
    $objVariableRegional->setSector($sector);
    $objVariableRegional->setObjetivo($objetivo);
        
	$resultado=$objVariableRegional->agregar();
	echo json_encode($resultado);
?>