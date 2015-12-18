<?php
	$pinversion=$_POST["txtnombre"];
	$nestudio = $_POST["txtnombre"];
        $estrategia = $_POST["txtestrategia"];
        $ubicacion = $_POST["txtubicacion"];
        
	require_once '../negocio/ProgramaInversion.class.php';
	$objProInversion = new ProgramaInversion();
	$objProInversion->setCodigo($codigo);
	$objProInversion->setNestudio($nestudio);
        $objProInversion->setPestrategia($estrategia);
        $objProInversion->setUbicacion($ubicacion);
        
	$resultado=$objProInversion->agregar();
	echo json_encode($resultado);
?>