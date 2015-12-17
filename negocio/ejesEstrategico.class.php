<?php

require_once '../datos/conexion.php';
class Eje  extends Conexion{
    private $codigo;
    private $nombre;    
    private  $subcapitulo;
    
    function getCodigo() {
      return $this->codigo;
    }

    function getNombre() {
      return $this->nombre;
    }

    function getSubcapitulo() {
      return $this->subcapitulo;
    }

    function setCodigo($codigo) {
      $this->codigo = $codigo;
    }

    function setNombre($nombre) {
      $this->nombre = $nombre;
    }

    function setSubcapitulo($subcapitulo) {
      $this->subcapitulo = $subcapitulo;
    }

    function listar(){
        try {
            $sql="select * from tbejeestrategico eje
                inner join  tbsubcapitulos sub on
                (eje.eje_sub_codigo = sub.sub_codigo) order by 1";
            
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
                
                $sql = "select fn_ejeestrategicoinsertar( '".$this->getNombre()."',"
                        ."'".$this->getSubCapitulo()."')";
                
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
            $sql = "select fn_ejeestrategicomodificar('".$this->getCodigo()."','".$this->getNombre()."','".$this->getSubcapitulo()."')";
          
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
                        eje_codigo,
                        eje_nombre,
                        eje_sub_codigo
                from
                        tbejeestrategico
                where
                        eje_codigo = '".$codigo."'
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
            $sql = "select fn_ejeestrategicoeliminar('".$this->getCodigo()."')";
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
                $sql = "Select eje_codigo from tbejeestrategico order by eje_codigo desc limit 1";
                
                $sentencia =  $this->dblink->prepare($sql);            
                $sentencia->execute();
                $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);

                  
                 $valor = (INTEGER)(substr($resultado["eje_codigo"], 3,3));   
                $codigo="";                                 
                $codigoss=$valor+1;
                
                if($codigoss>=0 && $codigoss <10){
                    
                    $codigo=(string)("EJE00".$codigoss);
                    
                }else if($codigoss>=10&& $codigoss <100){
                    
                    $codigo=(string)("EJE0".$codigoss);                  
                }else{
                    $codigo=(string)("EJE".$codigoss);
                }
                $array=array('state'=>1,'resultado'=>$codigo);
            return $array;                                               
        } catch (Exception $exc) {        
                                        
            throw $exc;
        }        
        
        
    }
    
    public function obtenerSubcapitulos() {
        try {
            $sql = "
                    select sub_codigo, sub_nombre from tbsubcapitulos order by sub_nombre asc
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
