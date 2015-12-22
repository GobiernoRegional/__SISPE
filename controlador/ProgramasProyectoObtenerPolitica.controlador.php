<?php
	require_once '../negocio/ProgramaProyecto.class.php';
	$objProgramaProyecto = new ProgramaProyecto();
	$resultado=$objProgramaProyecto->obtenerPolitica();
	echo json_encode($resultado);
?>