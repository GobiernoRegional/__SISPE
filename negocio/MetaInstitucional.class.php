<?php

require_once '../datos/conexion.php';
class MetaInstitucional  extends Conexion{
    private $codigo;
    private $meta;
    private $me2015;
    private $me2016;
    private $me2017;
    private $me2018;
    private $indicador;

    function getCodigo() {
        return $this->codigo;
    }

    function getMeta() {
        return $this->meta;
    }

    function getMe2015() {
        return $this->me2015;
    }

    function getMe2016() {
        return $this->me2016;
    }

    function getMe2017() {
        return $this->me2017;
    }

    function getMe2018() {
        return $this->me2018;
    }

    function getIndicador() {
        return $this->indicador;
    }

    function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    function setMeta($meta) {
        $this->meta = $meta;
    }

    function setMe2015($me2015) {
        $this->me2015 = $me2015;
    }

    function setMe2016($me2016) {
        $this->me2016 = $me2016;
    }

    function setMe2017($me2017) {
        $this->me2017 = $me2017;
    }

    function setMe2018($me2018) {
        $this->me2018 = $me2018;
    }

    function setIndicador($indicador) {
        $this->indicador = $indicador;
    }

        function listar (){
        
        try{
            $sql="SELECT * FROM tbmetains ime inner join tbindicadorInstitucional iin on (ime.ime_iin_codigo=iin.iin_codigo);";
            
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
                
                  $sql = "select fn_insertarmetains('".$this->getMeta()."','".$this->getMe2015()."','".$this->getMe2016()."','"
                          .$this->getMe2017()."','".$this->getMe2018()."','".$this->getIndicador()."')";
                
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
            $sql = "select fn_modificarmetains('".$this->getCodigo()."','".$this->getMeta()."','".$this->getMe2015()."','".$this->getMe2016()."','"
                          .$this->getMe2017()."','".$this->getMe2018()."','".$this->getIndicador()."')";
          
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
                SELECT 
                
                    ime_meta,
                    ime_2015,
                    ime_2016,
                    ime_2017,
                    ime_2018, 
                    ime_iin_codigo
                    
                FROM tbmetains
                where
                        ime_codigo = '".$codigo."'
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
            $sql = "delete from tbmetains where ime_codigo = '".$this->getCodigo()."'";
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
                $sql = "Select ime_codigo from tbmetains order by ime_codigo desc limit 1";
                
                $sentencia =  $this->dblink->prepare($sql);            
                $sentencia->execute();
                $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);

                  
                 $valor = (INTEGER)(substr($resultado["ime_codigo"], 3,3));   
                $codigo="";                                 
                $codigoss=$valor+1;
                
                if($codigoss>=0 && $codigoss <10){
                    
                    $codigo=(string)("IME00".$codigoss);
                    
                }else if($codigoss>=10&& $codigoss <100){
                    
                    $codigo=(string)("IME0".$codigoss);                  
                }else{
                    $codigo=(string)("IME".$codigoss);
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
                   Select iin_codigo,iin_nombre from tbindicadorinstitucional order by iin_nombre
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