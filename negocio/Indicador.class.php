<?php

require_once '../datos/conexion.php';
class Indicador  extends Conexion{
    private $codigo;
    private $nombre;    
    private $medida;
    private $fuente;
    private $variable;
    private $cantidad;
    private $ano;
    private $formula;
    private $tendencia;
    private $linea;
    private $objEstNacional;
    private $intencion;
    private $frecuencia;
    private $periodo;
    
    function getCodigo() {
     return $this->codigo;
    }

    function getNombre() {
     return $this->nombre;
    }

   
    function setCodigo($codigo) {
     $this->codigo = $codigo;
    }

    function setNombre($nombre) {
     $this->nombre = $nombre;
    }

    function getMedida() {
        return $this->medida;
    }

    function getFuente() {
        return $this->fuente;
    }

    function getVariable() {
        return $this->variable;
    }

    function getCantidad() {
        return $this->cantidad;
    }

    function getAno() {
        return $this->ano;
    }

    function getFormula() {
        return $this->formula;
    }

    function getTendencia() {
        return $this->tendencia;
    }

    function getLinea() {
        return $this->linea;
    }

    function getObjEstNacional() {
        return $this->objEstNacional;
    }

    function getIntencion() {
        return $this->intencion;
    }

    function getFrecuencia() {
        return $this->frecuencia;
    }

    function getPeriodo() {
        return $this->periodo;
    }

    function setMedida($medida) {
        $this->medida = $medida;
    }

    function setFuente($fuente) {
        $this->fuente = $fuente;
    }

    function setVariable($variable) {
        $this->variable = $variable;
    }

    function setCantidad($cantidad) {
        $this->cantidad = $cantidad;
    }

    function setAno($ano) {
        $this->ano = $ano;
    }

    function setFormula($formula) {
        $this->formula = $formula;
    }

    function setTendencia($tendencia) {
        $this->tendencia = $tendencia;
    }

    function setLinea($linea) {
        $this->linea = $linea;
    }

    function setObjEstNacional($objEstNacional) {
        $this->objEstNacional = $objEstNacional;
    }

    function setIntencion($intencion) {
        $this->intencion = $intencion;
    }

    function setFrecuencia($frecuencia) {
        $this->frecuencia = $frecuencia;
    }

    function setPeriodo($periodo) {
        $this->periodo = $periodo;
    }

    
    

    function listar(){
        try {
            $sql="
                select *
                from tbindicador ind
                inner join tbobjetivo_especificonacional  oen 	on (ind.ind_oen_codigo = oen.oen_codigo) 
                inner join tbvariable                     var 	on (ind.ind_rva_codigo = var.var_codigo)";
            
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
                
                $sql = "select fn_insertarindicador('".$this->getNombre()."','".$this->getMedida()."','".$this->getFuente()."',"
                    . "'".$this->getVariable()."','".$this->getCantidad()."','".$this->getAno()."','".$this->getFormula()."',"
                    . " '".$this->getTendencia()."','".$this->getLinea()."','".$this->getObjEstNacional()."',"
                    . "'".$this->getIntencion()."','".$this->getFrecuencia()."','".$this->getPeriodo()."')";
                
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
             $sql = "select fn_indicadormodificar('".$this->getCodigo()."','".$this->getNombre()."','".$this->getMedida()."','".$this->getFuente()."',"
                    . "'".$this->getVariable()."','".$this->getCantidad()."','".$this->getAno()."','".$this->getFormula()."',"
                    . " '".$this->getTendencia()."','".$this->getLinea()."','".$this->getObjEstNacional()."',"
                    . "'".$this->getIntencion()."','".$this->getFrecuencia()."','".$this->getPeriodo()."')";
          
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
                        ind_codigo      ,                        
                        ind_nombre   	,
			ind_umedida 	,
			ind_fuente	,
			ind_rva_codigo  ,
			ind_basecantidad,
			ind_baseano    ,
			ind_formula     ,
			ind_tendencia   ,
			ind_linea       ,
			ind_oen_codigo ,
			ind_intencion   ,
			ind_frecuencia ,
			ind_periodo    
                from
                        tbindicador
                where
                        ind_codigo = '".$codigo."'
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
            $sql = "delete from tbindicador where ind_codigo = '".$this->getCodigo()."'";
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
                $sql = "Select ind_codigo from tbindicador order by ind_codigo desc limit 1";
                
                $sentencia =  $this->dblink->prepare($sql);            
                $sentencia->execute();
                $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);

                  
                 $valor = (INTEGER)(substr($resultado["ind_codigo"], 3,3));   
                $codigo="";                                 
                $codigoss=$valor+1;
                
                if($codigoss>=0 && $codigoss <10){
                    
                    $codigo=(string)("IND00".$codigoss);
                    
                }else if($codigoss>=10&& $codigoss <100){
                    
                    $codigo=(string)("IND0".$codigoss);                  
                }else{
                    $codigo=(string)("IND".$codigoss);
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
    
    public function obtenerVariable() {
        try {
            $sql = "
                   Select var_codigo,var_nombre from tbvariable order by var_nombre
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