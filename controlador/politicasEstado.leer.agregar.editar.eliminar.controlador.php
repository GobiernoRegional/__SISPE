<?php

require_once '../negocio/politicasEstado.class.php';

$operacion = $_POST["a_operacion"];

$objpolitica = new Politica();

//LECTURA DE DATOS
if ($operacion=="leer"){ 
    $codigoPolitica = $_POST["p_codigo"];
    $resultado = $objpolitica->leerDatos($codigoPolitica);
    echo json_encode($resultado);
}

//OPERACION DE AGREGAR Y EDITAR
if ($operacion=="agregar" || $operacion=="editar"){
    parse_str($_POST["p_array_datos"], $datosFrm);    
    if ($datosFrm["txttipooperacion"]=="editar"){   
    $objpolitica->setCodigo($datosFrm["txtcodigo"]);    
    }
    $objpolitica->setTpolitica($datosFrm["cbo_politica"]);  
    $objpolitica->setNombre($datosFrm["txtnombre"]);  
}

//ELIMINAR UNO Y VARIOS REGISTROS
if ($operacion=="eliminar"){  
    $codigoPolitica = $_POST["p_codigo"];
    $resultado = $objpolitica->setCodigo($codigoPolitica);
}

try {
    
    //CONFIRMANDO OPERACION DE AGREGAR , EDITAR Y ELIMINAR
    if ($operacion=="agregar" || $operacion=="editar"){
        if ($datosFrm["txttipooperacion"]=="editar"){
        if ($objpolitica->editar()==true){
            echo "exito";
        }
    }elseif($datosFrm["txttipooperacion"]=="agregar"){
        if ($objpolitica->agregar()==true){
            echo "exito";
        }
    }
    }elseif($operacion=="eliminar") {
        if($objpolitica->eliminar()){
            echo"exito";
        }
    }
    
} catch (Exception $ex) {
    header("HTTP/1.1 500");
    echo $ex->getMessage();
}
