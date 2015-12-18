<?php
	$ano                = $_POST["txtanoedit"];
        $sector             = $_POST["txtsectoredit"];
        $monto              = $_POST["txtmontoedit"];
        $total              = $_POST["txttotaledit"];
        $porcentaje         = $_POST["txtreporcentajeedit"];
        
	require_once '../negocio/Inversion.class.php';
	$objInversion = new Inversion();
        
        $objInversion->setAno($ano);
        $objInversion->setSector($sector);
        $objInversion->setMonto($monto);
        $objInversion->setTotal($total);
        $objInversion->setPorcentaje($porcentaje);
        
	$resultado=$objInversion->agregar();
	echo json_encode($resultado);
?>