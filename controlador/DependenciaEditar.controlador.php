<?php
	$codigo=$_POST["txtcodigoedit"];
	$dependencia = $_POST["txtnombreedit"];
    $telefono=$_POST["txttelefonoedit"];
        
	require_once '../negocio/dependencia.class.php';
	$objDependencia = new Dependencia();
	$objDependencia->setCodigo($codigo);
	$objDependencia->setDescripcion($dependencia);
    $objDependencia->setTelefono($telefono);
	$resultado=$objDependencia->editar();
	echo json_encode($resultado);
?>