<?php
	$codigo=$_POST["txtcodigoedit"];
	$prioridad = $_POST["txtprioridadedit"];
        $eje = $_POST["txtejeedit"];
        
	require_once '../negocio/Prioridad.class.php';
        
	$objPrioridad = new Prioridad();
	$objPrioridad->setCodigo($codigo);
	$objPrioridad->setNombre($prioridad);
        $objPrioridad->setEje($eje);
        
	$resultado=$objPrioridad->editar();
	echo json_encode($resultado);
?>