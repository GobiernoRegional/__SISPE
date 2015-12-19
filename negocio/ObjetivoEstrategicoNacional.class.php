<?php

require_once '../datos/conexion.php';
class ObjetivoEspNac  extends Conexion{
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
            $sql="select * from tbobjetivo_especificonacional oen
                inner join  tbejeestrategico eje on
                (oen.oen_eje_codigo = eje.eje_codigo) order by 1";
            
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
                
                $sql = "select fn_objetivonacionalinsertar( '".$this->getNombre()."',"
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
            $sql = "select fn_objetivonacionalmodificar('".$this->getCodigo()."','".$this->getNombre()."','".$this->getEje()."')";
          
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
                        oen_codigo,
                        oen_nombre,
                        oen_eje_codigo
                from
                        tbobjetivo_especificonacional
                where
                        oen_codigo = '".$codigo."'
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
            $sql = "select fn_objetivonacionaleliminar('".$this->getCodigo()."')";
            $sentencia =  $this->dblink->prepare($sql) ;       
            $sentencia->execute();
            $array=array('state'=>1);
            return $array; 
                                                                    
        } catch (Exception $exc) {        
                                        
            throw $exc;
        }        
        return true;
        
    }

    
    
    


}