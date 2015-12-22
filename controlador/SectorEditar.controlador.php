<?php
	$codigo             = $_POST["txtcodigo"];
        $sector             = $_POST["txtsectored"];
        
    require_once '../negocio/TipoSector.class.php';
	$objTipoSector = new TipoSector();
	$objTipoSector->setCodigo($codigo);
	$objTipoSector->setNombre($sector);
        
	$resultado=$objTipoSector->editar();
	echo json_encode($resultado);
?>