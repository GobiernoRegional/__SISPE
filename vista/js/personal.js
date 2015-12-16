//Listar
$(document).ready(function (){
    listarPersonal();
    cargarCombInstitucion();
    cargarCombCargo();
    cargarCombDistrito();
    $("#menumantenimiento").attr("class","active");
    $("#menupersonal").attr("class","active");
});
function listarPersonal(){             
    $.post("../controlador/personal.controlador.php"
          ).done(function(resultado){
                $("#listados").empty();//limpio
                $("#listados").append(resultado);//agrego
                $("#tabla-listado").dataTable({
                    "aaSorting": [[1, "asc"]],
                    
                    "sScrollX":       "180%",
                    "sScrollXInner":  "270%",
                    "bScrollCollapse": true,
                    "bPaginate":       true 
                });//lo muestro en una tabla
            });
}

//Agregar Personal
function agregarPersonal(){

    $("#txtcodigoper").val('Personal');
    $("#txnombres").val(""); 
    $("#txtapellido").val(""); 
    $("#txtdni").val(""); 
    $("#cbosexo_modal").val(""); 
    $("#txtdireccion").val(""); 
    $("#txtfechanacimiento").val(""); 
    $("#txtcorreo").val(""); 
    $("#txttelefono").val(""); 
    $("#cboinstitucion_modal").val(""); 
    $("#cbocargo_modal").val(""); 
    $("#cbodistrito_modal").val(""); 
    $("#cboestado_modal").val(""); 
   
    $("#myModalLabel").empty().append("Agregar nuevo Personal");
    $("#txttipooperacion").val("agregar");
}

$("#frmgrabar").submit(function(event){
   event.preventDefault(); //ignore el evento
   
   if (! confirm("Esta seguro de grabar los datos")){
       return 0;
   }   

   var operacion="agregar";
   $.post(
           "../controlador/personal.leer.agregar.editar.eliminar.controlador.php",
            {
                a_operacion: operacion,
                p_array_datos: $("#frmgrabar").serialize()
                
            }
        ).done(function(resultado){
            alert(resultado);
           if(resultado==="exito"){                 
               $("#btncerrar").click();
                listarPersonal();
           }
           
        }).fail(function(error){
            alert(error.responseText);
        });
   
});

//Editar Personal
function editarPersonal(codigo){
    // alert(2);
    $("#myModalLabel").empty().append("Editar datos De Personal");
    $("#txttipooperacion").val("editar");
    
    var operacion="leer";
    
    $.post(
            "../controlador/personal.leer.agregar.editar.eliminar.controlador.php",
            {
                p_codigo : codigo,
                a_operacion : operacion
            }
            ).done(function(resultado){
                var datos = $.parseJSON(resultado);
                $("#txtcodigoper").val(datos.per_codigo);
                $("#txnombres").val(datos.per_nombre);
                $("#txtapellido").val(datos.per_apellido);
                $("#txtdni").val(datos.per_dni);
                $("#cbosexo_modal").val(datos.per_sexo);
                $("#txtdireccion").val(datos.per_direccion);
                $("#txtfechanacimiento").val(datos.per_fnac);
                $("#txtcorreo").val(datos.per_correo);
                $("#txttelefono").val(datos.per_telefono);
                $("#cboinstitucion_modal").val(datos.per_ins_codigo);
                $("#cbocargo_modal").val(datos.per_car_codigo);
                $("#txtcoddistrito").val(datos.per_udi_codigo);
                $("#cboestado_modal").val(datos.estado);
            }).fail(function(error){
                alert(error.responseText);
            });
            
}

//Eliminar
function eliminarPersonal(codigo){
    if(!confirm("Esta seguro de eliminar Estos registros seleccionados")){
        return 0;//si da cancelar no avanza fin de la operacion caso contrario se avanza
    } 

    var operacion="eliminar"; 
    
    $.post(
            "../controlador/personal.leer.agregar.editar.eliminar.controlador.php",{
                p_codigo : codigo,
                a_operacion:operacion
            }
          ).done(function(resultado){//cuando haya terminado esto alamacenrloe n resultado
              alert(resultado)  ;
              if (resultado==="exito"){
                    listarPersonal();
                }
              }).fail(function(error){
              alert(error.responseText);
          });
}

function EliminarVariosPersonales(codigo){
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
            "../controlador/personal.leer.agregar.editar.eliminar.controlador.php",{
                p_codigo : objarrays[i],
                a_operacion:operacion
            }
          ).done(function(resultado){//cuando haya terminado esto alamacenrloe n resultado
               contador = contador + 1;
               
                if (resultado==="exito" && contador===1 ){                   
                    alert(resultado);
                    listarPersonal();
                }
                if (resultado==="No se pudo borrar Este Registro"){  
                    contadorELIMI=contadorELIMI+1
                    alert("Numero de Registros no eliminados:"+contadorELIMI);
                    listarPersonal();
                }              
              }).fail(function(error){
              alert(error.responseText);
          });
    }
    }   

}

function SeleccionarPersonal(valor){        
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

function cargarCombInstitucion(){ 
 $.post(
           "../controlador/personal.leer.agregar.editar.eliminar.controlador.php",
            {
                a_operacion: "llenarCombox",
                p_tabla:"institucion"               
                
            }
        ).done(function(resultado){
            $("#cboinstitucion_modal").append(resultado);
        });
}

function cargarCombCargo(){ 
 $.post(
           "../controlador/personal.leer.agregar.editar.eliminar.controlador.php",
            {
                a_operacion: "llenarCombox",
                p_tabla:"cargo"               
                
            }
        ).done(function(resultado){
//            alert(resultado);
            $("#cbocargo_modal").append(resultado);
        });

}

function cargarCombDistrito(){ 
 $.post(
           "../controlador/personal.leer.agregar.editar.eliminar.controlador.php",
            {
                a_operacion: "llenarCombox",
                p_tabla:"distrito"               
                
            }
        ).done(function(resultado){
//            alert(resultado);
            $("#cbodistrito_modal").append(resultado);
        });

}


$("#myModal").on('shown.bs.modal', function(){
    $("#txtcodigoper").focus();
});

 $(function() {
     $('#dtdistrito_modal').on('input',function() {
         var opt = $('option[value="'+$(this).val()+'"]');        
         var codigo_emisor = opt.attr('id');
//         alert(codigo_emisor);
         $("#txtcoddistrito").val(codigo_emisor); 
     })});