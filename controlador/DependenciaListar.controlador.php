<?php
    require_once '../negocio/dependencia.class.php';
    $objDependencia = new Dependencia(); 
    $resultado=$objDependencia->listar();
    echo json_encode($resultado);
?>
    

    
    