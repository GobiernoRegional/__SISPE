<?php

require_once '../datos/conexion.php';
class VariableRegional  extends Conexion{
    private $codigo;
    private $nombre;    
    private $sector;
    private $objetivo;
    
    function getCodigo() {
     return $this->codigo;
    }

    function getNombre() {
     return $this->nombre;
    }

    function getSector() {
     return $this->sector;
    }

    function getObjetivo() {
     return $this->objetivo;
    }  

    function setCodigo($codigo) {
     $this->codigo = $codigo;
    }

    function setNombre($nombre) {
     $this->nombre = $nombre;
    }

    function setSector($sector) {
     $this->sector = $sector;
    }

    function setObjetivo($objetivo) {
     $this->objetivo = $objetivo;
    }

   


    function listar(){
        try {
            $sql="
                    select * from  tb_variable var 
                    inner join tbtipo_sector  tse on (var.var_cod_sector = tse.tse_codigo)
                    inner join tbobjetivo_especifico obe  on (var.var_cod_objestr = obe.oes_codigo)";
            
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
                
                $sql = "select fn_tbvariableinsertar('".$this->getNombre()."','".$this->getSector()."',"
                    . "'".$this->getObjetivo()."')";
                
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
             $sql = "select fn_tbvariablemodificar('".$this->getCodigo()."','".$this->getNombre()."','".$this->getSector()."',"
                    . "'".$this->getObjetivo()."')";
          
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
                        
                        var_codigo,
                        var_nombre,
                        var_cod_sector 	,
                        var_cod_objestr 
                from
                        tb_variable
                where
                        var_codigo = '".$codigo."'
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
            $sql = "delete from tb_variable where var_codigo = '".$this->getCodigo()."'";
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
                $sql = "Select var_codigo from tb_variable order by var_codigo desc limit 1";
                
                $sentencia =  $this->dblink->prepare($sql);            
                $sentencia->execute();
                $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);

                  
                 $valor = (INTEGER)(substr($resultado["var_codigo"], 3,3));   
                $codigo="";                                 
                $codigoss=$valor+1;
                
                if($codigoss>=0 && $codigoss <10){
                    
                    $codigo=(string)("VAR00".$codigoss);
                    
                }else if($codigoss>=10&& $codigoss <100){
                    
                    $codigo=(string)("VAR0".$codigoss);                  
                }else{
                    $codigo=(string)("VAR".$codigoss);
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
    
    public function obtenerObjetivoEstrategico() {
        try {
            $sql = "
                   Select oes_codigo,oes_nombre from tbobjetivo_especifico order by oes_nombre
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