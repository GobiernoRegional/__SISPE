<?php
	$codigo                 = $_POST["txtcodigo"];
	$indicador              = $_POST["txtindicadoredit"];
        $ano                    = $_POST["txtlbanioedit"];
        $cantidad                = $_POST["txtlbcantidadedit"];
        $meta2014                 = $_POST["txtmeta2014edit"];
        $meta2018             = $_POST["txtmeta2018edit"];
        $meta2021               = $_POST["txtmeta2021edit"];
        $fuente            = $_POST["txtfuenteedit"];
        $variable              = $_POST["txtvariableedit"];
                
        require_once '../negocio/IndicadorRegional.class.php';
	$objIndicadorRegional = new IndicadorRegional();
	$objIndicadorRegional->setCodigo($codigo);
	$objIndicadorRegional->setNombre($indicador);
        $objIndicadorRegional->setPano($ano);
        $objIndicadorRegional->setMeta2014($meta2014);
        $objIndicadorRegional->setMeta2018($meta2018);
        $objIndicadorRegional->setMeta2021($meta2021);
        $objIndicadorRegional->setCantidad($cantidad);
        $objIndicadorRegional->setFuente($fuente);
        $objIndicadorRegional->setVariable($variable);
	$resultado=$objIndicadorRegional->editar();
	echo json_encode($resultado);
?>