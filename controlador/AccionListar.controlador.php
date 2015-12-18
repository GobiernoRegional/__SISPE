<?php
    require_once '../negocio/Accion.class.php';
    $objAccion = new Accion(); 
    $resultado=$objAccion->listar();
    echo json_encode($resultado);
?>
    

    
    