<?php
	$año=$_POST["txtaño"];
        $monto=$_POST["txtmonto"];
	$pin_codigo = $_POST["txtpin_codigo"];
         $total=$_POST["txttotal"];
        
	require_once '../negocio/InversionAno.class.php';
	$objInversionAno = new InversionAno();
	$objInversionAno ->setAño($año);
        $objInversionAno ->setMonto($monto);
        $objInversionAno ->setPin_codigo($pin_codigo);
        $objInversionAno ->setTotal($total);
          
	$resultado=$objInversionAno->agregar();
	echo json_encode($resultado);
        
        
        
?>
