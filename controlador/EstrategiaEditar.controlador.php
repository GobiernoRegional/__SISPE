<?php
	$codigo=$_POST["txtcodigoedit"];
	$estrategia = $_POST["txtnombreedit"];
        
        require_once '../negocio/Estrategia.class.php';
	$objEstrategia = new Estrategia();
	$objEstrategia->setCodigo($codigo);
	$objEstrategia->setDescripcion($estrategia);
        
	$resultado=$objEstrategia->editar();
	echo json_encode($resultado);
?>