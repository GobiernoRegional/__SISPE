<?php

require_once '../Datos/conexion.php';

class Personal extends Conexion{
    private  $codpersona;
    private  $nombres;
    private  $apellidos;
    private  $sexo;
    private  $dni;
    private  $direciones;
    private  $fechaNacimiento;
    private  $institucion;
    private  $cargo;
    private  $distrito;
    private  $telefono;
    private  $correo;
    private  $estado;
    private  $usuario;
    private  $pass;
    
    function getCodpersona() {
        return $this->codpersona;
    }

    function getNombres() {
        return $this->nombres;
    }

    function getApellidos() {
        return $this->apellidos;
    }

    function getSexo() {
        return $this->sexo;
    }

    function getDni() {
        return $this->dni;
    }

    function getDireciones() {
        return $this->direciones;
    }

    function getFechaNacimiento() {
        return $this->fechaNacimiento;
    }

    function getInstitucion() {
        return $this->institucion;
    }

    function getCargo() {
        return $this->cargo;
    }

    function getDistrito() {
        return $this->distrito;
    }

    function getTelefono() {
        return $this->telefono;
    }

    function getCorreo() {
        return $this->correo;
    }

    function getEstado() {
        return $this->estado;
    }

    function getUsuario(){
        return $this->usuario;
    }

    function getPass(){
        return $this->pass;
    }

    function setCodpersona($codpersona) {
        $this->codpersona = $codpersona;
    }

    function setNombres($nombres) {
        $this->nombres = $nombres;
    }

    function setApellidos($apellidos) {
        $this->apellidos = $apellidos;
    }

    function setSexo($sexo) {
        $this->sexo = $sexo;
    }

    function setDni($dni) {
        $this->dni = $dni;
    }

    function setDireciones($direciones) {
        $this->direciones = $direciones;
    }

    function setFechaNacimiento($fechaNacimiento) {
        $this->fechaNacimiento = $fechaNacimiento;
    }

    function setInstitucion($institucion) {
        $this->institucion = $institucion;
    }

    function setCargo($cargo) {
        $this->cargo = $cargo;
    }

    function setDistrito($distrito) {
        $this->distrito = $distrito;
    }

    function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    function setCorreo($correo) {
        $this->correo = $correo;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

    function setUsuario($usuario){
        $this->usuario=$usuario;
    }

    function setPass($pass){
        $this->pass=$pass;
    }
    
    function  listar(){
        try {
            $sql="
                Select
                    *
                from
                    tbpersonal per
                    inner join tbcargo car on (per.per_car_codigo=car.car_codigo)
                    inner join tbarea ar on (per.per_are_codigo=ar.are_codigo)             
                  ";
            $sentecia = $this->dblink->query($sql)OR DIE ("No se pudo Leer Estos Registro");
            $resultado = $sentecia->fetchAll();
            $array = array('state' =>1 ,'resultado'=>$resultado);
            return $array;
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
        
    }
    
    public function editar() {
        $this->dblink->beginTransaction();
        
        try {
            $sql = "update tbpersonal "
                    . "set "
                    . "per_nombre ='".$this->getNombres()."',"                  
                    . "per_apellido ='".$this->getApellidos()."',"
                    . "per_DNI ='".$this->getDni()."',"
                    . "per_sexo ='".$this->getSexo()."',"
                    . "per_direccion ='".$this->getDireciones()."',"
                    . "per_correo ='".$this->getCorreo()."',"
                    . "per_fnac ='".$this->getFechaNacimiento()."',"
                    . "per_telefono ='".$this->getTelefono()."',"
                    . "per_car_Codigo ='".$this->getCargo()."',"
                    . "per_are_Codigo ='".$this->getInstitucion()."'" 
                    . "where "
                    . "per_Codigo = '".$this->getCodpersona()."'";
            
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
    
    public function leerDatos($codigo) {
        try {
            $sql = "
                select                        
                        per_Codigo,
                        per_nombre,
                        per_Apellido,
                        per_DNI,
                        per_sexo,
                        per_direccion,
                        per_correo,
                        per_fnac,
                        per_telefono,
                        per_estado,
                        per_car_Codigo,
                        per_are_Codigo
                from
                        tbpersonal  per
                where
                        per_Codigo = '".$codigo."'
                ";
            $sentecia = $this->dblink->prepare($sql) OR DIE ("No se pudo leer estos Registro");
            $sentecia->execute();
            $resultado = $sentecia->fetch(PDO::FETCH_ASSOC);
            $array = array('state' =>1 ,'resultado'=>$resultado);
            return $array;
        } catch (Exception $exc) {
            throw $exc;
        }            
    }
    public function eliminar() {
        try {
            $sql = "delete from tbpersonal where per_codigo = '".$this->getCodpersona()."'";
            $sentencia = $this->dblink->prepare($sql) OR DIE ("No se pudo borrar Este Registro");
            $sentencia->execute();
            
        } catch (Exception $exc) {        
                                        
            throw $exc;
        }        
        $array = array('state' =>1);
        return $array;   
        
    }
    public function agregarpersonal() {
        $this->dblink->beginTransaction();
        
        try {    
        
            $sql= "select fn_insertarpersonal('".$this->getApellidos()."','".$this->getNombres()."','".$this->getDni()."',
                    '".$this->getFechaNacimiento()."','".$this->getInstitucion()."','".$this->getDireciones()."',
                    '".$this->getSexo()."','".$this->getCargo()."','".$this->getCorreo()."','".$this->getTelefono()."','1','".$this->getUsuario()."','".$this->getPass()."')
                    ";
                                       
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->execute();
                $this->dblink->commit();                              
            
        } catch (Exception $exc) {
            $this->dblink->rollBack();
            throw $exc;
        }
        
        $array = array('state' =>1);
        return $array;           
    }
    /*
    public function obtenerCiudades() {
        try {
            $sql = "
                    select udi_codigo, (udi_nombre||' (' || upr_nombre||')')as Ciudad from tbubigeo_distrito di
                    inner join tbubigeo_provincia pr on (di.udi_upr_codigo=pr.upr_codigo) order by udi_nombre asc
                    ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(); 
            
            return $resultado;
         
        } catch (Exception $exc) {
            throw $exc;
        }
    }
    */


}

    
            
    
