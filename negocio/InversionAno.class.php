<?php

require_once '../datos/conexion.php';
class InversionAno  extends Conexion{
    private $codigo;
    private $año;
    private $monto;
    private  $pin_codigo;
    private $total;

    function getCodigo() {
        return $this->codigo;
    }

    function getAño() {
        return $this->año;
    }

    function getMonto() {
        return $this->monto;
    }

    function getPin_codigo() {
        return $this->pin_codigo;
    }

    function getTotal() {
        return $this->total;
    }

    function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    function setAño($año) {
        $this->año = $año;
    }

    function setMonto($monto) {
        $this->monto = $monto;
    }

    function setPin_codigo($pin_codigo) {
        $this->pin_codigo = $pin_codigo;
    }

    function setTotal($total) {
        $this->total = $total;
    }
    
    
    function listar (){
        
        try{
            $sql="select * from tbinversion_ano ian"
                . "inner join tbprograma_inversion pin on (ian.ian_codigo=pin.pin_codigo)";
            
            $sentencia =  $this->dblink->prepare($sql)OR DIE ("No se pudo Leer Estos Registro");
            $sentencia->execute();
            $registros = $sentencia->fetchAll();
            $array=array('state'=>1,'resultado'=>$registros);
            return $array;
            
        } catch (Exception $ex) {
            echo $exc;
        }
    }
    public function agregar(){
        
        $this->dblink->beginTransaction();
        
        try {  
                
                  $sql = "select fn_inversion_anoinsertar('".$this->getAño()."','".$this->getMonto()."',"
                    . "'".$this->getPin_codigo()."','".$this->getTotal()."')";
                
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
            $sql = "select fn_inversion_anomodificar('".$this->getCodigo()."','".$this->getAño()."','".$this->getMonto()."','".$this->getPin_codigo()."','".$this->getTotal()."')";
          
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
                        ian_codigo ,
                        ian_año ,
                        ian_monto,
                        ian_pin_codigo,
                        ian_total
                from
                        tbinversion_ano
                where
                        ian_codigo = '".$codigo."'
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
            $sql = "delete from tbinversion_ano where ian_codigo = '".$this->getCodigo()."'";
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
                $sql = "Select ian_codigo from tbinversion_ano order by ian_codigo desc limit 1";
                
                $sentencia =  $this->dblink->prepare($sql);            
                $sentencia->execute();
                $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);

                  
                 $valor = (INTEGER)(substr($resultado["ian_codigo"], 3,3));   
                $codigo="";                                 
                $codigoss=$valor+1;
                
                if($codigoss>=0 && $codigoss <10){
                    
                    $codigo=(string)("IAN00".$codigoss);
                    
                }else if($codigoss>=10&& $codigoss <100){
                    
                    $codigo=(string)("IAN0".$codigoss);                  
                }else{
                    $codigo=(string)("IAN".$codigoss);
                }
                $array=array('state'=>1,'resultado'=>$codigo);
            return $array;                                               
        } catch (Exception $exc) {        
                                        
            throw $exc;
        }        
        
        
    }
    public function obtenerProgramaInversion() {
        try {
            $sql = "
                   Select pin_codigo,pin_nestudio from tbprograma_inversion order by pin_nestudio
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

    
