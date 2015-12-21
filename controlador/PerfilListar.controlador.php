<?php
    require_once '../negocio/Perfil.class.php';
    $dni        =   $_POST["dni"];
    $objPlanD = new Perfil(); 
    $resultado=$objPlanD->listar($dni);
    echo json_encode($resultado);
?>
    
