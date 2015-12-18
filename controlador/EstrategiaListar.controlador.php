<?php
    require_once '../negocio/area.class.php';
    $objArea = new Area(); 
    $resultado=$objArea->listar();
    echo json_encode($resultado);
?>
    

    
    