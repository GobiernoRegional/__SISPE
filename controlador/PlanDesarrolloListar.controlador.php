<?php
    require_once '../negocio/PlanDesarrollo.class.php';
    $objPlanD = new PlanDesarrollo(); 
    $resultado=$objPlanD->listar();
    echo json_encode($resultado);
?>
    

    
    