<?php
    require_once '../negocio/ProgramaInversion.class.php';
    $objProInversion= new ProgramaInversion(); 
    $resultado=$objProInversion->listar();
    echo json_encode($resultado);
?>