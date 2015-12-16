<?php
	require_once '../datos/conexion.php';
	class Prdc extends Conexion{
		private $titulo;
		private $nombrearchivo;
		private $rutaarchivo;
		private $descripcion;
		private $documentotexto;

		public function setTitulo($titulo){
			$this->titulo=$titulo;
		}
		public function getTitulo(){
			return $this->titulo;
		}
		public function setNombreArchivo($nombrearchivo){
			$this->nombrearchivo=$nombrearchivo;
		}
		public function getNombreArchivo(){
			return $this->nombrearchivo;
		}
		public function setRutaArchivo($rutaarchivo){
			$this->rutaarchivo=$rutaarchivo;
		}
		public function getRutaArchivo(){
			return $this->rutaarchivo;
		}
		public function setDescripcion($descripcion){
			$this->descripcion=$descripcion;
		}
		public function getDescripcion(){
			return $this->descripcion;
		}
		public function setDocumentoTexto($documentotexto){
			$this->documentotexto=$documentotexto;
		}
		public function getDocumentoTexto(){
			return $this->documentotexto;
		}

		public function subirArchivo(){
	        try {
	            $sql= "INSERT INTO tbarchivopdrc(titulo,nombre_archivo,ruta_archivo,descripcion,fecha_registro)
	            VALUES (:p_titulo,:p_nombrearchivo,:p_rutaarchivo,:p_descripcion,CURRENT_DATE)";
	            $sentencia = $this->dblink->prepare($sql);
	            $sentencia->bindParam(":p_titulo",  $this->getTitulo());
				$sentencia->bindParam(":p_nombrearchivo",  $this->getNombreArchivo());
	            $sentencia->bindParam(":p_rutaarchivo",  $this->getRutaArchivo());
	            $sentencia->bindParam(":p_descripcion",  $this->getDescripcion());
	            $sentencia->execute(); 
	            
	            $array=array('state'=>1);
	            return $array; 
	        }catch (Exception $exc) {
	            throw $exc;
	        }    
	    }
	    public function registroManual(){
	        try {
	            $sql= "INSERT INTO tbarchivopdrc(titulo,documento_texto,fecha_registro)
	            VALUES (:p_titulo,:p_documento,CURRENT_DATE)";
	            $sentencia = $this->dblink->prepare($sql);
	            $sentencia->bindParam(":p_titulo",  $this->getTitulo());
				$sentencia->bindParam(":p_documento",  $this->getDocumentoTexto());
	            $sentencia->execute(); 
	            
	            $array=array('state'=>1);
	            return $array; 
	        }catch (Exception $exc) {
	            throw $exc;
	        }    
	    }
	    public function  listar(){
        try {
            $sql="select titulo,documento_texto from tbarchivopdrc";
            $sentencia=$this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado=$sentencia->fetchAll(PDO::FETCH_ASSOC);
            $array=array('state'=>1,'resultado'=>$resultado);
            return $array;
        } catch (Exception $exc) {
            throw $exc;
        }        
    }
	}
?>