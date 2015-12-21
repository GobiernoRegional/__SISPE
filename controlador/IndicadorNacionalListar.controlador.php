<?php
    require_once '../negocio/IndicadorNacional.class.php';
    $objIndicadorNacional = new IndicadorNacional(); 
    $resultado=$objIndicadorNacional->listar();
    echo json_encode($resultado);
?>