<?php
    require_once '../negocio/IndicadorRegionalNacional.class.php';
    $objIndicadorRegionalNacional = new IndicadorRegionalNacional(); 
    $resultado=$objIndicadorRegionalNacional->listar();
    echo json_encode($resultado);
?>