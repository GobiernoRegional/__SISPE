<?php
	$indicador              = $_POST["txtindicador"];
        $cantidad                = $_POST["txtlbcantidad"];
        $ano                    = $_POST["txtlbanio"];
        $meta2014                 = $_POST["txtmeta2014"];
        $meta2018             = $_POST["txtmeta2018"];
        $meta2021               = $_POST["txtmeta2021"];
        $fuente            = $_POST["txtfuente"];
        $variable              = $_POST["txtvariable"];
        
	require_once '../negocio/IndicadorRegional.class.php';
	$objIndicadorRegional = new IndicadorRegional();
        
	$objIndicadorRegional->setNombre($indicador);
        $objIndicadorRegional->setPano($ano);
        $objIndicadorRegional->setMeta2014($meta2014);
        $objIndicadorRegional->setMeta2018($meta2018);
        $objIndicadorRegional->setMeta2021($meta2021);
        $objIndicadorRegional->setCantidad($cantidad);
        $objIndicadorRegional->setFuente($fuente);
        $objIndicadorRegional->setVariable($variable);
        
	$resultado=$objIndicadorRegional->agregar();
        //return;
	echo json_encode($resultado);
?>