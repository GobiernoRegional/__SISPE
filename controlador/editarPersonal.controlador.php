<?php
	$codigo=$_POST["txtcodigo"];
	$nombres=$_POST["txtnombresedit"];
	$apellidos=$_POST["txtapellidosedit"];
	$dni=$_POST["txtdniedit"];
	$fechanacimiento=$_POST["txtfechanacimientoedit"];
	$direccion=$_POST["txtdireccionedit"];
	$sexo=$_POST["txtsexoedit"];
	$email=$_POST["txtemailedit"];
	$telefono=$_POST["txttelefonoedit"];
	$cargo=$_POST["txtcargoedit"];
	$area=$_POST["txtareaedit"];
	
	require_once '../negocio/personal.class.php';
	$objPersonal = new Personal();
	$objPersonal->setNombres($nombres);
	$objPersonal->setApellidos($apellidos);
	$objPersonal->setSexo($sexo);
	$objPersonal->setDni($dni);
	$objPersonal->setDireciones($direccion);
	$objPersonal->setFechaNacimiento($fechanacimiento);
	$objPersonal->setInstitucion($area);
	$objPersonal->setCargo($cargo);
	$objPersonal->setTelefono($telefono);
	$objPersonal->setCorreo($email);
	$objPersonal->setCodpersona($codigo);
	$resultado=$objPersonal->editar();
	echo json_encode($resultado);
?>