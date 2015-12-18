<?php
	$dependencia = $_POST["txtnombre"];
	$telefono = $_POST["txttelefono"];
	require_once '../negocio/dependencia.class.php';
	$objDependencia = new Dependencia();
	$objDependencia->setCodigo($codigo);
	$objDependencia->setDescripcion($dependencia);
	$objDependencia->setTelefono($telefono);
        $objDependencia->setDistrito("distrito");
	$resultado=$objDependencia->agregar();
//        print_r($resultado);
	echo json_encode($resultado);
?>