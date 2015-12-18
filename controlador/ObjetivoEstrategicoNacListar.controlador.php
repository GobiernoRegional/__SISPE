<?php
    require_once '../negocio/ObjetivoEstrategicoNacional.class.php';
    $objObjetivoEspNac = new ObjetivoEspNac(); 
    $resultado=$objObjetivoEspNac->listar();
    echo json_encode($resultado);
?>
    

    
    