<?php

require_once '../datos/conexion.php';
class IndicadorNacional  extends Conexion{
    private $codigo;
    private $nombre;    
    private $formula;
    private $fuente;
    private $lineabase;
    private $tendencia;
    private $meta21;
    private $objEspNacional;

    function getCodigo() {
        return $this->codigo;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getFormula() {
        return $this->formula;
    }

    function getFuente() {
        return $this->fuente;
    }

    function getLineabase() {
        return $this->lineabase;
    }

    function getTendencia() {
        return $this->tendencia;
    }

    function getMeta21() {
        return $this->meta21;
    }

    function getObjEspNacional() {
        return $this->objEspNacional;
    }

    function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setFormula($formula) {
        $this->formula = $formula;
    }

    function setFuente($fuente) {
        $this->fuente = $fuente;
    }

    function setLineabase($lineabase) {
        $this->lineabase = $lineabase;
    }

    function setTendencia($tendencia) {
        $this->tendencia = $tendencia;
    }

    function setMeta21($meta21) {
        $this->meta21 = $meta21;
    }

    function setObjEspNacional($objEspNacional) {
        $this->objEspNacional = $objEspNacional;
    }

        function listar(){
        try {
            $sql="
                select *
                from tbindicador_nacional indn
                inner join tbobjetivo_especificonacional  oen on (indn.indn_objetivoespecificonacional = oen.oen_codigo)";
            
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
                
                $sql = "select fn_insertarIndicadorNacional('".$this->getNombre()."','".$this->getFormula()."','".$this->getFuente()."',"
                    . "'".$this->getLineabase()."','".$this->getTendencia()."','".$this->getMeta21()."','".$this->getObjEspNacional()."')";
                
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
             $sql = "select fn_indicadorNacionalmodificar('".$this->getCodigo()."','".$this->getNombre()."','".$this->getFormula()."','".$this->getFuente()."',"
                    . "'".$this->getLineabase()."','".$this->getTendencia()."','".$this->getMeta21()."','".$this->getObjEspNacional()."')";
          
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
                        indn_codigo      ,                        
                        indn_nombre   	,
			indn_formula 	,
			indn_fuente	,
			indn_lineabase  ,
			indn_tendencia,
			indn_meta21    ,
			indn_objetivoespecificonacional 
                from
                        tbindicador_nacional
                where
                        indn_codigo = '".$codigo."'
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
            $sql = "delete from tbindicador_nacional where indn_codigo = '".$this->getCodigo()."'";
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
                $sql = "Select indn_codigo from tbindicador_nacional order by indn_codigo desc limit 1";
                
                $sentencia =  $this->dblink->prepare($sql);            
                $sentencia->execute();
                $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);

                  
                 $valor = (INTEGER)(substr($resultado["ind_codigo"], 3,3));   
                $codigo="";                                 
                $codigoss=$valor+1;
                
                if($codigoss>=0 && $codigoss <10){
                    
                    $codigo=(string)("INN00".$codigoss);
                    
                }else if($codigoss>=10&& $codigoss <100){
                    
                    $codigo=(string)("INN0".$codigoss);                  
                }else{
                    $codigo=(string)("INN".$codigoss);
                }
                $array=array('state'=>1,'resultado'=>$codigo);
            return $array;                                               
        } catch (Exception $exc) {        
                                        
            throw $exc;
        }        
             
    }
    
    public function obtenerObjetivoEstNacional() {
        try {
            $sql = "
                   Select oen_codigo,oen_nombre from tbobjetivo_especificonacional order by oen_nombre
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