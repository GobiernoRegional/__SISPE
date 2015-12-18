<?php

require_once '../datos/conexion.php';
class Prioridad  extends Conexion{
    private $codigo;
    private $nombre;    
    private $eje;
   
    function getCodigo() {
        return $this->codigo;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getEje() {
        return $this->eje;
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
            $sql="select * from tbprioridad pri inner join tbejeestrategico eje on 
                (pri.pri_eje_codigo=eje.eje_codigo) order by pri_codigo asc";
            
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
                
                $sql = "select fn_prioridadinsertar('".$this->getNombre()."',"
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
            $sql = "update tbprioridad "
                    . "set "
                    . "pri_nombre ='".$this->getNombre()."',"              
                    . "pri_eje_codigo ='".$this->getEje()."'"
                    . "where "
                    . "pri_Codigo = '".$this->getCodigo()."'";
            
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
                        pri_Codigo,
                        pri_nombre,
                        pri_eje_codigo
                from
                        tbPrioridad
                where
                        pri_Codigo = '".$codigo."'
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
            $sql = "delete from tbPrioridad where pri_Codigo = '".$this->getCodigo()."'";
            $sentencia =  $this->dblink->prepare($sql) ;       
            $sentencia->execute();
            $array=array('state'=>1);
            return $array; 
                                                                    
        } catch (Exception $exc) {        
                                        
            throw $exc;
        }        
        return true;
        
    }
    
    public function obtenerEjeEstrategico() {
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
