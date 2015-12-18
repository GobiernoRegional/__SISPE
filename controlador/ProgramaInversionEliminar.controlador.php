<?php
	$codigo=$_POST["codigo"];
        require_once '../negocio/ProgramaInversion.class.php';
	$objProInversion = new ProgramaInversion();
	$objProInversion->setCodigo($codigo);
	$resultado=$objProInversion->eliminar();
	echo json_encode($resultado);
?>