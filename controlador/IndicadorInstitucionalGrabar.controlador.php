<?php	
	$indicador              = $_POST["txtindicador"];
        $fuente                 = $_POST["txtfuente"];
        $linea                  = $_POST["txtlinea"];
        $responsable            = $_POST["txtresponsable"];
        $ruta                   = $_POST["txtruta"];
        $objEstrategia          = $_POST["txtobjetivo"];
        
        require_once '../negocio/IndicadorInstitucional.php';
        
	$objIndicadorInst = new IndicadorInstitucional();
	$objIndicadorInst->setNombre($indicador);
        $objIndicadorInst->setFuente($fuente);
        $objIndicadorInst->setLinea($linea);
        $objIndicadorInst->setResponsable($responsable);
        $objIndicadorInst->setRuta($ruta);
        $objIndicadorInst->setObjetivo($objEstrategia);

	$resultado=$objIndicadorInst->agregar();
	echo json_encode($resultado);
?>