<?php
	$codigo         =$_POST["txtcodigoedit"];
	$lineamiento      = $_POST["txtnombreedit"];
    $descripcion    =$_POST["txtdescripcionedit"];
    $eje            = $_POST["txtejeedit"];
        
	require_once '../negocio/PoliticaLineamiento.class.php';
        
	$objPoliticaLineamiento = new PoliticaLineamiento();
	$objPoliticaLineamiento->setCodigo($codigo);
	$objPoliticaLineamiento->setNombre($lineamiento);
    $objPoliticaLineamiento->setDescripcion($descripcion);
    $objPoliticaLineamiento->setEje($eje);
        
	$resultado=$objPoliticaLineamiento->editar();
	echo json_encode($resultado);
?>