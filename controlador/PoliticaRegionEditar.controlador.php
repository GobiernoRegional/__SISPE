<?php
	$codigo=$_POST["txtcodigo"];
	$politica = $_POST["txtnombreedit"];
    $sector = $_POST["txtsectoredit"];
        
	require_once '../negocio/Politica.class.php';
	$objPolitica = new PoliticaR();
	$objPolitica->setCodigo($codigo);
	$objPolitica->setDescripcion($politica);
    $objPolitica->setSector($sector);
        
	$resultado=$objPolitica->editar();
	echo json_encode($resultado);
?>