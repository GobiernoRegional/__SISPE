<?php

require_once '../datos/conexion.php';

class Usuario extends Conexion {
    private $usuario;
    private $clave_antigua;
    private $clave_nueva;
    private $repeti_clave;   
    function getUsuario() {
        return $this->usuario;
    }

    function getClave_antigua() {
        return $this->clave_antigua;
    }

    function getClave_nueva() {
        return $this->clave_nueva;
    }

    function getRepeti_clave() {
        return $this->repeti_clave;
    }

    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    function setClave_antigua($clave_antigua) {
        $this->clave_antigua = $clave_antigua;
    }

    function setClave_nueva($clave_nueva) {
        $this->clave_nueva = $clave_nueva;
    }

    function setRepeti_clave($repeti_clave) {
        $this->repeti_clave = $repeti_clave;
    }

    function  listarUsuario(){
        try {
            $sql="
                Select * from tbusuario usu
                inner join tbpersonal per on 
                    (usu.usu_per_codigo=per.per_codigo)
                inner join tbusuario_permiso upe on 
                    (usu.usu_upe_codigo=upe.upe_codigo)
                  ";
            $sentecia = $this->dblink->query($sql)OR DIE ("No se pudo Leer Estos Registro");
            $resultado = $sentecia->fetchAll();
            return $resultado;
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
        
    }
    
    public function ModificarClaveUsuario() {
        
        $this->dblink->beginTransaction();
        try {
            $sql=" 
                update 
                    tbusuario
                set 
                    usu_clave=md5(:clv_nueva)
                where
                    upper(usu_nombre)=upper(:usu) and 
                    usu_clave=md5(:clv_antigua)           
                ";
            
            $sentencia = $this->dblink->prepare($sql)OR DIE ("No se pudo Modificar el Registro");
            $sentencia->bindParam(":usu", $this->getUsuario());
            $sentencia->bindParam(":clv_antigua", $this->getClave_antigua());
            $sentencia->bindParam(":clv_nueva", $this->getClave_nueva());
            $sentencia->execute();
            $this->dblink->commit();
            $array=array('state'=>true);
            
            return $array;
        } catch (Exception $exc) {
            echo $exc->getMessage();
           
        }
         return true;
    }
        
    public function leerDatos($codigo) {
        try {
            $sql = "
                select                        
                        usu_codigo,
                        usu_clave,
                        usu_nombre,
                        usu_per_codigo,
                        usu_estado,
                        usu_upe_codigo,
                        usu_tipo
                from
                        tbusuario                         
                where
                        usu_Codigo = '".$codigo."'
                ";
            $sentecia = $this->dblink->prepare($sql) OR DIE ("No se pudo leer estos Registro");
            $sentecia->execute();
            $resultado = $sentecia->fetch(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }            
    } 
    
    public function obtenerPersonal() {
         try {
            $sql = "select per_codigo, per_apellido from tbpersonal order by per_apellido asc";            
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll();
            
            return $resultado;
         
        } catch (Exception $exc) {
            throw $exc;
        }
    }
    
}
