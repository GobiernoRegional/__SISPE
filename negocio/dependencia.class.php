<?php

require_once '../datos/conexion.php';
class Dependencia  extends Conexion{
    private $codigo;
    private $descripcion;
    private $telefono;
    private  $distrito;
    
    function getTelefono() {
        return $this->telefono;
    }
    
    function setTelefono($telefono) {
        $this->telefono = $telefono;
    }
        
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
    
    function getDistrito() {
        return $this->distrito;
    }

    function setDistrito($distrito) {
        $this->distrito = $distrito;
    }

    function listar(){
        try {
            $sql="select * from tbdependencia dep
                  inner join tbubigeo_distrito udi on 
                    (dep.dep_udi_codigo=udi.udi_codigo) order by dep_codigo asc";
            
            $sentencia =  $this->dblink->prepare($sql)OR DIE ("No se pudo Leer Estos Registro");
            $sentencia->execute();
            $registros = $sentencia->fetchAll();
            return $registros;
            
            } catch (Exception $exc) {
                echo $exc;
            }
    }
    
    public function agregar() {
        $this->dblink->beginTransaction();
        
        try {  
                
                $sql = "select fn_insertarDependencia( '".$this->getDescripcion()."',"
                        . "'".$this->getTelefono()."',"."'".$this->getDistrito()."')";
                
                 $sentencia =  $this->dblink->prepare($sql);
                 $sentencia->execute();
                $this->dblink->commit();                            
            
        } catch (Exception $exc) {
            $this->dblink->rollBack();
            throw $exc;
        }
        
        return true;        
    }
    
    public function editar() {
        $this->dblink->beginTransaction();
        
        try {
            $sql = "update tbDependencia "
                    . "set "
                    . "dep_Nombre ='".$this->getDescripcion()."',"              
                    . "dep_telefono ='".$this->getTelefono()."',"
                    . "dep_udi_Codigo ='".$this->getDistrito()."'"
                    . "where "
                    . "dep_Codigo = '".$this->getCodigo()."'";
            
             $sentencia =  $this->dblink->prepare($sql);
             $sentencia->execute();
            $this->dblink->commit();
            
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
                        dep_Codigo,
                        dep_Nombre,
                        dep_telefono,
                        dep_udi_Codigo
                from
                        tbdependencia
                where
                        dep_Codigo = '".$codigo."'
                ";
            $sentencia =  $this->dblink->prepare($sql) ;
            $sentencia->execute();
            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
            return $resultado;
      
        } catch (Exception $exc) {
            throw $exc;
        }            
    }
    public function eliminar() {
        try {
            $sql = "delete from tbdependencia where dep_Codigo = '".$this->getCodigo()."'";
             $sentencia =  $this->dblink->prepare($sql) ;       
             $sentencia->execute();
                                                                    
        } catch (Exception $exc) {        
                                        
            throw $exc;
        }        
        return true;
        
    }

    public function ObtenerCodigo() {
        $this->dblink->beginTransaction();
        
        try {               
                $sql = "Select dep_Codigo from tbdependencia order by dep_Codigo desc limit 1";
                
                $sentencia =  $this->dblink->prepare($sql);            
                $sentencia->execute();
                $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);

                  
                 $valor = (INTEGER)(substr($resultado["dep_codigo"], 3,3));   
                $codigo="";                                 
                $codigoss=$valor+1;
                
                if($codigoss>=0 && $codigoss <10){
                    
                    $codigo=(string)("DEP00".$codigoss);
                    
                }else if($codigoss>=10&& $codigoss <100){
                    
                    $codigo=(string)("DEP0".$codigoss);                  
                }else{
                    $codigo=(string)("DEP".$codigoss);
                }
                return $codigo;                                                 
        } catch (Exception $exc) {        
                                        
            throw $exc;
        }        
        
        
    }
    
    public function obtenerCiudades() {
        try {
            $sql = "
                    select udi_codigo, (udi_nombre||' (' || upr_nombre||')')as Ciudad from tbubigeo_distrito di
                    inner join tbubigeo_provincia pr on (di.udi_upr_codigo=pr.upr_codigo) order by udi_nombre asc
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
