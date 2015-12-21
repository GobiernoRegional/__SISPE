<?php
	$codigo             = $_POST["txtcodigoedit"];
        $sector             = $_POST["txtnombreedit"];
        
        require_once '../negocio/TipoSector.class.php';
	$objTipoSector = new TipoSector();
	$objTipoSector->setCodigo($codigo);
	$objTipoSector->setNombre($sector);
        
	$resultado=$objTipoSector->editar();
	echo json_encode($resultado);
?>