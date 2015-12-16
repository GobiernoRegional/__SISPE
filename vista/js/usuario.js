$(document).ready(function (){
    listarUsuarios();
    cargarCombPersonal();
    $("#menumantenimiento").attr("class","active");
    $("#menuusuarios").attr("class","active");
});
function listarUsuarios(){    
    $.post("../controlador/usuario.controlador.php"
          ).done(function(resultado){
                $("#listados").empty();//limpio
                $("#listados").append(resultado);//agrego
                $("#tabla-listado").dataTable({
                    "aaSorting": [[1, "asc"]],
                    
                    "sScrollX":       "150%",
                    "sScrollXInner":  "190%",
                    "bScrollCollapse": true,
                    "bPaginate":       true 
                });//lo muestro en una tabla
            });
}

function agregarUsuario(){
    $("#txtcodigo").val('Usuario');
    $("#txtnombre").val(""); 
    $("#txtclave").val(""); 
    $("#txtclave").val(""); 
    $("#cbotipusu").val(""); 
    $("#cbotipest").val(""); 
    $("#cbopersonal").val(""); 
    $("#cbo_mantenimiento").val(""); 
    $("#cbo_usuario").val(""); 
    $("#cbo_personal").val(""); 
    $("#cbo_cargos").val(""); 
    $("#cbo_institucion").val(""); 
   
    $("#myModalLabel").empty().append("Agregar nuevo Usuario");
    $("#txttipooperacion").val("agregar");
}

$("#frmgrabar").submit(function(event){
   event.preventDefault(); //ignore el evento
   
   if (! confirm("Esta seguro de grabar los datos")){
       return 0;
   }   

   var operacion="agregar";
   $.post(
           "../controlador/usuario.editar.controlador.php",
            {
                a_operacion: operacion,
                p_array_datos: $("#frmgrabar").serialize()
                
            }
        ).done(function(resultado){
            alert(resultado);
           if(resultado==="exito"){                 
               $("#btncerrar").click();
                listarUsuarios();
           }
           
        }).fail(function(error){
            alert(error.responseText);
        });  
});

function editarUsuario(codigo){
    // alert(2);
    $("#myModalLabel").empty().append("Editar datos De Usuarios");
    $("#txttipooperacion").val("editar");
    
    var operacion="leer";
    
    $.post(
            "../controlador/usuario.editar.controlador.php",
            {
                p_codigo : codigo,
                a_operacion : operacion
            }
            ).done(function(resultado){
                var datos = $.parseJSON(resultado);
                $("#txtcodigo").val(datos.usu_codigo);
                $("#txtnombre").val(datos.usu_nombre);
                $("#txtclave").val(datos.usu_clave);
                $("#txtclave").val(datos.usu_clave);
                $("#cbotipusu").val(datos.usu_tipo);
                $("#cbotipest").val(datos.usu_estado);
                $("#cbopersonal").val(datos.usu_per_codigo);
                $("#cbo_mantenimiento").val(datos.upe_matenimiento);
                $("#cbo_usuario").val(datos.upe_usuario);
                $("#cbo_personal").val(datos.upe_personal);
                $("#cbo_cargos").val(datos.upe_cargo);
                $("#cbo_institucion").val(datos.upe_institucion);
            }).fail(function(error){
                alert(error.responseText);
            });      
}

function eliminarUsuario(codigo){
    if(!confirm("Esta seguro de eliminar Estos registros seleccionados")){
        return 0;//si da cancelar no avanza fin de la operacion caso contrario se avanza
    } 

    var operacion="eliminar"; 
    
    $.post(
            "../controlador/usuario.editar.controlador.php",{
                p_codigo : codigo,
                a_operacion:operacion
            }
          ).done(function(resultado){//cuando haya terminado esto alamacenrloe n resultado
              alert(resultado)  ;
              if (resultado==="exito"){
                    listarUsuarios();
                }
              }).fail(function(error){
              alert(error.responseText);
          });
}

function EliminarVariosUsuarios(codigo){
    var valor=0;
    var objarrays=new Array();
    
    $("input[type=checkbox]:checked").each(function(){
	//cada elemento seleccionado
        valor=valor +1
        objarrays[valor-1]=$(this).val();
        
    });
    
    if(objarrays.length===0){
        alert("Usted debe seleccionar un elemento");
        return 0;
    }  
    if(codigo===1){
    if(!confirm("Esta seguro de eliminar Estos registros seleccionados")){
        return 0;//si da cancelar no avanza fin de la operacion caso contrario se avanza
    }
    var operacion="eliminar";
    var  contador = 0;
    var  contadorELIMI = 0;
    
    
    for (var i=0;i<objarrays.length;i++){ 
    
    $.post(
            "../controlador/usuario.editar.controlador.php",{
                p_codigo : objarrays[i],
                a_operacion:operacion
            }
          ).done(function(resultado){//cuando haya terminado esto alamacenrloe n resultado
               contador = contador + 1;
               
                if (resultado==="exito" && contador===1 ){                   
                    alert(resultado);
                    listarUsuarios();
                }
                if (resultado==="No se pudo borrar Este Registro"){  
                    contadorELIMI=contadorELIMI+1
                    alert("Numero de Registros no eliminados:"+contadorELIMI);
                    listarUsuarios();
                }              
              }).fail(function(error){
              alert(error.responseText);
          });
    }
    }   
}

function SeleccionarUsuarios(valor){        
        //Checkbox
	if(valor===1){
            $('input[type=checkbox]').each( function() {
                this.checked = true;
            });
        }else{
            $('input[type=checkbox]').each( function() {
                this.checked = false;
            });
        }
}

function cargarCombPersonal(){ 
 $.post(
           "../controlador/usuario.editar.controlador.php",
            {
                a_operacion: "llenarCombox",
                p_tabla:"personal"               
                
            }
        ).done(function(resultado){
           //alert(resultado);
            $("#cbopersonal").append(resultado);
        });

}


$("#myModal").on('shown.bs.modal', function(){
    $("#txtcodigo").focus();
});