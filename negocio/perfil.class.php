<?php
require_once '../Datos/conexion.php';

class perfil extends Conexion{
    public $codCorreo;
    public $codTelefono;
    public $nom_Correo;
    public $numeroTelefono;
    Public $tipoTelefono;
    Public $Operadora;
    function getCodCorreo() {
        return $this->codCorreo;
    }

    function getCodTelefono() {
        return $this->codTelefono;
    }

    function getNom_Correo() {
        return $this->nom_Correo;
    }

    function getNumeroTelefono() {
        return $this->numeroTelefono;
    }

    function getTipoTelefono() {
        return $this->tipoTelefono;
    }

    function getOperadora() {
        return $this->Operadora;
    }

    function setCodCorreo($codCorreo) {
        $this->codCorreo = $codCorreo;
    }

    function setCodTelefono($codTelefono) {
        $this->codTelefono = $codTelefono;
    }

    function setNom_Correo($nom_Correo) {
        $this->nom_Correo = $nom_Correo;
    }

    function setNumeroTelefono($numeroTelefono) {
        $this->numeroTelefono = $numeroTelefono;
    }

    function setTipoTelefono($tipoTelefono) {
        $this->tipoTelefono = $tipoTelefono;
    }

    function setOperadora($Operadora) {
        $this->Operadora = $Operadora;
    }

        public function obetenerPerfil($nombreUsuario) {
        try {
            $sql="
                 select 
                    per_nombre,
                    per_apellido,
                    per_dni,
                    per_telefono,
                    per_correo,
                    ins_nombre
                from  
                    tbusuario u
                    inner join tbpersonal p on (u.usu_per_Codigo=p.per_Codigo)
                    inner join tbinstitucion a on(p.per_ins_Codigo=a.ins_Codigo)
                where
                usu_nombre= UPPER(:usu)
                    ";
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->bindParam(":usu", $nombreUsuario);
                $sentencia->execute();
                $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
                return $resultado;
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }
    
    public function obtenerTelefonos($usuario){
        try {
            $sql="
                select
                    cte_codigo,
                    cte_numero
                from  
                    tbusuario u
                    inner join tbpersonal p on (u.usu_per_Codigo=p.per_Codigo)
                    inner join tbcontacto_telefono t on (t.per_Codigo=p.per_Codigo)
                where
                usu_nombre= UPPER(:usu)
                    ";
                $sentencia = $this->dblink->prepare($sql);
                 $sentencia->bindParam(":usu", $usuario);
                $resultado = $sentencia->fetch();
                return $resultado;
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }
    
    public function obtenerCorreos($usuario){
        try {
            $sql="
                select
                    pem_codigo,
                    pem_email
                from  
                    tbusuario u
                    inner join tbpersonal p on (u.usu_per_Codigo=p.per_Codigo)
                    inner join tbpersonal_email e on (e.pem_per_codigo=p.per_Codigo)
                where
                usu_nombre='".$usuario."'
                    ";
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->execute();
                $resultado = $sentencia->fetch();
                return $resultado;
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }
    
    public function EditarCorreos(){
        
        $this->dblink->beginTransaction();
        try {
            
            $sql = "update tbpersonal_email "
                    . "set "
                    . "pem_Email = '".$this->getNom_Correo()."' "
                    . "where "
                    . "pem_Codigo = '".$this->getCodCorreo()."'";
            
            $sentencia = $this->dblink->prepare($sql);
            $this->dblink->commit();
            
        } catch (Exception $exc) {
            $this->dblink->rollBack();
            throw $exc;
        }
        
        return true;
        
    }    
    
    public function EditarTeléfonos(){
        $this->dblink->beginTransaction();
        try {
            
            $sql = "
                    update tbpersonal_telefono 
                    set 
                    pte_operadora = '".$this->getOperadora()."',
                    pte_numero = '".$this->getNumeroTelefono()."'
                    where 
                    pte_Codigo ='".$this->getCodTelefono()."'
                  ";
                    
            
            $sentencia = $this->dblink->prepare($sql);
            $this->dblink->commit();
            
        } catch (Exception $exc) {
            $this->dblink->rollBack();
            throw $exc;
        }
        
        return true;
        
    } 
    
    public function leerCorreos($Codigo){
        try {
            $sql="
                select
                    pem_codigo,
                    pem_email
                from  
                    tbpersonal_email                     
                where
                pem_codigo='".$Codigo."'
                    ";
                $sentencia = $this->dblink->prepare($sql);
                $sentecia->execute();

                $resultado = $sentencia->fetch_assoc();
                return $resultado;
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }
    
    public function leerTelefonos($Codigo){
        try {
            $sql="
                select
                    pte_Codigo,
                    pte_numero,
                    pte_operadora
                from  
                    tbpersonal_telefono                     
                where
                pte_Codigo='".$Codigo."'
                    ";
                $sentencia = $this->dblink->prepare($sql)OR DIE ("No se pudo Leer los Registros");;
                $resultado = $sentencia->fetch_assoc();
                return $resultado;
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }
}
