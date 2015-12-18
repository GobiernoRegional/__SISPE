<?php
	$eje=$_POST["txtnombre"];
	$subcapitulo = "SUB004";
        
	require_once '../negocio/EjeEstrategico.class.php';
        
	$objEje = new EjeEstrategico();
	$objEje->setNombre($eje);
    $objEje->setSubcapitulo($subcapitulo);
	$resultado=$objEje->agregar();
	echo json_encode($resultado);
?>