<?php
	$codigo=$_POST["codigo"];
	require_once '../negocio/PoliticaLineamiento.class.php';
	
        $objPoliticaLineamiento = new PoliticaLineamiento();
	$objPoliticaLineamiento->setCodigo($codigo);
	$resultado=$objPoliticaLineamiento->eliminar();
	echo json_encode($resultado);
?>