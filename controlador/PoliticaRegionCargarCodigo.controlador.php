<?php
   $codigo=$_POST["codigo"];
    require_once '../negocio/Politica.class.php';
    $objPolitica = new PoliticaR(); 
    $resultado=$objPolitica->leerDatos($codigo);
    echo json_encode($resultado);
?>
    

    
    