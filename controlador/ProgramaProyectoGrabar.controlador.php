<?php
	$programaproyecto = $_POST["txtestrategia"];
        $politica = $_POST["txtpolitica"];
        
    require_once '../negocio/ProgramaProyecto.class.php';
	$objProgramaProyecto = new ProgramaProyecto();
	$objProgramaProyecto->setDescripcion($programaproyecto);
    $objProgramaProyecto->setPolitica($politica);
        
	$resultado=$objProgramaProyecto->agregar();
	echo json_encode($resultado);
?>