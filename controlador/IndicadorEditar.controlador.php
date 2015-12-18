<?php
	$codigo                 = $_POST["txtcodigoedit"];
	$indicador              = $_POST["txtnombreedit"];
        $ano                    = $_POST["txtanoedit"];
        $medida                 = $_POST["txtmedidadedit"];
        $fuente                 = $_POST["txtfuenteedit"];
        $cantidad               = $_POST["txtcantidadedit"];
        $formula                = $_POST["txtformulaedit"];
        $frecuencia             = $_POST["txtfecuenciaedit"];
        $intencion              = $_POST["txtintencionedit"];
        $linea                  = $_POST["txtlineaedit"];
        $objNacional            = $_POST["txtobjnacionaledit"];
        $variable               = $_POST["txtvariableedit"];
        $tendencia              = $_POST["txttendenciaedit"];
        $periodo                = $_POST["txtperiodoedit"];
        
        require_once '../negocio/Indicador.class.php';
	$objIndicador = new Indicador();
	$objIndicador->setCodigo($codigo);
	$objIndicador->setNombre($indicador);
        $objIndicador->setAno($ano);
        $objIndicador->setMedida($medida);
        $objIndicador->setFuente($fuente);
        $objIndicador->setCantidad($cantidad);
        $objIndicador->setFormula($formula);
        $objIndicador->setFrecuencia($frecuencia);
        $objIndicador->setIntencion($intencion);
        $objIndicador->setLinea($linea);
        $objIndicador->setObjEstNacional($objNacional);
        $objIndicador->setVariable($variable);
        $objIndicador->setTendencia($tendencia);
        $objIndicador->setPeriodo($periodo);
	$resultado=$objIndicador->editar();
	echo json_encode($resultado);
?>