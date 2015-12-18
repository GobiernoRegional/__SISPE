<?php

require_once '../datos/conexion.php';
class Inversion  extends Conexion{
    private $codigo;
    private $ano;    
    private $sector;
    private $monto;
    private $total;
    private $porcentaje;
    
    function getCodigo() {
     return $this->codigo;
    }

  
    function getSector() {
     return $this->sector;
    }
  
    function setCodigo($codigo) {
     $this->codigo = $codigo;
    }

    
    function setSector($sector) {
     $this->sector = $sector;
    }
    
    function getAno() {
        return $this->ano;
    }

    function getMonto() {
        return $this->monto;
    }

    function getTotal() {
        return $this->total;
    }

    function getPorcentaje() {
        return $this->porcentaje;
    }

    function setAno($ano) {
        $this->ano = $ano;
    }

    function setMonto($monto) {
        $this->monto = $monto;
    }

    function setTotal($total) {
        $this->total = $total;
    }

    function setPorcentaje($porcentaje) {
        $this->porcentaje = $porcentaje;
    }

      

    function listar(){
        try {
            $sql="select * from  tbinversion inv "
                . "inner join tbtipo_sector  tse on (inv.inv_tse_codigo = tse.tse_codigo)";
            
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
                
                $sql = "select fn_inversioninsertar('".$this->getAno()."',".$this->getMonto().",".$this->getTotal().",".$this->getPorcentaje().",'".$this->getSector()."')";
                
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
             $sql = "select fn_inversionmodificar('".$this->getCodigo()."','".$this->getAno()."',".$this->getMonto().",".$this->getTotal().",".$this->getPorcentaje().",'".$this->getSector()."')";
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
                        
                        inv_codigo,
                        inv_ano   	,
			inv_monto 	,
			inv_total 	,
			inv_porcentaje	,
			inv_tse_codigo 	
                from
                        tbinversion
                where
                        inv_codigo = '".$codigo."'
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
            $sql = "delete from tbinversion where inv_codigo = '".$this->getCodigo()."'";
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
                $sql = "Select inv_codigo from tbinversion order by inv_codigo desc limit 1";
                
                $sentencia =  $this->dblink->prepare($sql);            
                $sentencia->execute();
                $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);

                  
                 $valor = (INTEGER)(substr($resultado["inv_codigo"], 3,3));   
                $codigo="";                                 
                $codigoss=$valor+1;
                
                if($codigoss>=0 && $codigoss <10){
                    
                    $codigo=(string)("INV00".$codigoss);
                    
                }else if($codigoss>=10&& $codigoss <100){
                    
                    $codigo=(string)("INV0".$codigoss);                  
                }else{
                    $codigo=(string)("INV".$codigoss);
                }
                $array=array('state'=>1,'resultado'=>$codigo);
            return $array;                                               
        } catch (Exception $exc) {        
                                        
            throw $exc;
        }        
        
        
    }
    
    public function obtenerTipoSector() {
        try {
            $sql = "
                   Select tse_codigo,tse_nombre from tbtipo_sector order by tse_nombre
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