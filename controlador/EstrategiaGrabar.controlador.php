<?php
	$estrategia = $_POST["txtestrategia"];
    $politica = $_POST["txtpolitica"];
        
    require_once '../negocio/Estrategia.class.php';
	$objEstrategia = new Estrategia();
	$objEstrategia->setDescripcion($estrategia);
    $objEstrategia->setPolitica($politica);
        
	$resultado=$objEstrategia->agregar();
	echo json_encode($resultado);
?>