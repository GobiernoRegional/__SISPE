<?php
	$estrategia=$_POST["txtnombre"];
	
	require_once '../negocio/Estrategia.class.php';
	$objEstrategia = new Estrategia();
	$objEstrategia->setDescripcion($estrategia);
        
	$resultado=$objEstrategia->agregar();
	echo json_encode($resultado);
?>