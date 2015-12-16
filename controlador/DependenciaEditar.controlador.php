<?php
	$codigo=$_POST["txtcodigoedit"];
	$dependencia = $_POST["txtdependenciaedit"];
        $telefono=$_POST["txttelefono"];
        
	require_once '../negocio/dependencia.class.php';
	$objDependencia = new Dependencia();
	$objDependencia->setCodigo($codigo);
	$objDependencia->setDescripcion($dependencia);
        $objDependencia->setTelefono($telefono);
	$resultado=$objArea->editar();
	echo json_encode($resultado);
?>