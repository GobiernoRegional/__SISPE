<?php
    require_once '../negocio/Inversion.class.php';
    $objInversion = new Inversion(); 
    $resultado=$objInversion->listar();
    echo json_encode($resultado);
?>
    

    
    