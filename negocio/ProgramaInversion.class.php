<?php

require_once '../datos/conexion.php';
class ProgramaInversion  extends Conexion{
    private $codigo;
    private $nestudio;    
    private $pestrategia;
    private $ubicacion;  
    
    function getCodigo() {
        return $this->codigo;
    }

    function getNestudio() {
        return $this->nestudio;
    }

    function getPestrategia() {
        return $this->pestrategia;
    }

    function getUbicacion() {
        return $this->ubicacion;
    }

    function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    function setNestudio($nestudio) {
        $this->nestudio = $nestudio;
    }

    function setPestrategia($pestrategia) {
        $this->pestrategia = $pestrategia;
    }

    function setUbicacion($ubicacion) {
        $this->ubicacion = $ubicacion;
    }

        
    function listar(){
        try {
            $sql="select * from  tbprograma_inversion pin 
                    inner join tbprograma_estrategia  pes on (pin.pin_npe_codigo = pes.pes_codigo)
                    inner join tbubigeo_distrito udi on (pin.pin_udi_codigo=udi.udi_codigo)";
            
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
                
                $sql = "select fn_insertarprogramainversion( '".$this->getNestudio()."',"
                        ."'".$this->getPestrategia()."',"
                        ."'".$this->getUbicacion()."')";
                
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
            $sql = "select fn_modificarprogramainversion('".$this->getCodigo()."','".$this->getNestudio()."',"
                        ."'".$this->getPestrategia()."',"
                        ."'".$this->getUbicacion()."')";
          
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
                        pin_codigo,
                        pin_nestudio,
                        pin_npe_codigo,
                        pin_udi_codigo
                from
                        tbprograma_inversion
                where
                        pin_codigo = '".$codigo."'
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
            $sql = "delete from tbprograma_inversion where pin_codigo = '".$this->getCodigo()."'";
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
                $sql = "Select pin_codigo from tbprograma_inversion order by pin_codigo desc limit 1";
                
                $sentencia =  $this->dblink->prepare($sql);            
                $sentencia->execute();
                $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);

                  
                 $valor = (INTEGER)(substr($resultado["pin_codigo"], 3,3));   
                $codigo="";                                 
                $codigoss=$valor+1;
                
                if($codigoss>=0 && $codigoss <10){
                    
                    $codigo=(string)("PIN00".$codigoss);
                    
                }else if($codigoss>=10&& $codigoss <100){
                    
                    $codigo=(string)("PIN0".$codigoss);                  
                }else{
                    $codigo=(string)("PIN".$codigoss);
                }
                $array=array('state'=>1,'resultado'=>$codigo);
            return $array;                                               
        } catch (Exception $exc) {        
                                        
            throw $exc;
        }               
    }
    
     public function obtenerProgramaEstrategia() {
        try {
            $sql = "
                    select pes_codigo, pes_titulo from tbprograma_estrategia order by pes_titulo asc
                    ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(); 
            
            return $resultado;
         
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