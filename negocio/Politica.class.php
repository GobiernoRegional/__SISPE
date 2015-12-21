<?php

require_once '../datos/conexion.php';
class PoliticaR  extends Conexion{
    private $codigo;
    private $descripcion;
    private $sector;
    
    function getSector() {
        return $this->sector;
    }

    function setSector($sector) {
        $this->sector = $sector;
    }
    
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
            $sql="select * from tbpolitica inner join tbtipo_sector
                    on tbpolitica.pol_sec_codigo=tbtipo_sector.tse_codigo
                   order by pol_codigo ";
           
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
                            
               $sql = "select fn_politicainsertar('".$this->getDescripcion()."','".$this->getSector()."')";
                
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
            $sql = "select fn_politicamodificar('".$this->getCodigo()."','".$this->getDescripcion()."','".$this->getSector()."')";                           
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
                        pol_codigo,
                        pol_descripcion,
                        pol_sec_codigo
                from
                        tbpolitica                         
                where
                        pol_codigo = '".$codigo."'
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
            $sql = "delete from tbpolitica where pol_codigo = '".$this->getCodigo()."'";
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
    
    public function obtenerSector() {
        try {
            $sql = "
                    select tse_codigo, tse_nombre from tbtipo_sector order by tse_nombre asc
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