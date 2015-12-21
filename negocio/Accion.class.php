<?php

require_once '../datos/conexion.php';
class Accion  extends Conexion{
    private $codigo;
    private $descripcion;    
    private  $objetivo;
    
    function getCodigo() {
      return $this->codigo;
    }

    function getDescripcion() {
      return $this->descripcion;
    }

    function getObjetivo() {
      return $this->objetivo;
    }

    function setCodigo($codigo) {
      $this->codigo = $codigo;
    }

    function setDescripcion($descripcion) {
      $this->descripcion = $descripcion;
    }

    function setObjetivo($objetivo) {
      $this->objetivo = $objetivo;
    }



    function listar(){
        try {
            $sql="select * from  tbaccion acc "
                . "inner join tbobjetivo_especificonacional  oen on (acc.acc_oen_codigo = oen.oen_codigo)";
            
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
                
                $sql = "select fn_accioninsertar( '".$this->getDescripcion()."',"
                        ."'".$this->getObjetivo()."')";
                
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
            $sql = "select fn_accionmodificar('".$this->getCodigo()."','".$this->getDescripcion()."','".$this->getObjetivo()."')";
          
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
                        acc_codigo,
                        acc_descripcion,
                        acc_oen_codigo
                from
                        tbaccion
                where
                        acc_codigo = '".$codigo."'
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
            $sql = "delete from tbaccion where acc_codigo = '".$this->getCodigo()."'";
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
                $sql = "Select acc_codigo from tbaccion order by acc_codigo desc limit 1";
                
                $sentencia =  $this->dblink->prepare($sql);            
                $sentencia->execute();
                $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);

                  
                 $valor = (INTEGER)(substr($resultado["acc_codigo"], 3,3));   
                $codigo="";                                 
                $codigoss=$valor+1;
                
                if($codigoss>=0 && $codigoss <10){
                    
                    $codigo=(string)("ACC00".$codigoss);
                    
                }else if($codigoss>=10&& $codigoss <100){
                    
                    $codigo=(string)("ACC0".$codigoss);                  
                }else{
                    $codigo=(string)("ACC".$codigoss);
                }
                $array=array('state'=>1,'resultado'=>$codigo);
            return $array;                                               
        } catch (Exception $exc) {        
                                        
            throw $exc;
        }        
        
        
    }
    
    public function obtenerObjetivo() {
        try {
            $sql = "
                   Select oen_codigo,oen_nombre from tbobjetivo_especificonacional order by oen_nombre
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