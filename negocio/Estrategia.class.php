<?php

require_once '../datos/conexion.php';
class Estrategia  extends Conexion{
    private $codigo;
    private $descripcion;
    private $politica;
    
    function getDescripcion() {
     return $this->descripcion;
    }

    function setDescripcion($descripcion) {
     $this->descripcion = $descripcion;
    }

    function getCodigo() {
        return $this->codigo;
    }


    function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    function getPolitica() {
        return $this->politica;
    }

    function setPolitica($politica) {
        $this->politica = $politica;
    }

            
    function listar(){
        
        try {
            $sql="select * from tbestrategia 
                   order by est_codigo ";
           
            $sentecia = $this->dblink->prepare($sql)OR DIE ("No se pudo Leer Estos Registro");
            $sentecia->execute();
            $registros = $sentecia->fetchAll();
            $array=array('state'=>1,'resultado'=>$registros);
            return $array;
        } catch (Exception $exc) {
            echo $exc;
        }
    }
    
    public function agregar() {
        $this->dblink->beginTransaction();
        
        try {  
                            
               $sql = "select fn_estrategiainsertar('".$this->getDescripcion()."','".$this->getPolitica()."')";
                
                $sentencia = $this->dblink->prepare($sql);
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
            $sql = "select fn_estrategiamodificar('".$this->getCodigo()."','".$this->getDescripcion()."','".$this->getPolitica()."')";                           
            $sentencia = $this->dblink->prepare($sql)OR DIE ("No se pudo Modificar Este Registro");
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
                        est_codigo,
                        est_descripcion                          
                        est_cod_politica
                from
                        tbestrategia                         
                where
                        est_codigo = ".$codigo."'
                ";
            $sentecia = $this->dblink->prepare($sql) OR DIE ("No se pudo leer estos Registro");
            $sentecia->execute();
            $resultado = $sentecia->fetch(PDO::FETCH_ASSOC);
            $array=array('state'=>1,'resultado'=>$resultado);
            return $array;
        } catch (Exception $exc) {
            throw $exc;
        }            
    }
    public function eliminar() {
        try {
            $sql = "delete from tbestrategia where est_codigo = '".$this->getCodigo()."'";
            $sentencia = $this->dblink->prepare($sql) OR DIE ("No se pudo borrar Este Registro");
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
                $sql = "Select est_codigo from tbestrategia order by est_codigo desc limit 1";
                
                $sentencia =  $this->dblink->prepare($sql);            
                $sentencia->execute();
                $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);

                  
                 $valor = (INTEGER)(substr($resultado["est_codigo"], 3,3));   
                $codigo="";                                 
                $codigoss=$valor+1;
                
                if($codigoss>=0 && $codigoss <10){
                    
                    $codigo=(string)("EST00".$codigoss);
                    
                }else if($codigoss>=10&& $codigoss <100){
                    
                    $codigo=(string)("EST0".$codigoss);                  
                }else{
                    $codigo=(string)("EST".$codigoss);
                }
                $array=array('state'=>1,'resultado'=>$codigo);
            return $array;                                               
        } catch (Exception $exc) {        
                                        
            throw $exc;
        }        
        
        
    }
    
    public function obtenerPolitica() {
        try {
            $sql = "
                   Select pol_codigo,pol_descripcion from tbpolitica order by pol_descripcion
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