<?php
	$codigo=$_POST["codigo"];
        require_once '../negocio/TipoSector.class.php';
	$objTipoSector = new TipoSector();
	$objTipoSector->setCodigo($codigo);
	$resultado=$objTipoSector->eliminar();
	echo json_encode($resultado);
?>