$(document).ready(function(){//cada ves que lea mi pagina o carge. LLama al lsitar
     listar();
     $("#menumantenimiento").attr("class","active");
     $("#menuinstitucion").attr("class","active");
});
function listar(){             
    $.post("../controlador/institucion.controlador.php"
          ).done(function(resultado){
                $("#listados").empty();//limpio
                $("#listados").append(resultado);//agrego
                $('#tabla-listado').dataTable({                          
                });
            });
}



//INICIO DEL MANTENIMIENTO DE LAS TABLAS
//1. Registrar Tabla (Graba la Data)
$("#frmgrabar").submit(function(event){
   event.preventDefault(); //ignore el evento
   
   if (! confirm("Esta seguro de grabar los datos")){
       return 0;
   }   
//   var tabla='institucion'; 
   var operacion="agregar";
   $.post(
           "../controlador/institucion.leer.agregar.editar.eliminar.controlador.php",
            {
                a_operacion: operacion,
                p_array_datos: $("#frmgrabar").serialize()
            }
        ).done(function(resultado){
            alert(resultado);
           if(resultado==="exito"){               
//          
               listar();
               $("#btncerrar").click();
           }
           
        }).fail(function(error){
            alert(error.responseText);
        });
   
});

//2. Agregar Tabla--(Limpia Campos)
function agregarInstitucion(){
    var operacion='codigo';    
    $.post(
            "../controlador/institucion.leer.agregar.editar.eliminar.controlador.php",
            {
                a_operacion : operacion
            }
            ).done(function(resultado){
                                
               $("#txtcodigo").val(resultado);
               $("#txtnombre").val(""); 
               $("#txttelefono").val(""); 
            }).fail(function(error){
                alert(error.responseText);
            });
    $("#myModalLabel").empty().append("Agregar nueva Institución");
    $("#txttipooperacion").val("agregar");
}

//3. Edita Registros Tabla--(Recoge Data)
function editarInstitucion(codigo){
    
    $("#myModalLabel").empty().append("Editar datos De Institución");
    $("#txttipooperacion").val("editar");
    
    var operacion="leer";
    
    $.post(
            "../controlador/institucion.leer.agregar.editar.eliminar.controlador.php",
            {
                p_codigo : codigo,
                a_operacion : operacion
            }
            ).done(function(resultado){
                var datos = $.parseJSON(resultado);
                $("#txtcodigo").val(datos.ins_codigo);
                $("#txtnombre").val(datos.ins_nombre);
                $("#txttelefono").val(datos.ins_telefono); 
            }).fail(function(error){
                alert(error.responseText);
            });
}

//4. Elimina Registros Tabla--(Borra)
function eliminarInstitucion(codigo){
 
    if(!confirm("Esta seguro de eliminar Estos registros seleccionados")){
        return 0;//si da cancelar no avanza fin de la operacion caso contrario se avanza
    } 

    var operacion="eliminar"; 
    
    $.post(
            "../controlador/institucion.leer.agregar.editar.eliminar.controlador.php",{
                p_codigo : codigo,
                a_operacion:operacion
            }
          ).done(function(resultado){//cuando haya terminado esto alamacenrloe n resultado
              alert(resultado)  ;
              if (resultado==="exito"){
                    listar();
                }
              }).fail(function(error){
              alert(error.responseText);
          });
}

//5. Elimina Varios Registros Tabla--(Borra Varios)
function EliminarVarios(codigo){
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
            "../controlador/institucion.leer.agregar.editar.eliminar.controlador.php",{
                p_codigo : objarrays[i],
                a_operacion:operacion
            }
          ).done(function(resultado){//cuando haya terminado esto alamacenrloe n resultado
               contador = contador + 1;
               
                if (resultado==="exito" && contador===1 ){                   
                    alert(resultado);
                    listar();
                }
                if (resultado==="No se pudo borrar Este Registro"){  
                    contadorELIMI=contadorELIMI+1
                    alert("Numero de Registros no eliminados:"+contadorELIMI);
                    listar();
                }              
              }).fail(function(error){
              alert(error.responseText);
          });
    }
    }   

}

//6 PERMITE MARCAR Y DESMARCAR TODOS LOS CHECKBOX
function Seleccionar(valor){        
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

//7 Poner el focus en nombre
$("#myModal").on('shown.bs.modal', function(){
    $("#txtnombre").focus();
});
//FIN DEL MANTENIMIENTO DE LAS TABLAS