<?php
	$codigo=$_POST["codigo"];
        require_once '../negocio/MetaInstitucional.class.php';
	$objMetaIns = new MetaInstitucional();
	$objMetaIns->setCodigo($codigo);
	$resultado=$objMetaIns->eliminar();
	echo json_encode($resultado);
?>
