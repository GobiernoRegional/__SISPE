<?php
    require_once '../negocio/PoliticaLineamiento.class.php';
    $objPoliticaLineamiento = new PoliticaLineamiento(); 
    $resultado=$objPoliticaLineamiento->listar();
    echo json_encode($resultado);
?>
