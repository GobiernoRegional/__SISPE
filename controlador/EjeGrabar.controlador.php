<?php
	$eje=$_POST["txtnombre"];
	$subcapitulo = $_POST["txtsubcapitulo"];
	require_once '../negocio/ejesEstrategico.class.php';
	$objEje = new Eje();
	$objEje->setNombre($eje);
        $objEje->setSubcapitulo($subcapitulo);
	$resultado=$objEje->agregar();
	echo json_encode($resultado);
?>