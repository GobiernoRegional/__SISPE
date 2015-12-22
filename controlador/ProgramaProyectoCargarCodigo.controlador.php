<?php
	$codigo=$_POST["codigo"];
	require_once '../negocio/ProgramaProyecto.class.php';
	$objProgramaProyecto = new ProgramaProyecto();
	$resultado=$objProgramaProyecto->leerDatos($codigo);
	echo json_encode($resultado);	
?>