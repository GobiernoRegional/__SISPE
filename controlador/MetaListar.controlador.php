<?php
    require_once '../negocio/Meta.class.php';
    $objMeta = new Meta(); 
    $resultado=$objMeta->listar();
    echo json_encode($resultado);
?>
    

