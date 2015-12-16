<?php

require_once '../negocio/dependencia.class.php';

$operacion = $_POST["a_operacion"];

$objDependencia = new Dependencia();

//LLENAR COMBOX
if ($operacion=="llenarCombox"){ 
     $tabla = $_POST["p_tabla"];        
        if($tabla=="distrito"){
            $registros = $objDependencia->obtenerCiudades();       
        }
        $tablas=$tabla;
}

//LECTURA DE DATOS
if ($operacion=="leer"){ 
    $codigoDependencia = $_POST["p_codigo"];
    $resultado = $objDependencia->leerDatos($codigoDependencia);
    echo json_encode($resultado);
}

//OPERACION DE AGREGAR Y EDITAR
if ($operacion=="agregar" || $operacion=="editar"){
    parse_str($_POST["p_array_datos"], $datosFrm);    
    if ($datosFrm["txttipooperacion"]=="editar"){   
    $objDependencia->setCodigo($datosFrm["txtcodigo"]);    
    }
    $objDependencia->setDescripcion($datosFrm["txtnombre"]);
    $objDependencia->setTelefono($datosFrm["txttelefono"]);  
    $objDependencia->setDistrito($datosFrm["txtcoddistrito"]);
    $tablas="";
}

//ELIMINAR UNO Y VARIOS REGISTROS
if ($operacion=="eliminar"){  
    $codigoDependencia = $_POST["p_codigo"];
    $resultado = $objDependencia->setCodigo($codigoDependencia);
}


//OBTENER EL CODIGO DE REGISTRO
if ($operacion=="codigo"){  
     $registros = $objDependencia->ObtenerCodigo();        
        echo($registros);
        $tablas="";
}

try {
    if($tablas=="distrito"){       
            for ($i=0; $i<count($registros); $i++) {
                                   // $dataComboxper .= "<option value= \"$reg->pernombres\" id=\"$reg->per_con_codigo\" >";

                echo '<option value="'.$registros[$i]["ciudad"].'" id="'.$registros[$i]["udi_codigo"].'">';            
            }
        }    
    
    //CONFIRMANDO OPERACION DE AGREGAR , EDITAR Y ELIMINAR
    if ($operacion=="agregar" || $operacion=="editar"){
        if ($datosFrm["txttipooperacion"]=="editar"){
        if ($objDependencia->editar()==true){
            echo "exito";
        }
    }elseif($datosFrm["txttipooperacion"]=="agregar"){
        if ($objDependencia->agregar()==true){
            echo "exito";
        }
    }
    }elseif($operacion=="eliminar") {
        if($objDependencia->eliminar()){
            echo"exito";
        }
    }
    
} catch (Exception $ex) {
    header("HTTP/1.1 500");
    echo $ex->getMessage();
}
