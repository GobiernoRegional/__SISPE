<?php
	$meta = $_POST["txtmeta"];
        $meta2015 = $_POST["txtmeta2015"];
        $meta2016 = $_POST["txtmeta2016"];
        $meta2017 = $_POST["txtmeta2017"];
        $meta2018 = $_POST["txtmeta2018"];
        $indicador = $_POST["txtindicador"];
        
        require_once '../negocio/MetaInstitucional.class.php';
        
	$objMetaIns = new MetaInstitucional();
	$objMetaIns->setCodigo($codigo);
	$objMetaIns->set($meta);
        $objMetaIns->setMe2015($me2015);
        $objMetaIns->setMe2016($me2016);
        $objMetaIns->setMe2017($me2017);
        $objMetaIns->setMe2018($me2018);
        $objMetaIns->setIndicador($indicador);
        
	$resultado=$objMetaIns->agregar();
	echo json_encode($resultado);
?>