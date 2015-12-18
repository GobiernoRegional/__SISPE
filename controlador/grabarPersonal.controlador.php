<?php
	$nombres=$_POST["txtnombres"];
	$apellidos=$_POST["txtapellidos"];
	$dni=$_POST["txtdni"];
	$fechanacimiento=$_POST["txtfechanacimiento"];
	$direccion=$_POST["txtdireccion"];
	$sexo=$_POST["txtsexo"];
	$email=$_POST["txtemail"];
	$telefono=$_POST["txttelefono"];
	$cargo=$_POST["txtcargo"];
	$area=$_POST["txtarea"];
	$acceso=$_POST["txtacceso"];
	$usuario=$_POST["txtusuario"];
	$pass=$_POST["txtpassword"];
	if ($acceso==1) {
		$usuariovar="-";
		$passvar="-";
	}else{
		$usuariovar=$usuario;
		$passvar=$pass;
	}
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
	$objPersonal->setUsuario($usuariovar);
	$objPersonal->setPass($passvar);
	$resultado=$objPersonal->agregarpersonal();
	echo json_encode($resultado);
?>