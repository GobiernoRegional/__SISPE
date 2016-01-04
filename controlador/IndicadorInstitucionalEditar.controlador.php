<?php
	$codigo                 = $_POST["txtcodigo"];
	$indicador              = $_POST["txtindicadoredit"];
        $fuente                 = $_POST["txtfuenteedit"];
        $linea                  = $_POST["txtlineaedit"];
        $responsable            = $_POST["txtresponsableedit"];
        $ruta                   = $_POST["txtrutaedit"];
        $objEstrategia          = $_POST["txtobjetivoedit"];
        
        require_once '../negocio/IndicadorInstitucional.php';
	$objIndicadorInst = new IndicadorInstitucional();
	$objIndicadorInst->setCodigo($codigo);
	$objIndicadorInst->setNombre($indicador);
        $objIndicadorInst->setFuente($fuente);
        $objIndicadorInst->setLinea($linea);
        $objIndicadorInst->setResponsable($responsable);
        $objIndicadorInst->setRuta($ruta);
        $objIndicadorInst->setObjetivo($objEstrategia);

	$resultado=$objIndicadorInst->editar();
	echo json_encode($resultado);
?>