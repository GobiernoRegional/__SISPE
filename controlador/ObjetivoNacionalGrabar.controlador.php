<?php
	$objetivo=$_POST["txtobjetivo"];
	$descripcion = $_POST["txtdescripcion"];
    $eje = $_POST["txteje"];
        
	require_once '../negocio/ObjetivoNacional.class.php';
        
	$objObjNacional = new ObjNacional();
	$objObjNacional->setNombre($objetivo);
    $objObjNacional->setDescripcion($descripcion);
    $objObjNacional->setEje($eje);
        
	$resultado=$objObjNacional->agregar();
	echo json_encode($resultado);
?>