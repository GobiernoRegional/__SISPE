<?php
    require_once '../negocio/IndicadorInstitucional.php';
    $objIndicadorInst = new IndicadorInstitucional(); 
    $resultado=$objIndicadorInst->listar();
    echo json_encode($resultado);
?>