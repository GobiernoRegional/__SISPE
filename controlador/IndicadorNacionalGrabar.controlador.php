<?php
	$indicador              = $_POST["txtindicador"];
        $formula                = $_POST["txtformula"];
        $fuente                 = $_POST["txtfuente"];
        $linea                  = $_POST["txtlineabase"];
        $meta21                 = $_POST["txtmeta"];
        $tendencia = $_POST["txttendencia"];
        $objNacional            = $_POST["txtobjetivo"];
        
        require_once '../negocio/IndicadorNacional.class.php';
	$objIndicadorNacional = new IndicadorNacional();
	$objIndicadorNacional->setNombre($indicador);
        $objIndicadorNacional->setFormula($formula);
        $objIndicadorNacional->setFuente($fuente);
        $objIndicadorNacional->setLineabase($linea);
        $objIndicadorNacional->setMeta21($meta21);
        $objIndicadorNacional->setTendencia($tendencia);
        $objIndicadorNacional->setObjEspNacional($objNacional);

	$resultado=$objIndicadorNacional->agregar();
	echo json_encode($resultado);
?>