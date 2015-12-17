<?php
    require_once '../negocio/EjeEstrategico.class.php';
    $objEje = new EjeEstrategico(); 
    $resultado=$objEje->listar();
    echo json_encode($resultado);
?>
    

    
    