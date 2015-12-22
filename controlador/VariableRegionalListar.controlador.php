<?php
    require_once '../negocio/VariableRegional.class.php';
    $objVariableRegional = new VariableRegional(); 
    $resultado=$objVariableRegional->listar();
    echo json_encode($resultado);
?>
    

    
    