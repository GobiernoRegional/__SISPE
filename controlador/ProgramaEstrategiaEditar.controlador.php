<?php
	$codigo=$_POST["txtcodigoedit"];
	$pestrategia = $_POST["txtnombreedit"];
        $tipo = $_POST["txttipoaedit"];
        $titulo = $_POST["txttituloedit"];
        $ambito =  $_POST["txtambitoedit"];
        $descripcion =  $_POST["txtdescripcionedit"];
        $monto =  $_POST["txtmontoedit"];
        $eje =  $_POST["txtejeedit"];
        $sector =  $_POST["txtsectoredit"];
        
        require_once '../negocio/ProgramaEstrategia.class.php';
        
	$objProEstrategia = new ProgramaEstrategia();
	$objProEstrategia->setCodigo($codigo);
	$objProEstrategia->setTipo($tipo);
        $objProEstrategia->setTitulo($titulo);
        $objProEstrategia->setAmbito($ambito);
        $objProEstrategia->setDescripcion($descripcion);
        $objProEstrategia->setMonto($monto);
        $objProEstrategia->setEje($eje);
        $objProEstrategia->setSector($sector);
        
	$resultado=$objProEstrategia->editar();
	echo json_encode($resultado);
?>