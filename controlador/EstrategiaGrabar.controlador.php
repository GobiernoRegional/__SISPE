<?php
	$estrategia = $_POST["txtnombre"];
        $politica = $_POST["txtpolitica"];
        
        require_once '../negocio/Estrategia.class.php';
	$objEstrategia = new Estrategia();
	$objEstrategia->setCodigo($codigo);
	$objEstrategia->setDescripcion($estrategia);
        $objEstrategia->setPolitica($politica);
        
	$resultado=$objEstrategia->agregar();
	echo json_encode($resultado);
?>