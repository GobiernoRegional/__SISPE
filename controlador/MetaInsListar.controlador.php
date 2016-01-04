<?php
    require_once '../negocio/MetaInstitucional.class.php';
    $objMetaIns = new MetaInstitucional(); 
    $resultado=$objMetaIns->listar();
    echo json_encode($resultado);
?>
    

