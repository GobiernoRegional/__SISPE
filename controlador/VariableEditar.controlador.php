<?php
	$codigo             = $_POST["txtcodigoedit"];
	$variable           = $_POST["txtnombreedit"];
        $sector             = $_POST["txtsectoredit"];
        $justificacion      = $_POST["txtjustificacionedit"];
        $unidadmedida       = $_POST["txtunidadedit"];
        $responsablegestion = $_POST["txtrepon_gestionedit"];
        $responsablereporte = $_POST["txtrepon_reporteedit"];
        
        require_once '../negocio/Variable.class.php';
	$objVariable = new Variable();
	$objVariable->setCodigo($codigo);
	$objVariable->setNombre($variable);
        $objVariable->setSector($sector);
        $objVariable->setJustificacion($justificacion);
        $objVariable->setUnidadanalisis($unidadmedida);
        $objVariable->setResposablegestion($responsablegestion);
        $objVariable->setResponsablereporte($responsablereporte);
	$resultado=$objVariable->editar();
	echo json_encode($resultado);
?>