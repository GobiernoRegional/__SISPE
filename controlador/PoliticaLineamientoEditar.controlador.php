<?php
	$codigo         =$_POST["txtcodigoedit"];
	$prioridad      = $_POST["txtprioridadedit"];
        $descripcion    =$_POST["txtdescripcion"];
        $eje            = $_POST["txtejeedit"];
        
	require_once '../negocio/PoliticaLineamiento.class.php';
        
	$objPoliticaLineamiento = new PoliticaLineamiento();
	$objPoliticaLineamiento->setCodigo($codigo);
	$objPoliticaLineamiento->setNombre($prioridad);
        $objPoliticaLineamiento->setDescripcion($descripcion);
        $objPoliticaLineamiento->setEje($eje);
        
	$resultado=$objPoliticaLineamiento->editar();
	echo json_encode($resultado);
?>