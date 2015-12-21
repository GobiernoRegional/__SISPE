<?php
require_once '../Datos/conexion.php';

class Perfil extends Conexion{
    public $nom_Correo;
    public $numeroTelefono;
    public $direcion;
    public $dni;
    
    function getDirecion() {
     return $this->direcion;
    }

    function getDni() {
     return $this->dni;
    }

    function setDirecion($direcion) {
     $this->direcion = $direcion;
    }

    function setDni($dni) {
     $this->dni = $dni;
    }

   
    function getNom_Correo() {
     return $this->nom_Correo;
    }

    function getNumeroTelefono() {
     return $this->numeroTelefono;
    }

    function setNom_Correo($nom_Correo) {
     $this->nom_Correo = $nom_Correo;
    }

    function setNumeroTelefono($numeroTelefono) {
     $this->numeroTelefono = $numeroTelefono;
    }

    
    function listar($dni){
        try {
            $sql="select * from tbpersonal where per_dni = '$dni' order by per_codigo asc";
            
            $sentencia =  $this->dblink->prepare($sql)OR DIE ("No se pudo Leer Estos Registro");
            $sentencia->execute();
            $registros = $sentencia->fetchAll();
            $array=array('state'=>1,'resultado'=>$registros);
            return $array;
            
            } catch (Exception $exc) {
                echo $exc;
            }
    }
    
    public function editar() {
        $this->dblink->beginTransaction();
        
        try {
            $sql = "update tbpersonal "
                    . "set "                  
                    . "per_telefono ='".$this->getNumeroTelefono()."',"
                    . "per_direccion ='".$this->getDirecion()."',"
                    . "per_correo ='".$this->getNom_Correo()."'"                   
                    . "where "
                    . "per_dni = '".$this->getDni()."'";
            
            $sentencia = $this->dblink->prepare($sql)OR DIE ("No se pudo Modificar Este Registro");
            $sentencia->execute();
            $this->dblink->commit();
            
        } catch (Exception $exc) {
            $this->dblink->rollBack();
            throw $exc;
        }
        
        $array = array('state' =>1);
        return $array;       
    }
}
