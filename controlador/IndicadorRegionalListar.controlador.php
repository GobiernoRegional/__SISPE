<?php
    require_once '../negocio/IndicadorRegional.class.php';
    $objIndicadorRegional = new IndicadorRegional(); 
    $resultado=$objIndicadorRegional->listar();
    echo json_encode($resultado);
?>