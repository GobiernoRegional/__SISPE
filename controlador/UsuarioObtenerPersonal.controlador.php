<?php
	require_once '../negocio/usuario.class.php';
	$objUsuario = new Usuario();
	$resultado=$objUsuario->obtenerPersonal();
	echo json_encode($resultado);
?>