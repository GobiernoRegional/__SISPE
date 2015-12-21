<?php
	$codigo                 = $_POST["txtcodigoedit"];
	$indicador              = $_POST["txtnombreedit"];
        $formula                = $_POST["txtanoedit"];
        $fuente                 = $_POST["txtfuenteedit"];
        $linea                  = $_POST["txtcantidadedit"];
        $tendencia              = $_POST["txtformulaedit"];
        $meta21                 = $_POST["txtmeta21edit"];
        $objNacional            = $_POST["txtobjnacionaledit"];
        
        require_once '../negocio/IndicadorNacional.class.php.class.php';
	$objIndicadorNacional = new IndicadorNacional();
	$objIndicadorNacional->setCodigo($codigo);
	$objIndicadorNacional->setNombre($indicador);
        $objIndicadorNacional->setFormula($formula);
        $objIndicadorNacional->setFuente($fuente);
        $objIndicadorNacional->setLinea($linea);
        $objIndicadorNacional->setTendencia($tendencia);
        $objIndicadorNacional->setMeta21($meta21);
        $objIndicadorNacional->setObjEspNacional($objEspNacional);

	$resultado=$objIndicadorNacional->editar();
	echo json_encode($resultado);
?>