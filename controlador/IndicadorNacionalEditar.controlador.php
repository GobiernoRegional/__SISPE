<?php
	$codigo                 = $_POST["txtcodigo"];
	$indicador              = $_POST["txtindicadoredit"];
        $formula                = $_POST["txtformulaedit"];
        $fuente                 = $_POST["txtfuenteedit"];
        $linea                  = $_POST["txtlineabaseedit"];
        $tendencia              = $_POST["txttendenciaedit"];
        $meta21                 = $_POST["txtmetaedit"];
        $objNacional            = $_POST["txtobjetivoedit"];
        
        require_once '../negocio/IndicadorNacional.class.php';
	$objIndicadorNacional = new IndicadorNacional();
	$objIndicadorNacional->setCodigo($codigo);
	$objIndicadorNacional->setNombre($indicador);
        $objIndicadorNacional->setFormula($formula);
        $objIndicadorNacional->setFuente($fuente);
        $objIndicadorNacional->setLineabase($linea);
        $objIndicadorNacional->setTendencia($tendencia);
        $objIndicadorNacional->setMeta21($meta21);
        $objIndicadorNacional->setObjEspNacional($objNacional);

	$resultado=$objIndicadorNacional->editar();
	echo json_encode($resultado);
?>