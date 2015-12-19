<?php
    require_once '../negocio/InversionAno.class.php';
    $objInversionAno = new InversionAno(); 
    $resultado=$objInversionAno->listar();
    echo json_encode($resultado);
?>
