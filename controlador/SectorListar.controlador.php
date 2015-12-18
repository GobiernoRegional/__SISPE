<?php
    require_once '../negocio/TipoSector.class.php';
    $objTipoSector = new TipoSector(); 
    $resultado=$objTipoSector->listar();
    echo json_encode($resultado);
?>
    

    
    