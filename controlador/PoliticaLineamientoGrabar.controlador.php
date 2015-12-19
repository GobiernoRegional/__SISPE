<?php
	$prioridad      =$_POST["txtnombre"];
        $descripcion    =$_POST["txtdescripcion"];
	$eje            = $_POST["txteje"];
        
	require_once '../negocio/PoliticaLineamiento.class.php';
        
	$objPoliticaLineamiento = new PoliticaLineamiento();
	$objPoliticaLineamiento->setNombre($prioridad);
        $objPoliticaLineamiento->setDescripcion($descripcion);
        $objPoliticaLineamiento->setEje($eje);
        
	$resultado=$objPoliticaLineamiento->agregar();
	echo json_encode($resultado);
?>
