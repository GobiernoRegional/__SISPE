<?php
    require_once '../negocio/ObjetivoEstrategicoRegional.class.php';
    $objObjetivo = new Objetivo(); 
    $resultado=$objObjetivo->listar();
    echo json_encode($resultado);
?>
    

    
    