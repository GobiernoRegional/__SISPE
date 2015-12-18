<?php
	$codigo=$_POST["txtcodigoedit"];
	$nestudio = $_POST["txtnombreedit"];
        $estrategia = $_POST["txtestrategiaedit"];
        $ubicacion = $_POST["txtubicacionedit"];
        
        require_once '../negocio/ProgramaInversion.class.php';
        
	$objProInversion = new ProgramaInversion();
	$objProInversion->setCodigo($codigo);
	$objProInversion->setNestudio($nestudio);
        $objProInversion->setPestrategia($estrategia);
        $objProInversion->setUbicacion($ubicacion);
        
	$resultado=$objProInversion->editar();
	echo json_encode($resultado);
?>