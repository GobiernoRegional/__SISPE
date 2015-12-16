<?php

require_once '../negocio/personal.class.php';

$operacion = $_POST["a_operacion"];

$objPersonal = new Personal();

//LLENAR COMBOX
if ($operacion=="llenarCombox"){ 
     $tabla = $_POST["p_tabla"];        
        if($tabla=="area"){
            $registros = $objPersonal->obtenerArea();
        }elseif($tabla=="cargo"){
            $registros = $objPersonal->obtenerCargos();
        }elseif($tabla=="distrito"){
            $registros = $objPersonal->obtenerCiudades();       
        }
        $tablas=$tabla;
}

//LECTURA DE DATOS
if ($operacion=="leer"){ 
    $codigoPersonal = $_POST["p_codigo"];
    $resultado = $objPersonal->leerDatos($codigoPersonal);
    echo json_encode($resultado);
}

//OPERACION DE AGREGAR Y EDITAR
if ($operacion=="agregar" || $operacion=="editar"){
    parse_str($_POST["p_array_datos"], $datosFrm);    
    
    $objPersonal->setCodpersona($datosFrm["txtcodigoper"]);    
    
    $objPersonal->setNombres($datosFrm["txnombres"]);
    $objPersonal->setApellidos($datosFrm["txtapellido"]);    
    $objPersonal->setDni($datosFrm["txtdni"]); 
    $objPersonal->setSexo($datosFrm["cbosexo_modal"]); 
    $objPersonal->setDireciones($datosFrm["txtdireccion"]); 
    $objPersonal->setFechaNacimiento($datosFrm["txtfechanacimiento"]); 
    $objPersonal->setCorreo($datosFrm["txtcorreo"]); 
    $objPersonal->setTelefono($datosFrm["txttelefono"]); 
    $objPersonal->setInstitucion($datosFrm["cboinstitucion_modal"]); 
    $objPersonal->setCargo($datosFrm["cbocargo_modal"]); 
    $objPersonal->setDistrito($datosFrm["txtcoddistrito"]); 
    $objPersonal->setEstado($datosFrm["cboestado_modal"]); 
    $tablas="";
}

//ELIMINAR UNO Y VARIOS REGISTROS
if ($operacion=="eliminar"){  
    $codigoPersonal = $_POST["p_codigo"];
    $resultado = $objPersonal->setCodpersona($codigoPersonal);
}


//OBTENER EL CODIGO DE REGISTRO
if ($operacion=="codigo"){  
     $registros = $objPersonal->ObtenerCodigo();        
        echo($registros);
        $tablas="";
}

try {
     //LLENADO CAMPOS    
    if($operacion== "llenarCombox"){
        if($tablas=="area"){       
            for ($i=0; $i<count($registros); $i++) {
                echo '<option value="'.$registros[$i]["are_codigo"].'">'.$registros[$i]["are_nombre"].'</option>';            
            }
        }
        if($tablas=="cargo"){     
    //        print_r($registros);
            for ($i=0; $i<count($registros); $i++) {
                 echo '<option value="'.$registros[$i]["0"].'">'.$registros[$i]["1"].'</option>';            
            }
        }
        if($tablas=="distrito"){       
            for ($i=0; $i<count($registros); $i++) {
                                   // $dataComboxper .= "<option value= \"$reg->pernombres\" id=\"$reg->per_con_codigo\" >";

                echo '<option value="'.$registros[$i]["ciudad"].'" id="'.$registros[$i]["udi_codigo"].'">';            
            }
        }   
   }
    //CONFIRMANDO OPERACION DE AGREGAR , EDITAR Y ELIMINAR
    if ($operacion=="agregar" || $operacion=="editar"){
        if ($datosFrm["txttipooperacion"]=="editar"){
        if ($objPersonal->editar()==true){
            echo "exito";
        }
    }elseif($datosFrm["txttipooperacion"]=="agregar"){
        if ($objPersonal->agregarpersonal()==true){
            echo "exito";
        }
    }
    }elseif($operacion=="eliminar") {
        if($objPersonal->eliminar()){
            echo"exito";
        }
    }
    
} catch (Exception $ex) {
    header("HTTP/1.1 500");
    echo $ex->getMessage();
}
