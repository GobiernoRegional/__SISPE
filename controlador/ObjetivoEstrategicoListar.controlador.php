<?php
    require_once '../negocio/objetivoEstrategico.class.php';
    $objObjetivo = new Objetivo(); 
    $resultado=$objObjetivo->listar();
    echo json_encode($resultado);
?>
    

    
    