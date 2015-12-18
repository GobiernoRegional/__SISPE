<?php
	$codigo=$_POST["txtcodigoedit"];
	$ano = $_POST["txtanoedit"];
        $ind_codigo = $_POST["txtind_codigoedit"];
        $valor = $_POST["txtvaloredit"];
        require_once '../negocio/Meta.class.php';
	$objMeta = new Meta();
	$objMeta->setCodigo($codigo);
	$objMeta->setInd_codigo($ind_codigo);
        $objMeta->setValor($valor);
	$resultado=$objMeta->editar();
	echo json_encode($resultado);
?>
