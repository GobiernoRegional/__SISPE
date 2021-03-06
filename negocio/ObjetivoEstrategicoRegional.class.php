<?php

require_once '../datos/conexion.php';
class Objetivo  extends Conexion{
    private $codigo;
    private $nombre;    
    private  $eje;
    
    function getEje() {
      return $this->eje;
    }   

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
    
    function setEje($eje) {
      $this->eje = $eje;
    }


    function listar(){
        try {
            $sql="select * from tbobjetivo_especifico oes
                inner join  tbejeestrategico eje on
                (oes.oes_eje_codigo = eje.eje_codigo) order by 1";
            
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
                
                $sql = "select fn_objetivoregionalinsertar( '".$this->getNombre()."',"
                        ."'".$this->getEje()."')";
                
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
            $sql = "select fn_objetivoregionalmodificar('".$this->getCodigo()."','".$this->getNombre()."','".$this->getEje()."')";
          
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
                        oes_codigo,
                        oes_nombre,
                        oes_eje_codigo
                from
                        tbobjetivo_especifico
                where
                        oes_codigo = '".$codigo."'
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
            $sql = "select fn_objetivoregionaleliminar('".$this->getCodigo()."')";
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
                $sql = "Select oes_codigo from tbobjetivo_especifico order by oes_codigo desc limit 1";
                
                $sentencia =  $this->dblink->prepare($sql);            
                $sentencia->execute();
                $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);

                  
                 $valor = (INTEGER)(substr($resultado["oes_codigo"], 3,3));   
                $codigo="";                                 
                $codigoss=$valor+1;
                
                if($codigoss>=0 && $codigoss <10){
                    
                    $codigo=(string)("OES00".$codigoss);
                    
                }else if($codigoss>=10&& $codigoss <100){
                    
                    $codigo=(string)("OES0".$codigoss);                  
                }else{
                    $codigo=(string)("OES".$codigoss);
                }
                $array=array('state'=>1,'resultado'=>$codigo);
            return $array;                                               
        } catch (Exception $exc) {        
                                        
            throw $exc;
        }        
        
        
    }
    
    public function obtenerEjes() {
        try {
            $sql = "
                    select eje_codigo, eje_nombre from tbejeestrategico order by eje_nombre asc
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