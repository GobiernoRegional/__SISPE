<?php
	$codigo=$_POST["txtcodigoedit"];
	$nombre = $_POST["txtnombreedit"];
    $subcapitulo = "SUB004";
        
	require_once '../negocio/EjeEstrategico.class.php';
        
	$objEje = new EjeEstrategico();
	$objEje->setCodigo($codigo);
	$objEje->setNombre($nombre);
    $objEje->setSubcapitulo($subcapitulo);
	$resultado=$objEje->editar();
	echo json_encode($resultado);
?>