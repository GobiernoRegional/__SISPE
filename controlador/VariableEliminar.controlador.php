<?php
	$codigo=$_POST["codigo"];
        require_once '../negocio/Variable.class.php';
	$objVariable = new Variable();
	$objVariable->setCodigo($codigo);
	$resultado=$objVariable->eliminar();
	echo json_encode($resultado);
?>