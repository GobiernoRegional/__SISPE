<?php
    require_once '../negocio/Indicador.class.php';
    $objIndicador = new Indicador(); 
    $resultado=$objIndicador->listar();
    echo json_encode($resultado);
?>
    

    
    