<?php

require_once '../datos/conexion.php';
class Variable  extends Conexion{
    private $codigo;
    private $nombre;    
    private $sector;
    private $justificacion;
    private $unidadanalisis;
    private $resposablegestion;
    private $responsablereporte;
    
    function getCodigo() {
     return $this->codigo;
    }

    function getNombre() {
     return $this->nombre;
    }

    function getSector() {
     return $this->sector;
    }

    function getJustificacion() {
     return $this->justificacion;
    }

    function getUnidadanalisis() {
     return $this->unidadanalisis;
    }

    function getResposablegestion() {
     return $this->resposablegestion;
    }

    function getResponsablereporte() {
     return $this->responsablereporte;
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

    function setJustificacion($justificacion) {
     $this->justificacion = $justificacion;
    }

    function setUnidadanalisis($unidadanalisis) {
     $this->unidadanalisis = $unidadanalisis;
    }

    function setResposablegestion($resposablegestion) {
     $this->resposablegestion = $resposablegestion;
    }

    function setResponsablereporte($responsablereporte) {
     $this->responsablereporte = $responsablereporte;
    }


    function listar(){
        try {
            $sql="select * from  tbvariable var "
                . "inner join tbtipo_sector  tse on (var.var_tse_codigo = tse.tse_codigo)";
            
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
                
                $sql = "select fn_variableinsertar('".$this->getNombre()."','".$this->getSector()."',"
                    . "'".$this->getJustificacion()."','".$this->getUnidadanalisis()."',"
                    . "'".$this->getResposablegestion()."','".$this->getResponsablereporte()."')";
                
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
             $sql = "select fn_variablemodificar('".$this->getCodigo()."','".$this->getNombre()."','".$this->getSector()."',"
                    . "'".$this->getJustificacion()."','".$this->getUnidadanalisis()."',"
                    . "'".$this->getResposablegestion()."','".$this->getResponsablereporte()."')";
          
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
                        var_tse_codigo 	,
                        var_justificacion ,
                        var_unidadanalisis ,
                        var_resposablegestion ,
                        var_responsablereporte 
                from
                        tbvariable
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
            $sql = "delete from tbvariable where var_codigo = '".$this->getCodigo()."'";
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
                $sql = "Select var_codigo from tbvariable order by var_codigo desc limit 1";
                
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


}