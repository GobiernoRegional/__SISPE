<?php
	$eje=$_POST["txtnombre"];
	$subcapitulo = $_POST["txtsubcapitulo"];
        
	require_once '../negocio/EjeEstrategico.class.php';
        
	$objEje = new EjeEstrategico();
	$objEje->setNombre($eje);
        $objEje->setSubcapitulo($subcapitulo);
	$resultado=$objEje->agregar();
	echo json_encode($resultado);
?>