<?php
    require_once '../negocio/ObjetivoNacional.class.php';
    $objObjNacional = new ObjNacional(); 
    $resultado=$objObjNacional->listar();
    echo json_encode($resultado);
?>