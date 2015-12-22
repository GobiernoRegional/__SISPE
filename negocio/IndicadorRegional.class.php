<?php

require_once '../datos/conexion.php';
class IndicadorRegional  extends Conexion{

    private $codigo;
    private $nombre;    
    private $cantidad;
    private $pano;
    private $meta2014;
    private $meta2018;
    private $meta2021;
    private $fuente;
    private $variable;
    
    function getCodigo() {
     return $this->codigo;
    }

    function getNombre() {
     return $this->nombre;
    }

    function setCodigo($codigo) {
     $this->codigo = $codigo;
    }

    function setNombre($nombre) {
     $this->nombre = $nombre;
    }

    function getCantidad() {
        return $this->cantidad;
    }

    function getPano() {
        return $this->pano;
    }

    function getMeta2014() {
        return $this->meta2014;
    }

    function getMeta2018() {
        return $this->meta2018;
    }

    function getMeta2021() {
        return $this->meta2021;
    }

    function getFuente() {
        return $this->fuente;
    }

    function getVariable() {
        return $this->variable;
    }

    function setPano($pano) {
        $this->pano = $pano;
    }

    function setMeta2014($meta2014) {
        $this->meta2014 = $meta2014;
    }

    function setCantidad($cantidad) {
        $this->cantidad = $cantidad;
    }

    function setMeta2018($meta2018) {
        $this->meta2018 = $meta2018;
    }

    function setMeta2021($meta2021) {
        $this->meta2021 = $meta2021;
    }

    function setFuente($fuente) {
        $this->fuente = $fuente;
    }

    function setVariable($variable) {
        $this->variable = $variable;
    }


    function listar(){
        try {
            $sql="
                select *
                from tb_indicador ind
                inner join tb_variable  var	on (ind.indr_cod_variable = var.var_codigo)";
            
            $sentencia =  $this->dblink->prepare($sql)OR DIE ("No se pudo Leer Estos Registro");
            $sentencia->execute();
            $registros = $sentencia->fetchAll();
            $array=array('state'=>1,'resultado'=>$registros);
            return $array;
            
            } catch (Exception $exc) {
                echo $exc;
            }
    }
    
    public function agregar() {
        $this->dblink->beginTransaction();
        
        try {  
                
                $sql = "select fn_tvinsertarindicador('".$this->getNombre()."',".$this->getCantidad().",".$this->getPano().",
                    ".$this->getMeta2014().",".$this->getMeta2018().",".$this->getMeta2021().",
                    '".$this->getFuente()."','".$this->getVariable()."')";
                //echo $sql;
                //return;
                $sentencia =  $this->dblink->prepare($sql);
                $sentencia->execute();
                $this->dblink->commit();
                $array=array('state'=>1);
                return $array;
            
        } catch (Exception $exc) {
            $this->dblink->rollBack();
            throw $exc;
        }
        
        return true;        
    }
    
    public function editar() {
        $this->dblink->beginTransaction();
        
        try {
             $sql = "select fn_tvmodificarindicador('".$this->getCodigo()."','".$this->getNombre()."',".$this->getCantidad().",
                    ".$this->getPano().",".$this->getMeta2014().",".$this->getMeta2018().",".$this->getMeta2021().",
                    '".$this->getFuente()."','".$this->getVariable()."')";
          
            $sentencia =  $this->dblink->prepare($sql);
            $sentencia->execute();
            $this->dblink->commit();
            $array=array('state'=>1);
            return $array;
            
        } catch (Exception $exc) {
            $this->dblink->rollBack();
            throw $exc;
        }
        
        return true;        
    }
    
    public function leerDatos($codigo) {
        try {
            $sql = "
                select
                  indr_codigo ,
		  indr_nombre ,
		  indr_lb_cantidad ,
		  indr_lb_ano ,
		  indr_meta_2014 ,
		  indr_meta_2018 ,
		  indr_meta_2021 ,
		  indr_fuente ,
		  indr_cod_variable   
                from
                        tb_indicador
                where
                        indr_codigo = '".$codigo."'
                ";
            $sentencia =  $this->dblink->prepare($sql) ;
            $sentencia->execute();
            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
            $array=array('state'=>1,'resultado'=>$resultado);
            return $array;
      
        } catch (Exception $exc) {
            throw $exc;
        }            
    }
    public function eliminar() {
        try {
            $sql = "delete from tb_indicador where indr_codigo = '".$this->getCodigo()."'";
            $sentencia =  $this->dblink->prepare($sql) ;       
            $sentencia->execute();
            $array=array('state'=>1);
            return $array; 
                                                                    
        } catch (Exception $exc) {        
                                        
            throw $exc;
        }        
        return true;
        
    }

    public function ObtenerCodigo() {
        $this->dblink->beginTransaction();
        
        try {               
                $sql = "Select indr_codigo from tb_indicador order by indr_codigo desc limit 1";
                
                $sentencia =  $this->dblink->prepare($sql);            
                $sentencia->execute();
                $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);

                  
                 $valor = (INTEGER)(substr($resultado["indr_codigo"], 3,3));   
                $codigo="";                                 
                $codigoss=$valor+1;
                
                if($codigoss>=0 && $codigoss <10){
                    
                    $codigo=(string)("IND00".$codigoss);
                    
                }else if($codigoss>=10&& $codigoss <100){
                    
                    $codigo=(string)("IND0".$codigoss);                  
                }else{
                    $codigo=(string)("IND".$codigoss);
                }
                $array=array('state'=>1,'resultado'=>$codigo);
            return $array;                                               
        } catch (Exception $exc) {        
                                        
            throw $exc;
        }        
        
        
    }
    
    public function obtenerVariable() {
        try {
            $sql = "
                   Select var_codigo,var_nombre from tb_variable order by var_nombre
                    ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(); 
            
            return $resultado;
         
        } catch (Exception $exc) {
            throw $exc;
        }
    }   
       
}