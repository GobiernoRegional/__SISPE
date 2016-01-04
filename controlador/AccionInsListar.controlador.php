<?php
    require_once '../negocio/AccionInstitucional.php';
    $objAccionIns = new AccionInstitucional(); 
    $resultado=$objAccionIns->listar();
    echo json_encode($resultado);
?>
    

    
    