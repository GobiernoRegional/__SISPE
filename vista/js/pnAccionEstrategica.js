$(document).ready(function(){
	listar();
	cargarObjetivo();
	cargarObjetivoEdit();
});
$('#frmgrabar').submit(function(e){ 
    e.preventDefault();
    
  	$.ajax({
    	url: "../controlador/AccionGrabar.controlador.php",
    	type: "post",
    	dataType: "json",
    	data:$("#frmgrabar").serialize() ,

    	success: function(DataJson){
      		if(DataJson.state){
      			swal("Registro Correcto", "", "success");
       			listar();
       			$('#myModal').modal('hide');
       			limpiarFormulario();
      		}else{
      			swal("Ha ocurrido un error", "", "error");                           
        		listar();
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
    
    $.ajax({
      url: "../controlador/AccionEditar.controlador.php",
      type: "post",
      dataType: "json",
      data:$("#frmeditar").serialize() ,

      success: function(DataJson){
          if(DataJson.state){
            swal("Registro Correcto", "", "success");
            listar();
            $('#myModal2').modal('hide');
            limpiarFormulario();
          }else{
            swal("Ha ocurrido un error", "", "error");                           
            listar();
            $('#myModal2').modal('hide');
            limpiarFormulario();
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
  $("#txtobjetivo").val(0);
  $("#txtaccion").val("");
}
function listar(){
	$("#bodyaccionestrategica").empty();
	$.ajax({
    	url: "../controlador/AccionListar.controlador.php",
    	type: "post",
    	dataType: "json",
    	success: function(DataJson){
      		if(DataJson.state){
       			for(data in DataJson.resultado){
       				$("#bodyaccionestrategica").append("<tr><td>"+DataJson.resultado[data].acc_codigo+"</td><td>"+DataJson.resultado[data].oen_nombre+"</td><td>"+DataJson.resultado[data].acc_descripcion+"</td><td><a class='btn btn-warning' data-toggle='modal' data-target='#myModal2' onclick='editar(\""+DataJson.resultado[data].acc_codigo+"\")'><i class='glyphicon glyphicon-wrench'></i></a> <a class='btn btn-danger' data-toggle='modal' data-target='#myModale' onclick='eliminar(\""+DataJson.resultado[data].acc_codigo+"\")'><i class='glyphicon glyphicon-remove'></i></a></td></tr>");
       			}
      		}else{                           
        		
      		}
          $("#tableaccionestrategica").DataTable();                                                               
    	}
  	})
  	.fail(function(){
    	//swal("Ha ocurrido un error", "", "error");
  	})
}
function editar(id){
  var parametro={
    "codigo":id,
  }
  $.ajax({
      url: "../controlador/AccionCargarCodigo.controlador.php",
      type: "post",
      dataType: "json",
      data: parametro,
      success: function(DataJson){
        if(DataJson.state){
          $("#txtcodigo").val(DataJson.resultado.acc_codigo);
          $("#txtobjetivoedit").val(DataJson.resultado.acc_oen_codigo);
          $("#txtaccionedit").val(DataJson.resultado.acc_descripcion);
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
function cargarObjetivo(){
	$.ajax({
    	url: "../controlador/ObjetivoEstrategicoNacListar.controlador.php",
    	type: "post",
    	dataType: "json",
    	success: function(DataJson){
      		if(DataJson.state){
       			for(data in DataJson.resultado){
       				$("#txtobjetivo").append("<option value="+DataJson.resultado[data].oen_codigo+">"+DataJson.resultado[data].oen_nombre+"</option>");
       			}
      		}else{                           
        		
      		}                                                             
    	}
  	})
  	.fail(function(){
    	//swal("Ha ocurrido un error", "", "error");
  	})
}
function cargarObjetivoEdit(){
	$.ajax({
    	url: "../controlador/ObjetivoEstrategicoNacListar.controlador.php",
    	type: "post",
    	dataType: "json",
    	success: function(DataJson){
      		if(DataJson.state){
       			for(data in DataJson.resultado){
       				$("#txtobjetivoedit").append("<option value="+DataJson.resultado[data].oen_codigo+">"+DataJson.resultado[data].oen_nombre+"</option>");
       			}
      		}else{                           
        		
      		}                                                             
    	}
  	})
  	.fail(function(){
    	//swal("Ha ocurrido un error", "", "error");
  	})
}

function eliminardato(valor){
//    alert($("#txtcodigoeliminar").val());    
    if(valor ==="no"){
        return 0;
    }else{
        var parametro={
		"codigo":  $("#txtcodigoeliminar").val(),
	}
	$.ajax({
    	 url: "../controlador/AccionEliminar.controlador.php",
    	type: "post",
    	dataType: "json",
    	data: parametro,
    	success: function(DataJson){
      		if(DataJson.state){
       			swal("Correcto", "", "success");
            	listar();
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