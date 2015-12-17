<?php
    require_once '../negocio/ejesEstrategico.class.php';
    $objEje = new Eje(); 
    $resultado=$objEje->listar();
    echo json_encode($resultado);
?>
    

    
    