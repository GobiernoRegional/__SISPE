<?php
	$año=$_POST["txtaño"];
	$ind_codigo = $_POST["txtind_codigo"];
        $valor = $_POST["txtvalor"];
	require_once '../negocio/Meta.class.php';
	$objMeta = new Meta();
	$objMeta->setAño($año);
        $objMeta->setInd_codigo($ind_codigo);
        $objMeta->setValor($valor);
	$resultado=$objMeta->agregar();
	echo json_encode($resultado);
?>
