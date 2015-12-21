<?php
	$politica = $_POST["txtnombre"];
    $sector = $_POST["txtsector"];
        
	require_once '../negocio/Politica.class.php';
	$objPolitica = new PoliticaR();
	$objPolitica->setDescripcion($politica);
    $objPolitica->setSector($sector);
        
	$resultado=$objPolitica->agregar();
	echo json_encode($resultado);
?>