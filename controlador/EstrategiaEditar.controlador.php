<?php
	$codigo=$_POST["txtcodigo"];
	$estrategia = $_POST["txtestrategiaedit"];
    $politica = $_POST["txtpoliticaedit"];
        
    require_once '../negocio/Estrategia.class.php';
	$objEstrategia = new Estrategia();
	$objEstrategia->setCodigo($codigo);
	$objEstrategia->setDescripcion($estrategia);
    $objEstrategia->setPolitica($politica);
        
	$resultado=$objEstrategia->editar();
	echo json_encode($resultado);
?>