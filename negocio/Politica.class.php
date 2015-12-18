<?php

require_once '../datos/conexion.php';
class PoliticaR  extends Conexion{
    private $codigo;
    private $descripcion;
    
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


        
    function listar(){
        
        try {
            $sql="select * from tbpolitica 
                   order by pol_codigo ";
           
            $sentecia = $this->dblink->prepare($sql)OR DIE ("No se pudo Leer Estos Registro");
            $sentecia->execute();
            $resultado = $sentecia->fetchAll();
            return $resultado;
        } catch (Exception $exc) {
            echo $exc;
        }
    }
    
    public function agregar() {
        $this->dblink->beginTransaction();
        
        try {  
                            
               $sql = "select fn_politicainsertar('".$this->getDescripcion()."')";
                
                $sentencia = $this->dblink->prepare($sql);
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
            $sql = "select fn_politicamodificar('".$this->getCodigo()."','".$this->getDescripcion()."')";                             
            $sentencia = $this->dblink->prepare($sql)OR DIE ("No se pudo Modificar Este Registro");
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
                        pol_codigo,
                        pol_descripcion                          
                from
                        tbpolitica                         
                where
                        pol_codigo = ".$codigo."'
                ";
            $sentecia = $this->dblink->prepare($sql) OR DIE ("No se pudo leer estos Registro");
            $sentecia->execute();
            $resultado = $sentecia->fetch(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }            
    }
    public function eliminar() {
        try {
            $sql = "delete from tbpolitica where pol_codigo = '".$this->getCodigo()."'";
            $sentencia = $this->dblink->prepare($sql) OR DIE ("No se pudo borrar Este Registro");
            $sentencia->execute();
                                                              
        } catch (Exception $exc) {        
                                        
            throw $exc;
        }        
        return true;
        
    }
     public function ObtenerCodigo() {
        $this->dblink->beginTransaction();
        
        try {               
                $sql = "Select pol_codigo from tbpolitica order by pol_codigo desc limit 1";
                
                $sentencia =  $this->dblink->prepare($sql);            
                $sentencia->execute();
                $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);

                  
                 $valor = (INTEGER)(substr($resultado["pol_codigo"], 3,3));   
                $codigo="";                                 
                $codigoss=$valor+1;
                
                if($codigoss>=0 && $codigoss <10){
                    
                    $codigo=(string)("POL00".$codigoss);
                    
                }else if($codigoss>=10&& $codigoss <100){
                    
                    $codigo=(string)("POL0".$codigoss);                  
                }else{
                    $codigo=(string)("POL".$codigoss);
                }
                $array=array('state'=>1,'resultado'=>$codigo);
            return $array;                                               
        } catch (Exception $exc) {        
                                        
            throw $exc;
        }        
        
        
    }
    
    public function obtenerSubcapitulos() {
        try {
            $sql = "
                    select sub_codigo, sub_nombre from tbsubcapitulos order by sub_nombre asc
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