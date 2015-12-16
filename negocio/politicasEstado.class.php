<?php

require_once '../datos/conexion.php';
class Politica  extends Conexion{
    private $codigo;
    private $tpolitica;
    private $nombre;
    
    function getCodigo() {
        return $this->codigo;
    }

    function getTpolitica() {
        return $this->tpolitica;
    }

    function getNombre() {
        return $this->nombre;
    }

    function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    function setTpolitica($tpolitica) {
        $this->tpolitica = $tpolitica;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

        
    function listar(){
        
        try {
            $sql="select * from tbpdn_pestado 
                   order by pes_codigo ";
           
            $sentecia = $this->dblink->prepare($sql)OR DIE ("No se pudo Leer Estos Registro");
            $sentecia->execute();
            $resultado = $sentecia->fetchAll();
            return $resultado;
        } catch (Exception $exc) {
            echo $exc;
        }
    }
    
    public function agregar() {
        $this->dblink->beginTransaction();
        
        try {  
                            
               $sql = "select fn_insertarpolitica('".$this->getTpolitica()."','".$this->getNombre()."')";
                
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->execute();
                $this->dblink->commit();                                  
            
        } catch (Exception $exc) {
            $this->dblink->rollBack();
            throw $exc;
        }
        
        return true;        
    }
    
    public function editar() {
        $this->dblink->beginTransaction();
        
        try {
          $sql = "update tbpdn_pestado  "
                    . "set "
                    . "pes_tpolitica ='".$this->getTpolitica()."',"                  
                    . "pes_nombre ='".$this->getNombre()."'"
                    . "where "
                    . "pes_codigo = '".$this->getCodigo()."'";
          
            $sentencia = $this->dblink->prepare($sql)OR DIE ("No se pudo Modificar Este Registro");
            $sentencia->execute();
            $this->dblink->commit();
            
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
                        pes_tpolitica,
                        pes_nombre                        
                from
                        tbpdn_pestado                         
                where
                        pes_codigo = ".$codigo."'
                ";
            $sentecia = $this->dblink->prepare($sql) OR DIE ("No se pudo leer estos Registro");
            $sentecia->execute();
            $resultado = $sentecia->fetch(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }            
    }
    public function eliminar() {
        try {
            $sql = "delete from tbpdn_pestado where pes_codigo = '".$this->getCodigo()."'";
            $sentencia = $this->dblink->prepare($sql) OR DIE ("No se pudo borrar Este Registro");
            $sentencia->execute();
                                                              
        } catch (Exception $exc) {        
                                        
            throw $exc;
        }        
        return true;
        
    }

}