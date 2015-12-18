<?php

require_once '../datos/conexion.php';
class ProgramaEstrategia  extends Conexion{
    private $codigo;
    private $tipo;    
    private $titulo;
    private $ambito;
    private $descripcion;
    private $monto;
    private $eje;
    private $sector;
    
    function getCodigo() {
        return $this->codigo;
    }

    function getTipo() {
        return $this->tipo;
    }

    function getTitulo() {
        return $this->titulo;
    }

    function getAmbito() {
        return $this->ambito;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getMonto() {
        return $this->monto;
    }

    function getEje() {
        return $this->eje;
    }

    function getSector() {
        return $this->sector;
    }

    function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    function setAmbito($ambito) {
        $this->ambito = $ambito;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setMonto($monto) {
        $this->monto = $monto;
    }

    function setEje($eje) {
        $this->eje = $eje;
    }

    function setSector($sector) {
        $this->sector = $sector;
    }
 
    function listar(){
        try {
            $sql="select * from  tbprograma_estrategia pes 
                    inner join tbejeestrategico  eje on (pes.pes_eje_codigo = eje.eje_codigo)
                    inner join tbtipo_sector tse on (pes.pes_tse_codigo=tse.tse_codigo)";
            
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
                
                $sql = "select fn_insertarprogramaestrategia( '".$this->getTipo()."',"
                        ."'".$this->getTitulo()."',"
                        ."'".$this->getAmbito()."',"
                        ."'".$this->getDescripcion()."',"
                        ."'".$this->getMonto()."',"
                        ."'".$this->getEje()."',"
                        ."'".$this->getSector()."')";
                
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
            $sql = "select fn_modificarprogramaestrategia('".$this->getCodigo()."','".$this->getTipo()."',"
                        ."'".$this->getTitulo()."',"
                        ."'".$this->getAmbito()."',"
                        ."'".$this->getDescripcion()."',"
                        ."'".$this->getMonto()."',"
                        ."'".$this->getEje()."',"
                        ."'".$this->getSector()."')";
          
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
                        pes_codigo,
                        pes_tipo,
                        pes_titulo,
                        pes_ambito,
                        pes_descripcion,
                        pes_monto,
                        pes_eje_codigo,
                        pes_tse_codigo
                from
                        tbprograma_estrategia
                where
                        pes_codigo = '".$codigo."'
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
            $sql = "delete from tbprograma_estrategia where pes_codigo = '".$this->getCodigo()."'";
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
                $sql = "Select pes_codigo from tbprograma_estrategia order by pes_codigo desc limit 1";
                
                $sentencia =  $this->dblink->prepare($sql);            
                $sentencia->execute();
                $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);

                  
                 $valor = (INTEGER)(substr($resultado["pes_codigo"], 3,3));   
                $codigo="";                                 
                $codigoss=$valor+1;
                
                if($codigoss>=0 && $codigoss <10){
                    
                    $codigo=(string)("PES00".$codigoss);
                    
                }else if($codigoss>=10&& $codigoss <100){
                    
                    $codigo=(string)("PES0".$codigoss);                  
                }else{
                    $codigo=(string)("PES".$codigoss);
                }
                $array=array('state'=>1,'resultado'=>$codigo);
            return $array;                                               
        } catch (Exception $exc) {        
                                        
            throw $exc;
        }        
        
        
    }
    
     public function obtenerEjeEstrategico() {
        try {
            $sql = "
                    select eje_codigo, eje_nombre from tbejeestrategico order by eje_nombre asc
                    ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(); 
            
            return $resultado;
         
        } catch (Exception $exc) {
            throw $exc;
        }
    }
    
    public function obtenerTipoSector() {
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