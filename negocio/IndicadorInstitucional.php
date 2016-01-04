<?php

require_once '../datos/conexion.php';
class IndicadorInstitucional  extends Conexion{
    private $codigo;
    private $nombre;    
    private $fuente;
    private $linea;
    private $responsable;
    private $ruta;
    private $objetivo;
    
    function getCodigo() {
        return $this->codigo;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getFuente() {
        return $this->fuente;
    }

    function getLinea() {
        return $this->linea;
    }

    function getResponsable() {
        return $this->responsable;
    }

    function getRuta() {
        return $this->ruta;
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

    function setFuente($fuente) {
        $this->fuente = $fuente;
    }

    function setLinea($linea) {
        $this->linea = $linea;
    }

    function setResponsable($responsable) {
        $this->responsable = $responsable;
    }

    function setRuta($ruta) {
        $this->ruta = $ruta;
    }

    function setObjetivo($objetivo) {
        $this->objetivo = $objetivo;
    }

    
    function listar(){
        try {
            $sql="
                select *
                from tbIndicadorInstitucional iin
                inner join tbObjetivoEstrategicoInstitucional ioe
                on (iin.iin_ioe_codigo = ioe.ioe_codigo)";
            
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
                
                $sql = "select fn_insertarindicadorinst('".$this->getNombre()."','".$this->getFuente()."','"
                    . "'".$this->getLinea()."','".$this->getResponsable()."','".$this->getRuta()."','".$this->getObjetivo()."')";
                
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
             $sql = "select fn_indicadorinsmodificar('".$this->getCodigo()."','".$this->getNombre()."','".$this->getFuente()."','"
                    . "'".$this->getLinea()."','".$this->getResponsable()."','".$this->getRuta()."','".$this->getObjetivo()."')";
          
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
                        iin_codigo      ,                        
                        iin_nombre   	,
			iin_fuente	,
			iin_linea  ,
			iin_responsable,
			iin_rutaestrategica,
			iin_ioe_codigo    
                from
                        tbindicadorInstitucional
                where
                        iin_codigo = '".$codigo."'
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
            $sql = "delete from tbindicadorInstitucional where iin_codigo = '".$this->getCodigo()."'";
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
                $sql = "Select iin_codigo from tbindicadorInstitucional order by iin_codigo desc limit 1";
                
                $sentencia =  $this->dblink->prepare($sql);            
                $sentencia->execute();
                $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);

                  
                 $valor = (INTEGER)(substr($resultado["iin_codigo"], 3,3));   
                $codigo="";                                 
                $codigoss=$valor+1;
                
                if($codigoss>=0 && $codigoss <10){
                    
                    $codigo=(string)("IIN00".$codigoss);
                    
                }else if($codigoss>=10&& $codigoss <100){
                    
                    $codigo=(string)("IIN0".$codigoss);                  
                }else{
                    $codigo=(string)("IIN".$codigoss);
                }
                $array=array('state'=>1,'resultado'=>$codigo);
            return $array;                                               
        } catch (Exception $exc) {        
                                        
            throw $exc;
        }        
        
        
    }
    
    public function obtenerObjetivoEstrategico() {
        try {
            $sql = "
                   Select ioe_codigo,ioe_nombre from tbobjetivoestrategicoinstitucional order by ioe_nombre
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