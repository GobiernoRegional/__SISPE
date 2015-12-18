<?php

require_once '../datos/conexion.php';
class EjeEstrategico  extends Conexion{
    private $codigo;
    private $nombre;    
    private $subcapitulo;
   
    function getCodigo() {
        return $this->codigo;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getSubcapitulo() {
        return $this->subcapitulo;
    }

    function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setSubcapitulo($subcapitulo) {
        $this->subcapitulo = $subcapitulo;
    }
    
    function listar(){
        try {
            $sql="select * from tbEjeEstrategico eje inner join tbsubcapitulos scp on 
                (eje.eje_sub_codigo=scp.sub_codigo) order by eje_codigo asc";
            
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
                
                $sql = "select fn_ejeestrategicoinsertar( '".$this->getNombre()."',"
                        ."'".$this->getSubcapitulo()."')";
                
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
            $sql = "update tbEjeEstrategico "
                    . "set "
                    . "eje_nombre ='".$this->getNombre()."',"              
                    . "eje_sub_codigo ='".$this->getSubcapitulo()."'"
                    . "where "
                    . "eje_Codigo = '".$this->getCodigo()."'";
            
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
                        eje_Codigo,
                        eje_nombre,
                        eje_sub_codigo
                from
                        tbEjeEstrategico
                where
                        eje_Codigo = '".$codigo."'
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
            $sql = "delete from tbEjeEstrategico where eje_Codigo = '".$this->getCodigo()."'";
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
