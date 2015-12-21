<?php
	$sector = $_POST["txtsector"];
        
	require_once '../negocio/TipoSector.class.php';
	$objTipoSector = new TipoSector();
	$objTipoSector->setNombre($sector);
	$resultado=$objTipoSector->agregar();
	echo json_encode($resultado);
?>