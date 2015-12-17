<?php
	$codigo=$_POST["txtcodigoedit"];
	$objnacional = $_POST["txtnombreedit"];
        $descripcion = $_POST["txtdescripcionedit"];
        $eje = $_POST["txtejeedit"];
        
	require_once '../negocio/ObjetivoNacional.class.php';
        
	$objObjNacional = new ObjNacional();
	$objObjNacional->setCodigo($codigo);
	$objObjNacional->setNombre($objnacional);
        $objObjNacional->setDescripcion($descripcion);
        $objObjNacional->setEje($eje);
        
	$resultado=$objObjNacional->editar();
        
	echo json_encode($resultado);
?>