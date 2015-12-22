<?php
    require_once '../negocio/ProgramaProyecto.class.php';
    $objProgramaProyecto = new ProgramaProyecto(); 
    $resultado=$objProgramaProyecto->listar();
    echo json_encode($resultado);
?>
    

    
    