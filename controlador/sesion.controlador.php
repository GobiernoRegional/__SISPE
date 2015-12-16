<?php

require_once '../negocio/Sesion.class.php';
require_once '../util/funciones/Funciones.class.php';

$objSesion = new Sesion();
$objSesion->setUsuario('gobierno');
$objSesion->setClave('123456');


if (isset($_POST["chkrecordar"])){
    $objSesion->setRecordar("S");
}else{
    $objSesion->setRecordar("N");
}

$resultado = $objSesion->iniciarSesion();
<<<<<<< HEAD:SisPE/controlador/sesion.controlador.php
//print_r($resultado);
=======
print_r($resultado);
>>>>>>> 134963652b31b81f4a190f226190fbfb43a44c47:spe/controlador/sesion.controlador.php
switch ($resultado){
    case 1:       
        header("location:../vista/principal.php");
        break;
    case 2:
        Funciones::mensaje(
                "El usuario se encuentra inactivo", 
                "a",
                "../vista/index.php",
                10);
        break;
    default:
        Funciones::mensaje(
                "El usuario del usuario o la contraseña son incorrectos", 
                "e",
                "../vista/index.php",
                5);
}