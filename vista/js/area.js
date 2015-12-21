$(document).ready(function(){
	listar();
	cargarCodigo();
  cargarDependencia();
  cargarDependenciaEdit();
});
$('#frmgrabar').submit(function(e){ 
    e.preventDefault();
        
        if($("#txtdependencia").val()==="0" || $("#txtnombre").val()===""){
            swal("Complete los campos", "", "error");
            return 0;  
        }
        
  	$.ajax({
    	url: "../controlador/AreaGrabar.controlador.php",
    	type: "post",
    	dataType: "json",
    	data:$("#frmgrabar").serialize() ,

    	success: function(DataJson){
      		if(DataJson.state){
      			swal("Registro Correcto", "", "success");
       			listar();
       			cargarCodigo();
       			$('#myModal').modal('hide');
       			limpiarFormulario();
      		}else{
      			swal("Ha ocurrido un error", "", "error");                           
        		listar();
        		cargarCodigo();
        		$('#myModal').modal('hide');
        		limpiarFormulario();
      		}                                                           
    	}
  	})
  	.fail(function(){
    	swal("Ha ocurrido un error", "", "error");
  	})
});
$('#frmeditar').submit(function(e){ 
    e.preventDefault();
    
        if($("#txtdependenciaedit").val()==="0" ||  $("#txtnombreedit").val()===""){
            swal("Complete los Campos", "", "error");
            return 0;  
        }
    
  	$.ajax({
    	url: "../controlador/AreaEditar.controlador.php",
    	type: "post",
    	dataType: "json",
    	data:$("#frmeditar").serialize() ,

    	success: function(DataJson){
      		if(DataJson.state){
      			swal("Editar Correcto", "", "success");
       			listar();
       			cargarCodigo();
       			$('#myModal2').modal('hide');
      		}else{
      			swal("Ha ocurrido un error", "", "error");                           
        		listar();
        		cargarCodigo();
        		$('#myModal2').modal('hide');
        		
      		}                                                           
    	}
  	})
  	.fail(function(){
    	swal("Ha ocurrido un error", "", "error");
  	})
});
function camposMayus(field){
  field.value=field.value.toUpperCase();
}
function limpiarFormulario(){
  $("#txtnombre").val("");
  $("#txtdependencia").val(0);
}
function limpiarFormularioEditar(){
	$("#txtcodigoedit").val("");
	$("#txtnombreedit").val("");
  $("#txtdependenciaedit").val(0);
}
function listar(){
	$("#bodyareas").empty();
	$.ajax({
    	url: "../controlador/AreaListar.controlador.php",
    	type: "post",
    	dataType: "json",
    	success: function(DataJson){
      		if(DataJson.state){
       			for(data in DataJson.resultado){
       				$("#bodyareas").append("<tr><td>"+DataJson.resultado[data].are_codigo+"</td><td>"+DataJson.resultado[data].are_nombre+"</td><td>"+DataJson.resultado[data].dep_nombre+"</td><td><a class='btn btn-warning' data-toggle='modal' data-target='#myModal2' onclick='editar(\""+DataJson.resultado[data].are_codigo+"\")'><i class='glyphicon glyphicon-wrench'></i></a> <a class='btn btn-danger' data-toggle='modal' data-target='#myModale' onclick='eliminar(\""+DataJson.resultado[data].are_codigo+"\")'><i class='glyphicon glyphicon-remove'></i></a></td></tr>");
       			}
      		}else{                           
        		
      		}
          $("#tableareas").DataTable();                                                               
    	}
  	})
  	.fail(function(){
    	//swal("Ha ocurrido un error", "", "error");
  	});
}
function cargarDependencia(){
  $.ajax({
      url: "../controlador/DependenciaListar.controlador.php",
      type: "post",
      dataType: "json",
      success: function(DataJson){
          if(DataJson.state){
            for(data in DataJson.resultado){
              $("#txtdependencia").append("<option value="+DataJson.resultado[data].dep_codigo+">"+DataJson.resultado[data].dep_nombre+"</option>");
            }
          }else{                           
            
          }
                                                                         
      }
    })
    .fail(function(){
      //swal("Ha ocurrido un error", "", "error");
    })
}
function cargarDependenciaEdit(){
  $.ajax({
      url: "../controlador/DependenciaListar.controlador.php",
      type: "post",
      dataType: "json",
      success: function(DataJson){
          if(DataJson.state){
            for(data in DataJson.resultado){
              $("#txtdependenciaedit").append("<option value="+DataJson.resultado[data].dep_codigo+">"+DataJson.resultado[data].dep_nombre+"</option>");
            }
          }else{                           
            
          }
                                                                         
      }
    })
    .fail(function(){
      //swal("Ha ocurrido un error", "", "error");
    })
}
function cargarCodigo(){
	$.ajax({
    	url: "../controlador/AreaObtenerCodigo.controlador.php",
    	type: "post",
    	dataType: "json",
    	success: function(DataJson){
      	if(DataJson.state){
   				$("#txtcodigo").val(DataJson.resultado);
      	}else{                           
        		
      	}                                                           
    	}
  	})
  	.fail(function(){
    	//swal("Ha ocurrido un error", "", "error");
  	});
}
function editar(id){
    
	var parametro={
		"codigo":id,
	}
	$.ajax({
    	url: "../controlador/AreaCargarCodigo.controlador.php",
    	type: "post",
    	dataType: "json",
    	data: parametro,
    	success: function(DataJson){
      	if(DataJson.state){
   				$("#txtcodigoedit").val(DataJson.resultado.are_codigo);
   				$("#txtnombreedit").val(DataJson.resultado.are_nombre);
          $("#txtdependenciaedit").val(DataJson.resultado.are_dep_codigo);
      	}else{                           
        		
      	}                                                           
    	}
  	})
  	.fail(function(){
    	swal("Ha ocurrido un error", "", "error");
  	});
}
function eliminar(id){
    $("#txtcodigoeliminar").val(id);	
}

function eliminardato(valor){
//    alert($("#txtcodigoeliminar").val());    
    if(valor ==="no"){
        return 0;
    }else{
        var parametro={
		"codigo":  $("#txtcodigoeliminar").val(),
	}
        
        if(!confirm("Esta seguro de eliminar Estos registros seleccionados")){
        return 0;//si da cancelar no avanza fin de la operacion caso contrario se avanza
        } 
        
	$.ajax({
    	url: "../controlador/AreaEliminar.controlador.php",
    	type: "post",
    	dataType: "json",
    	data: parametro,
    	success: function(DataJson){
      		if(DataJson.state){
       			swal("Correcto", "", "success");
            	listar();
            	cargarCodigo();
                $("#btncerrareliminar").click();
      		}else{                           
        		
      		}                                                           
    	}
  	})
  	.fail(function(){
    	swal("Ha ocurrido un error", "", "error");
  	});

    }
	


}

///Validaciones
$(document).on("keypress", "#txtnombre", function(){
    if($("#txtnombre").val().length < 300){
        return true;
    }else{
        return false;
    }
});

$(document).on("keypress", "#txtnombreedit", function(){
    if($("#txtnombreedit").val().length < 300){
        return true;
    }else{
        return false;
    }
});
