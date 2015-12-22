<?php
	$codigo=$_POST["codigo"];
        require_once '../negocio/ProgramaProyecto.class.php';
	$objProgramaProyecto = new ProgramaProyecto();
	$objProgramaProyecto->setCodigo($codigo);
	$resultado=$objProgramaProyecto->eliminar();
	echo json_encode($resultado);
?>