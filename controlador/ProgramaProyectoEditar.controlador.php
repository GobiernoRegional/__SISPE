<?php
	$codigo=$_POST["txtcodigo"];
	$programaproyecto = $_POST["txtprogramaedit"];
    $politica = $_POST["txtpoliticaedit"];
        
    require_once '../negocio/ProgramaProyecto.class.php';
	$objProgramaProyecto = new ProgramaProyecto();
	$objProgramaProyecto->setCodigo($codigo);
	$objProgramaProyecto->setDescripcion($programaproyecto);
    $objProgramaProyecto->setPolitica($politica);
        
	$resultado=$objProgramaProyecto->editar();
	echo json_encode($resultado);
?>