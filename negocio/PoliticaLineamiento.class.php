<?php

require_once '../datos/conexion.php';
class PoliticaLineamiento  extends Conexion{
    private $codigo;
    private $nombre;
    private $descripcion;
    private $eje;
    
    function getNombre() {
     return $this->nombre;
    }

    function getEje() {
     return $this->eje;
    }

    function setNombre($nombre) {
     $this->nombre = $nombre;
    }

    function setEje($eje) {
     $this->eje = $eje;
    }

    function getDescripcion() {
     return $this->descripcion;
    }

    function setDescripcion($descripcion) {
     $this->descripcion = $descripcion;
    }

    function getCodigo() {
        return $this->codigo;
    }


    function setCodigo($codigo) {
        $this->codigo = $codigo;
    }


        
    function listar(){
        
        try {
            $sql="select * from tbpolitica_liniamiento pli inner join tbejeestrategico eje on 
                (pli.pli_eje_codigo=eje.eje_codigo) order by pli_codigo asc ";
           
            $sentecia = $this->dblink->prepare($sql)OR DIE ("No se pudo Leer Estos Registro");
            $sentecia->execute();
            $registros = $sentecia->fetchAll();
            
            $array=array('state'=>1,'resultado'=>$registros);
            return $array;
        } catch (Exception $exc) {
            echo $exc;
        }
    }
    
    public function agregar() {
        $this->dblink->beginTransaction();
        
        try {  
                            
               $sql = "select fn_politicalineamientoinsertar('".$this->getNombre()."','".$this->getDescripcion()."','".$this->getEje()."')";
                
                $sentencia = $this->dblink->prepare($sql);
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
            $sql = "select fn_politicalineamientoinsertarmodificar('".$this->getCodigo()."','".$this->getNombre()."','".$this->getDescripcion()."','".$this->getEje()."')";                             
            $sentencia = $this->dblink->prepare($sql)OR DIE ("No se pudo Modificar Este Registro");
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
                        pli_Codigo,
                        pli_nombre,
                        pli_descripcion,
                        pli_eje_codigo
                from
                        tbpolitica_liniamiento
                where
                        pli_Codigo = '".$codigo."'
                ";
            $sentecia = $this->dblink->prepare($sql) OR DIE ("No se pudo leer estos Registro");
            $sentecia->execute();
            $resultado = $sentecia->fetch(PDO::FETCH_ASSOC);
            
            $array=array('state'=>1,'resultado'=>$resultado);
            return $array;
        } catch (Exception $exc) {
            throw $exc;
        }            
    }
    public function eliminar() {
        try {
            $sql = "select fn_politicalineamientoeliminar('".$this->getCodigo()."')";
            $sentencia = $this->dblink->prepare($sql) OR DIE ("No se pudo borrar Este Registro");
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
                $sql = "Select pli_codigo from tbpolitica_liniamiento order by pli_codigo desc limit 1";
                
                $sentencia =  $this->dblink->prepare($sql);            
                $sentencia->execute();
                $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);

                  
                 $valor = (INTEGER)(substr($resultado["plI_codigo"], 3,3));   
                $codigo="";                                 
                $codigoss=$valor+1;
                
                if($codigoss>=0 && $codigoss <10){
                    
                    $codigo=(string)("PLI00".$codigoss);
                    
                }else if($codigoss>=10&& $codigoss <100){
                    
                    $codigo=(string)("PLI0".$codigoss);                  
                }else{
                    $codigo=(string)("PLI".$codigoss);
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

}