<?php
	$codigo=$_POST["codigo"];
        require_once '../negocio/ProgramaEstrategia.class.php';
	$objProEstrategia = new ProgramaEstrategia();
	$objProEstrategia->setCodigo($codigo);
        
	$resultado=$objProEstrategia->eliminar();
	echo json_encode($resultado);
?>