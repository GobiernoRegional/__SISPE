<?php
	$codigo=$_POST["codigo"];
        require_once '../negocio/Meta.class.php';
	$objAccion = new Accion();
	$objAccion->setCodigo($codigo);
	$resultado=$objAccion->eliminar();
	echo json_encode($resultado);
?>
