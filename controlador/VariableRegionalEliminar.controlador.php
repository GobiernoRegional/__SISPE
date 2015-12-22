<?php
	$codigo=$_POST["codigo"];
        require_once '../negocio/VariableRegional.class.php';
	$objVariableRegional = new VariableRegional();
	$objVariableRegional->setCodigo($codigo);
	$resultado=$objVariableRegional->eliminar();
	echo json_encode($resultado);
?>