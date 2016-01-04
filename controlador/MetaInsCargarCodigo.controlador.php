<?php
	$codigo=$_POST["codigo"];
	require_once '../negocio/MetaInstitucional.class.php';
	$objMetaIns = new MetaInstitucional();
	$resultado=$objMetaIns->leerDatos($codigo);
	echo json_encode($resultado);
?>
