function CambiarClave(){
    
    if($("#txtclaveantigua").val()===$("#txtclav").val()){
            if($("#txtclavenueva").val()===$("#txtclaverepetida").val()) {
                $.ajax({
                url: "../controlador/UsuarioEditar.controlador.php",
                type: "post",
                dataType: "json",
                data:$("#frmgrabar").serialize() ,

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
            }else{
                alert("Las Claves Nuevas no Coinciden")
                return 0;
            }
        }else{
            alert("Las Clave Ingresada no coincide con la Antigua")
            return 0;   
        }  
   
    
}

$(function() {
    $('#txtclavenueva').on('keypress',function(evento) {
        if($("#txtclaveantigua").val()===$("#txtclav").val()){
            return true; 
        }else{
            alert("Las Clave Ingresada no coincide con la Antigua")
            return false;                        
        }
      
     }); 
     $('#txtclaverepetida').on('keypress',function(evento) {
        if($("#txtclaveantigua").val()===$("#txtclav").val()){
            return true; 
        }else{
            alert("Las Clave Ingresada no coincide con la Antigua")
            return false;                        
        }
      
     });
     $('#txtclaveantigua').on('keypress',function(evento) {      
        $("#txtclavenueva").val("");
        $("#txtclaverepetida").val("");
     });
   });