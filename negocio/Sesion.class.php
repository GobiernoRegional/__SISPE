<?php

require_once '../datos/conexion.php';

class Sesion extends Conexion {
    private $usuario;
    private $clave;
    private $recordar;
    
    public function getRecordar() {
        return $this->recordar;
    }

    public function setRecordar($recordar) {
        $this->recordar = $recordar;
    }

    public function getUsuario() {
        return $this->usuario;
    }

    public function getClave() {
        return $this->clave;
    }

    public function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    public function setClave($clave) {
        $this->clave = $clave;
    }

        
    public function iniciarSesion() {
        try {
            $sql = "
                    select 
                        usu_Nombre as usuario, 
                        usu_estado,
                        usu_clave, 
                        per_nombre as nombre,
                        per_apellido as apellido,
                        per_dni,
                        per_telefono,
                        per_correo,
                        per_direccion,
                        are_nombre,
                        car_nombre as cargo                          
                    from 
                        tbusuario u
                        inner join tbpersonal p on (u.usu_per_Codigo = p.per_Codigo)
                        inner join tbcargo c on(p.per_car_Codigo = c.car_Codigo)
                        inner join tbarea a on (p.per_are_codigo = a.are_codigo)
                    where 
                        upper(usu_nombre)= upper(:p_usuario)
                    ";

            print_r( $this->getUsuario());
            $sentecia = $this->dblink->prepare($sql);
            $sentecia->bindParam(":p_usuario", $this->getUsuario());
            $sentecia->execute();
            $resultado = $sentecia->fetch();
            
            print_r($resultado);

            if ($resultado["usu_clave"] == md5($this->getClave())){
                if ($resultado["usu_estado"] == "I"){
                    return 2;
                }else{
                    session_name("sistema-spe");
                    session_start();
                    $_SESSION["usuario"]    = $resultado["nombre"].' '.$resultado["apellido"];
                    $_SESSION["nombres"]    = $resultado["nombre"];
                    $_SESSION["apellidos"]  = $resultado["apellido"];
                    $_SESSION["dni"]        = $resultado["per_dni"];
                    $_SESSION["cargo"]      = $resultado["cargo"];
                    $_SESSION["cuenta"]     = $resultado["usuario"];
                    $_SESSION["area"]       = $resultado["are_nombre"]  ;
                    $_SESSION["correo"]     = $resultado["per_correo"];
                    $_SESSION["telefono"]   = $resultado["per_telefono"];
                    $_SESSION["clave"]      = $this->getClave();
                    $_SESSION["direccion"]  = $resultado["per_direccion"]; 
                                        

                    if ($this->getRecordar()=="S"){
                        setcookie("usuariousuario", $this->getUsuario(), 0, "/");
                    }else{
                        setcookie("usuariousuario", "", 0, "/");
                    }
                    

                    return 1;
                }
            }

            return -1;
        } catch (Exception $exc) {
            throw $exc;
        }
    }   

    
}
