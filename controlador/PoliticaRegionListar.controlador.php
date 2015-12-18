<?php
    require_once '../negocio/Politica.class.php';
    $objPolitica = new PoliticaR(); 
    $resultado=$objPolitica->listar();
    echo json_encode($resultado);
?>
    

    
    