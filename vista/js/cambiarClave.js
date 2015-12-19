function CambiarClave(){

    $.ajax({
    	url: "../controlador/UsuarioEditar.controlador.php",
    	type: "post",
    	dataType: "json",
    	data:$("#btnagregar").serialize() ,

    	success: function(DataJson){
            
      		if(DataJson.state){
                    
      			swal("Cambio de Contraseña Correcta", "", "success");
       			location.href="../controlador/cerrarSesion.php";
      		}else{
      			swal("Ha ocurrido un error", "", "error");                         
        		
        		
      		}                                                           
    	}
  	})
  	.fail(function(){
    	swal("Ha ocurrido un error", "", "error");
  	});
    
}