function cargarPerfil(){
      var usuario=$("#txtcodusuario").val();
          $.post(
            "../controlador/perfil.controlador.php",
            {
                p_nom_usuario: usuario
            }
          ).done(function(resultado){
              var obj = $.parseJSON ( resultado );
              $("#txtnombres").val(obj.per_nombre);
              $("#txtapellidos").val(obj.per_apellido);
              $("#txtdni").val(obj.per_dni);
              $("#txttelefono").val(obj.per_telefono);
              $("#txtcorreo").val(obj.per_correo);
              $("#txtinstitucion").val(obj.ins_nombre);
          })
          
          .fail(function(error){
              alert(error.responseText);
          });
}

$("#btnagregar").click(function(){
    
    if ( $("#txtclaveantigua").val().toString() === "" || $("#txtclavenueva").val().toString() === "" || $("#txtclaverepetida").val().toString() === ""){
        alert("Debe Completar Todos Los Campos");
        $("#txtclaveantigua").val("");
        $("#txtclavenueva").val("");
        $("#txtclaverepetida").val("");
        $("#txtclaveantigua").focus();
        return 0;
    }else{
    var clavean   = $("#txtclav").val();
    var usuario   = $("#txtusuario").val();
    var claveAntigua   = $("#txtclaveantigua").val();
    var claveNueva   = $("#txtclavenueva").val();
    var claveRepetida = $("#txtclaverepetida").val();
  
   if(claveNueva===claveRepetida && claveAntigua===clavean ){
       
       $.post(
           "../controlador/usuario.editar.controlador.php",
            {
                p_usuario: usuario,
                p_clave_antigua: claveAntigua,
                p_clave_nueva:claveNueva
                
            }
        ).done(function(resultado){
//            alert(resultado);
           if(resultado==="Se Cambio la Contraseña Satisfactoriamente"){
              document.location.href="index.php";  
           }
           
        }).fail(function(error){
            alert(error.responseText);
        });
   }else{
        alert("Las claves Ingresadas no coiniden");
        $("#txtclaveantigua").val("");
        $("#txtclavenueva").val("");
        $("#txtclaverepetida").val("");
        $("#txtclaveantigua").focus();
   } 
   }
   });

$("#btncancelar").click(function(){ 
    document.location.href="perfil.php";  
});

function EditarCorreo(){
    
     var codCorreo= $("#cbocorreo").val();
    $("#myModalLabel").empty().append("Editar datos del Correo");
    
    $.post(
            "../controlador/correo.leer.datos.controlador.php",
            {
                p_codigo : codCorreo
            }
            ).done(function(resultado){
               
                var datos = $.parseJSON(resultado);
                $("#txtcodigocorreo").val(datos.pem_codigo);
                $("#txtcorreos").val(datos.pem_email);
           
            }).fail(function(error){
                alert(error.responseText);
            });   
}
//MODAL DE CORREOS
$("#frmgrabar").submit(function(event){
   event.preventDefault(); //ignore el evento
   
   if (! confirm("Esta seguro de grabar los datos")){
       return 0;
   }
    var codCorreo= $("#txtcodigocorreo").val();
    var correo=$("#txtcorreos").val();
   $.post(
            "../controlador/correo.editar.controlador.php",
            {
                c_cod_correo: codCorreo,
                c_nombre: correo                
            }
          ).done(function(resultado){           
//          alert(resultado);
           if(resultado==="Exito"){
               $("#btncerrar").click();               
               cargarPerfil();
           }
           
        }).fail(function(error){
            alert(error.responseText);
        }); 
   
});
//FIN DEL MODAL DE CORREOS

//MODAL DEE TELEFONOS
$("#frmgrabarTelefono").submit(function(event){
   event.preventDefault(); //ignore el evento
   
   if (! confirm("Esta seguro de grabar los datos")){
       return 0;
   }
    var codTelefono= $("#txtcodigotelefono").val();
    var numerocell=$("#txtnumero").val();
    var cod_operador= $("#cbooperador_modal").val();
    var operador;
    
    if(cod_operador==="0"){
        operador="MOVISTAR";
    }else if(cod_operador==="1"){
        operador="CLARO";
    }else if(cod_operador==="2"){
        operador="BITEL";
    }else if(cod_operador==="3"){
        operador="ENTEL";
    }else{
        operador="TUENTI";
    }    
   $.post(
            "../controlador/telefono.editar.controlador.php",
            {
                t_cod_telefonos: codTelefono,
                t_operadores: operador,
                t_numeros: numerocell                
            }
          ).done(function(resultado){           
//          alert(resultado);
           if(resultado==="Exito"){
               $("#btncerrare").click();               
               cargarPerfil();
           }
           
        }).fail(function(error){
            alert(error.responseText);
        }); 
   
});
//FIN DEL MODAL DE TELÉFONO

function EditarTelefonos(){
   var codTelefono= $("#cbotelefono").val();
    $("#myModalLabele").empty().append("Editar datos del Teléfono");
 
   $.post(
            "../controlador/telefono.leer.datos.controlador.php",
            {
                p_codigo : codTelefono
            }
            ).done(function(resultado){
               
                var datos = $.parseJSON(resultado);
                var operad=datos.pte_operadora;
                var codoperador;
                    if(operad==="MOVISTAR"){
                        codoperador="0";
                    }else if(operad==="CLARO"){
                        codoperador="1";
                    }else if(operad==="BITEL"){
                        codoperador="2";
                    }else if(operad==="ENTEL"){
                        codoperador="3";
                    }else{
                        codoperador="4";
                    }
                $("#txtcodigotelefono").val(datos.pte_Codigo);
                $("#cbooperador_modal").val(codoperador);
                $("#txtnumero").val(datos.pte_numero);
           
            }).fail(function(error){
                alert(error.responseText);
            }); 
}
$(document).ready(function (){
    cargarPerfil(); 
});
