<?php

require_once '../datos/conexion.php';
class Meta  extends Conexion{
    private $codigo;
    private $año;
    private  $ind_codigo;
    private $valor;

    function getCodigo() {
        return $this->codigo;
    }

    function getAño() {
        return $this->año;
    }

    function getInd_codigo() {
        return $this->ind_codigo;
    }

    function getValor() {
        return $this->valor;
    }

    function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    function setAño($año) {
        $this->año = $año;
    }

    function setInd_codigo($ind_codigo) {
        $this->ind_codigo = $ind_codigo;
    }

    function setValor($valor) {
        $this->valor = $valor;
    }
    
    function listar (){
        
        try{
            $sql="select * from tbmeta met "
                . "inner join tbindicador ind on (met.met_ind_codigo=ind.ind_codigo)";
            
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
                
                  $sql = "select fn_metainsertar('".$this->getAño()."','".$this->getInd_codigo()."',"
                    . "'".$this->getValor()."')";
                
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
            $sql = "select fn_metamodificar('".$this->getCodigo()."','".$this->getAño()."','".$this->getInd_codigo()."','".$this->getValor()."')";
          
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
                        met_codigo ,
                        met_año ,
                        met_ind_codigo,
                        met_valor 
                from
                        tbmeta
                where
                        met_codigo = '".$codigo."'
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
            $sql = "delete from tbmeta where met_codigo = '".$this->getCodigo()."'";
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
                $sql = "Select met_codigo from tbmeta order by met_codigo desc limit 1";
                
                $sentencia =  $this->dblink->prepare($sql);            
                $sentencia->execute();
                $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);

                  
                 $valor = (INTEGER)(substr($resultado["met_codigo"], 3,3));   
                $codigo="";                                 
                $codigoss=$valor+1;
                
                if($codigoss>=0 && $codigoss <10){
                    
                    $codigo=(string)("MET00".$codigoss);
                    
                }else if($codigoss>=10&& $codigoss <100){
                    
                    $codigo=(string)("MET0".$codigoss);                  
                }else{
                    $codigo=(string)("MET".$codigoss);
                }
                $array=array('state'=>1,'resultado'=>$codigo);
            return $array;                                               
        } catch (Exception $exc) {        
                                        
            throw $exc;
        }        
        
        
    }
    public function obtenerIndicador() {
        try {
            $sql = "
                   Select ind_codigo,ind_nombre from tbindicador order by ind_nombre
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