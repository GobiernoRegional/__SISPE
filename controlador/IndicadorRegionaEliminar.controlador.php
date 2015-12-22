<?php
	$codigo=$_POST["codigo"];
        require_once '../negocio/IndicadorRegional.class.php';
	$objIndicadorRegional = new IndicadorRegional();
	$objIndicadorRegional->setCodigo($codigo);
	$resultado=$objIndicadorRegional->eliminar();
	echo json_encode($resultado);
?>