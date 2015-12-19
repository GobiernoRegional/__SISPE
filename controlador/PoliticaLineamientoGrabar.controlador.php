<?php
	$lineamiento      =$_POST["txtnombre"];
    $descripcion    =$_POST["txtdescripcion"];
	$eje            = $_POST["txteje"];
        
	require_once '../negocio/PoliticaLineamiento.class.php';
        
	$objPoliticaLineamiento = new PoliticaLineamiento();
	$objPoliticaLineamiento->setNombre($lineamiento);
    $objPoliticaLineamiento->setDescripcion($descripcion);
    $objPoliticaLineamiento->setEje($eje);
        
	$resultado=$objPoliticaLineamiento->agregar();
	echo json_encode($resultado);
?>
