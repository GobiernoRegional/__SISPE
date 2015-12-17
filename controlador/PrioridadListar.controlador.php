<?php
    require_once '../negocio/Prioridad.class.php';
    $objPrioridad = new Prioridad(); 
    $resultado=$objPrioridad->listar();
    echo json_encode($resultado);
?>
