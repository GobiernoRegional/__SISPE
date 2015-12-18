<?php
    require_once '../negocio/ProgramaEstrategia.class.php';
    $objProEstrategia = new ProgramaEstrategia(); 
    $resultado=$objProEstrategia->listar();
    echo json_encode($resultado);
?>
    