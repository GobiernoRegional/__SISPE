<?php

require_once '../datos/conexion.php';
class Area  extends Conexion{
    private $codigo;
    private $descripcion;    
    private  $dependencia;
    
    function getCodigo() {
        return $this->codigo;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }
    
    function getDependencia() {
        return $this->dependencia;
    }

    function setDependencia($dependencia) {
        $this->dependencia = $dependencia;
    }

    function listar(){
        try {
            $sql="select * from tbarea are
                inner join tbdependencia dep on 
                (are.are_dep_codigo=dep.dep_codigo) order by are_codigo asc";
            
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
                
                $sql = "select fn_insertarArea( '".$this->getDescripcion()."',"
                        ."'".$this->getDependencia()."')";
                
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
            $sql = "update tbArea "
                    . "set "
                    . "are_Nombre ='".$this->getDescripcion()."',"              
                    . "are_dep_Codigo ='".$this->getDependencia()."'"
                    . "where "
                    . "are_Codigo = '".$this->getCodigo()."'";
            
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
                        are_Codigo,
                        are_Nombre,
                        are_dep_Codigo
                from
                        tbarea
                where
                        are_Codigo = '".$codigo."'
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
            $sql = "delete from tbarea where are_Codigo = '".$this->getCodigo()."'";
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
                $sql = "Select are_Codigo from tbarea order by are_codigo desc limit 1";
                
                $sentencia =  $this->dblink->prepare($sql);            
                $sentencia->execute();
                $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);

                  
                 $valor = (INTEGER)(substr($resultado["are_codigo"], 3,3));   
                $codigo="";                                 
                $codigoss=$valor+1;
                
                if($codigoss>=0 && $codigoss <10){
                    
                    $codigo=(string)("ARE00".$codigoss);
                    
                }else if($codigoss>=10&& $codigoss <100){
                    
                    $codigo=(string)("ARE0".$codigoss);                  
                }else{
                    $codigo=(string)("ARE".$codigoss);
                }
                $array=array('state'=>1,'resultado'=>$codigo);
                return $array;                                               
        } catch (Exception $exc) {        
                                        
            throw $exc;
        }        
        
        
    }
    
    public function obtenerDependencias() {
        try {
            $sql = "
                    select dep_codigo, dep_nombre from tbdependencia order by dep_nombre asc
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
