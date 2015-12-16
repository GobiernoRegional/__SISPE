<?php

require_once '../negocio/Cargo.class.php';

$operacion = $_POST["a_operacion"];

$objCargo = new Cargo();

//LECTURA DE DATOS
if ($operacion=="leer"){ 
    $codigoCargo = $_POST["p_codigo"];
    $resultado = $objCargo->leerDatos($codigoCargo);
    echo json_encode($resultado);
}

//OPERACION DE AGREGAR Y EDITAR
if ($operacion=="agregar" || $operacion=="editar"){
    parse_str($_POST["p_array_datos"], $datosFrm);    
    if ($datosFrm["txttipooperacion"]=="editar"){   
    $objCargo->setCodigo($datosFrm["txtcodigo"]);    
    }
    $objCargo->setDescripcion($datosFrm["txtnombre"]);  
}

//ELIMINAR UNO Y VARIOS REGISTROS
if ($operacion=="eliminar"){  
    $codigoCargo = $_POST["p_codigo"];
    $resultado = $objCargo->setCodigo($codigoCargo);
}


//OBTENER EL CODIGO DE REGISTRO
if ($operacion=="codigo"){  
     $registros = $objCargo->ObtenerCodigo();        
        echo($registros);
}

try {
    
    //CONFIRMANDO OPERACION DE AGREGAR , EDITAR Y ELIMINAR
    if ($operacion=="agregar" || $operacion=="editar"){
        if ($datosFrm["txttipooperacion"]=="editar"){
        if ($objCargo->editar()==true){
            echo "exito";
        }
    }elseif($datosFrm["txttipooperacion"]=="agregar"){
        if ($objCargo->agregar()==true){
            echo "exito";
        }
    }
    }elseif($operacion=="eliminar") {
        if($objCargo->eliminar()){
            echo"exito";
        }
    }
    
} catch (Exception $ex) {
    header("HTTP/1.1 500");
    echo $ex->getMessage();
}
