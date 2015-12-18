<?php
	$codigo=$_POST["codigo"];
        require_once '../negocio/Inversion.class.php';
	$objInversion = new Inversion();
	$objInversion->setCodigo($codigo);
	$resultado=$objInversion->eliminar();
	echo json_encode($resultado);
?>