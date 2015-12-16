<?php

require_once '../negocio/area.class.php';

$operacion = $_POST["a_operacion"];

$objArea = new Area();

//LLENAR COMBOX
if ($operacion=="llenarCombox"){ 
     $tabla = $_POST["p_tabla"];        
        if($tabla=="dependencia"){
            $registros = $objArea->obtenerDependencias();       
        }
        $tablas=$tabla;
}

//LECTURA DE DATOS
if ($operacion=="leer"){ 
    $codigoArea = $_POST["p_codigo"];
    $resultado = $objArea->leerDatos($codigoArea);
    echo json_encode($resultado);
}

//OPERACION DE AGREGAR Y EDITAR
if ($operacion=="agregar" || $operacion=="editar"){
    parse_str($_POST["p_array_datos"], $datosFrm);    
    if ($datosFrm["txttipooperacion"]=="editar"){   
    $objArea->setCodigo($datosFrm["txtcodigo"]);    
    }
    $objArea->setDescripcion($datosFrm["txtnombre"]);
    $objArea->setDependencia($datosFrm["txtcoddependencia"]);
    $tablas="";
}

//ELIMINAR UNO Y VARIOS REGISTROS
if ($operacion=="eliminar"){  
    $codigoArea = $_POST["p_codigo"];
    $resultado = $objArea->setCodigo($codigoArea);
}


//OBTENER EL CODIGO DE REGISTRO
if ($operacion=="codigo"){  
     $registros = $objArea->ObtenerCodigo();        
        echo($registros);
        $tablas="";
}

try {
    if($tablas=="dependencia"){       
            for ($i=0; $i<count($registros); $i++) {
                                   // $dataComboxper .= "<option value= \"$reg->pernombres\" id=\"$reg->per_con_codigo\" >";

                echo '<option value="'.$registros[$i]["dep_nombre"].'" id="'.$registros[$i]["dep_codigo"].'">';            
            }
        }    
    
    //CONFIRMANDO OPERACION DE AGREGAR , EDITAR Y ELIMINAR
    if ($operacion=="agregar" || $operacion=="editar"){
        if ($datosFrm["txttipooperacion"]=="editar"){
        if ($objArea->editar()==true){
            echo "exito";
        }
    }elseif($datosFrm["txttipooperacion"]=="agregar"){
        if ($objArea->agregar()==true){
            echo "exito";
        }
    }
    }elseif($operacion=="eliminar") {
        if($objArea->eliminar()){
            echo"exito";
        }
    }
    
} catch (Exception $ex) {
    header("HTTP/1.1 500");
    echo $ex->getMessage();
}
