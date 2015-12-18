<?php
    require_once '../negocio/Estrategia.class.php';
    $objEstrategia = new Estrategia(); 
    $resultado=$objEstrategia->listar();
    echo json_encode($resultado);
?>
    

    
    