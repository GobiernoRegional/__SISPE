<?php

require_once '../datos/conexion.php';
class TipoSector  extends Conexion{
    private $codigo;
    private $nombre;    
    private $politica;
    private $estrategia;
    private $objetivo;
    private $eje;
    
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

    function getPolitica() {
        return $this->politica;
    }

    function getEstrategia() {
        return $this->estrategia;
    }

    function getObjetivo() {
        return $this->objetivo;
    }

    function getEje() {
        return $this->eje;
    }

    function setPolitica($politica) {
        $this->politica = $politica;
    }

    function setEstrategia($estrategia) {
        $this->estrategia = $estrategia;
    }

    function setObjetivo($objetivo) {
        $this->objetivo = $objetivo;
    }

    function setEje($eje) {
        $this->eje = $eje;
    }

    

    function listar(){
        try {
            $sql="
                select tse_codigo,eje_nombre,oes_nombre,tse_nombre,est_descripcion,pol_descripcion 
                from tbtipo_sector sec
                inner join tbobjetivo_especifico  oes 	on (sec.tse_oes_codigo = oes.oes_codigo) 
                inner join tbejeestrategico eje 	on (sec.tse_eje_codigo = eje.eje_codigo)
                inner join tbestrategia est 		on (sec.tse_est_codigo = est.est_codigo)
                inner join tbpolitica pol 		on (sec.tse_pol_codigo = pol.pol_codigo)";
            
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
                
                $sql = "select fn_sectorinsertar('".$this->getNombre()."','".$this->getPolitica()."',"
                    . "'".$this->getEstrategia()."','".$this->getObjetivo()."',"
                    . "'".$this->getEje()."')";
                
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
             $sql = "select fn_sectormodificar('".$this->getCodigo()."','".$this->getNombre()."','".$this->getPolitica()."',"
                    . "'".$this->getEstrategia()."','".$this->getObjetivo()."',"
                    . "'".$this->getEje()."')";
          
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
                        tse_codigo ,
                        tse_nombre ,
                        tse_pol_codigo,
                        tse_est_codigo ,
                        tse_oes_codigo ,
                        tse_eje_codigo 
                from
                        tbtipo_sector
                where
                        tse_codigo = '".$codigo."'
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
            $sql = "delete from tbtipo_sector where tse_codigo = '".$this->getCodigo()."'";
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
                $sql = "Select tse_codigo from tbtipo_sector order by tse_codigo desc limit 1";
                
                $sentencia =  $this->dblink->prepare($sql);            
                $sentencia->execute();
                $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);

                  
                 $valor = (INTEGER)(substr($resultado["var_codigo"], 3,3));   
                $codigo="";                                 
                $codigoss=$valor+1;
                
                if($codigoss>=0 && $codigoss <10){
                    
                    $codigo=(string)("TSE00".$codigoss);
                    
                }else if($codigoss>=10&& $codigoss <100){
                    
                    $codigo=(string)("TSE0".$codigoss);                  
                }else{
                    $codigo=(string)("TSE".$codigoss);
                }
                $array=array('state'=>1,'resultado'=>$codigo);
            return $array;                                               
        } catch (Exception $exc) {        
                                        
            throw $exc;
        }        
        
        
    }
    
    public function obtenerEje() {
        try {
            $sql = "
                   Select eje_codigo,eje_nombre from tbejeestrategico order by eje_nombre
                    ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(); 
            
            return $resultado;
         
        } catch (Exception $exc) {
            throw $exc;
        }
    }
    
    public function obtenerPolitica() {
        try {
            $sql = "
                   Select pol_codigo,pol_descripcion from tbpolitica order by pol_descripcion
                    ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(); 
            
            return $resultado;
         
        } catch (Exception $exc) {
            throw $exc;
        }
    }
    
    public function obtenerEstrategia() {
        try {
            $sql = "
                   Select est_codigo,est_descripcion from tbestrategia order by est_nombre
                    ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(); 
            
            return $resultado;
         
        } catch (Exception $exc) {
            throw $exc;
        }
    }
    
    public function obtenerObjetivo() {
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