<?php

    require_once '../negocio/Cargo.class.php';
    
    $objcargo = new Cargo(); 
    $resultado=$objcargo->listar();
    echo json_encode($resultado);
    
?>
    

    
    