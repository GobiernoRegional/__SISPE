<?php
	$codigo=$_POST["txtcodigoedit"];
	$meta = $_POST["txtmetaedit"];
        $meta2015 = $_POST["txtmeta2015edit"];
        $meta2016 = $_POST["txtmeta2016edit"];
        $meta2017 = $_POST["txtmeta2017edit"];
        $meta2018 = $_POST["txtmeta2018edit"];
        $indicador = $_POST["txtindicadoredit"];
        
        require_once '../negocio/MetaInstitucional.class.php';
        
	$objMetaIns = new MetaInstitucional();
	$objMetaIns->setCodigo($codigo);
	$objMetaIns->set($meta);
        $objMetaIns->setMe2015($me2015);
        $objMetaIns->setMe2016($me2016);
        $objMetaIns->setMe2017($me2017);
        $objMetaIns->setMe2018($me2018);
        $objMetaIns->setIndicador($indicador);
        
	$resultado=$objMetaIns->editar();
	echo json_encode($resultado);
?>
