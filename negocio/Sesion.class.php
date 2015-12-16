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
<<<<<<< HEAD:SisPE/negocio/Sesion.class.php
                    select 
                        usu_nombre as usuario, 
=======
                     select 
                        usu_Nombre as usuario, 
>>>>>>> 134963652b31b81f4a190f226190fbfb43a44c47:spe/negocio/Sesion.class.php
                        usu_estado,
                        usu_clave, 
                        per_nombre as nombre,
                        per_apellido as apellido,
<<<<<<< HEAD:SisPE/negocio/Sesion.class.php
                        car_nombre as cargo                        
                        from 
                        tbusuario u
                        inner join tbpersonal p on (u.usu_per_codigo = p.per_codigo)
                        inner join tbcargo c on(p.per_car_codigo = c.car_Codigo)
=======
                        car_nombre as cargo
                    from 
                        tbusuario u
                        inner join tbpersonal p on (u.usu_per_Codigo = p.per_Codigo)
                        inner join tbcargo c on(p.per_car_Codigo = c.car_Codigo)
>>>>>>> 134963652b31b81f4a190f226190fbfb43a44c47:spe/negocio/Sesion.class.php
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
                    $_SESSION["usuario"] = $resultado["nombre"].' '.$resultado["apellido"];
                    $_SESSION["cargo"] = $resultado["cargo"];
                    $_SESSION["cuenta"] = $resultado["usuario"];
                    $_SESSION["clave"]= $this->getClave();
                                        

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
