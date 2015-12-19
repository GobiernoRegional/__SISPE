<?php
	$prioridad=$_POST["txtprioridades"];
	$eje = $_POST["txteje"];
	require_once '../negocio/Prioridad.class.php';
        
	$objPrioridad = new Prioridad();
	$objPrioridad->setNombre($prioridad);
    $objPrioridad->setEje($eje);
        
	$resultado=$objPrioridad->agregar();
	echo json_encode($resultado);
?>
