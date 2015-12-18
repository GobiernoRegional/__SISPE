<?php
	$pestrategia=$_POST["txtnombre"];
	$tipo = $_POST["txttipo"];
        $titulo= $_POST["txttitulo"];
        $ambito= $_POST["txtambito"];
        $descripcion= $_POST["txtdescripcion"];
        $monto= $_POST["txtmonto"];
        $eje= $_POST["txteje"];
        $sector= $_POST["txtsector"];
        
	require_once '../negocio/ProgramaEstrategia.class.php';
        
	$objProEstrategia = new ProgramaEstrategia();
	$objProEstrategia->setTipo($pestrategia);
        $objProEstrategia->setTitulo($tipo);
        $objProEstrategia->setAmbito($titulo);
        $objProEstrategia->setDescripcion($descripcion);
        $objProEstrategia->setMonto($monto);
        $objProEstrategia->setEje($eje);
        $objProEstrategia->setSector($sector);
        
	$resultado=$objProEstrategia->agregar();
	echo json_encode($resultado);
?>