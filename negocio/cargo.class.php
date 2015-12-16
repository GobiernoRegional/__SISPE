<?php

require_once '../datos/conexion.php';
class Cargo  extends Conexion{
    private $codigo;
    private $descripcion;
    
    public function getCodigo() {
        return $this->codigo;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }
    function listar(){
        
        try {
            $sql="select * from tbcargo 
                   order by car_codigo ";
           
            $sentecia = $this->dblink->prepare($sql)OR DIE ("No se pudo Leer Estos Registro");
            $sentecia->execute();
            $resultado = $sentecia->fetchAll();
            $array=array('state'=>1,'resultado'=>$resultado);
            return $array;
        } catch (Exception $exc) {
            echo $exc;
        }
    }
    
    public function agregar() {
        $this->dblink->beginTransaction();
        
        try {  
                            
               $sql = "select fn_insertarCargo(:descrip)";
                
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->bindParam(":descrip",$this->getDescripcion());
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
          $sql = "update tbcargo "
                    . "set "
                    . "car_nombre ='".$this->getDescripcion()."'"                  
                    . "where "
                    . "car_codigo = '".$this->getCodigo()."'";
            
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
                        car_codigo,
                        car_nombre                        
                from
                        tbcargo                         
                where
                        car_codigo = '".$codigo."'
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
            $sql = "delete from tbcargo where car_codigo = '".$this->getCodigo()."'";
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
                $sql = "Select car_Codigo from tbcargo order by car_Codigo desc limit 1";
                $sentencia= $this->dblink->prepare($sql)OR DIE ("No se pudo Encontrar Este Registro"); 
                $sentencia->execute();
                $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
                
                $valor = (INTEGER)(substr($resultado["car_codigo"], 3,3));  
                $codigo="";                                 
                $codigoss=$valor+1;
                
                if($codigoss>=0 && $codigoss <10){
                    
                    $codigo=(string)("CAR00".$codigoss);
                    
                }else if($codigoss>=10&& $codigoss <100){
                    
                    $codigo=(string)("CAR0".$codigoss);                  
                }else{
                    $codigo=(string)("CAR".$codigoss);
                }
                $array=array('state'=>1,'resultado'=>$codigo);
                return $array;                                                    
        } catch (Exception $exc) {        
                                        
            throw $exc;
        }        
        
        
    }


}
