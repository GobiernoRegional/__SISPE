<?php
    require_once '../negocio/Variable.class.php';
    $objVariable = new Variable(); 
    $resultado=$objVariable->listar();
    echo json_encode($resultado);
?>
    

    
    