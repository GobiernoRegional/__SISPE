<?php
	$codigo             = $_POST["txtcodigoedit"];
	$sector             = $_POST["txtnombreedit"];
        $objetivo           = $_POST["txtsectoredit"];
        $eje                = $_POST["txtjustificacionedit"];
        $politica           = $_POST["txtunidadedit"];
        $estrategia         = $_POST["txtrepon_gestionedit"];
        
        require_once '../negocio/TipoSector.class.php';
	$objTipoSector = new TipoSector();
	$objTipoSector->setCodigo($codigo);
	$objTipoSector->setNombre($sector);
        $objTipoSector->setObjetivo($objetivo);
        $objTipoSector->setEje($eje);
        $objTipoSector->setPolitica($politica);
        $objTipoSector->setEstrategia($estrategia);
	$resultado=$objTipoSector->editar();
	echo json_encode($resultado);
?>