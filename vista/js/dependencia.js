$(document).ready(function(){
	listar();
	cargarCodigo();
});
$('#frmgrabar').submit(function(e){ 
    e.preventDefault();
    
        if($("#txtnombre").val()==="" || $("#txttelefono").val()===""){
            swal("Complete los campos", "", "error");
            return 0;  
        }
    
  	$.ajax({
    	url: "../controlador/DependenciaGrabar.controlador.php",
    	type: "post",
    	dataType: "json",
    	data:$("#frmgrabar").serialize() ,

    	success: function(DataJson){
//                alert("entro");
      		if(DataJson.state){
      			swal("Registro Correcto", "", "success");
       			listar();
       			cargarCodigo();
       			$('#myModal').modal('hide');
       			limpiarFormulario();
      		}else{
      			swal("Ha ocurrido un errorrr", "", "error");                           
        		listar();
        		cargarCodigo();
        		$('#myModal').modal('hide');
        		limpiarFormulario();
      		}                                                           
    	}
  	})
  	.fail(function(){
//            alert(" no entro");
            swal("Ha ocurrido un error", "", "error");
  	});
        
});
$('#frmeditar').submit(function(e){ 
    e.preventDefault();
    
        if($("#txtnombreedit").val()==="" || $("#txttelefonoedit").val()===""){
            swal("Complete los campos", "", "error");
            return 0;  
        }
    
  	$.ajax({
    	url: "../controlador/DependenciaEditar.controlador.php",
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
  $("#txttelefono").val("");
}
function limpiarFormularioEditar(){
	$("#txtnombreedit").val("");
	$("#txttelefonoedit").val("");
}
function listar(){
	$("#bodydependencias").empty();
	$.ajax({
    	url: "../controlador/DependenciaListar.controlador.php",
    	type: "post",
    	dataType: "json",
    	success: function(DataJson){
      		if(DataJson.state){
       			for(data in DataJson.resultado){
                            //alert(data);Numero de Regitros
                            $("#bodydependencias").append("<tr><td>"+DataJson.resultado[data].dep_codigo+"</td><td>"+DataJson.resultado[data].dep_nombre+"</td><td>"+DataJson.resultado[data].dep_telefono+"</td><td><a class='btn btn-warning' data-toggle='modal' data-target='#myModal2' onclick='editar(\""+DataJson.resultado[data].dep_codigo+"\")'><i class='glyphicon glyphicon-wrench'></i></a> <a class='btn btn-danger' data-toggle='modal' data-target='#myModale' onclick='eliminar(\""+DataJson.resultado[data].dep_codigo+"\")'><i class='glyphicon glyphicon-remove'></i></a></td></tr>");
       			}
      		}else{                           
        		
      		}
          $("#tabledependencias").DataTable();                                                               
    	}
  	})
  	.fail(function(){
    	//swal("Ha ocurrido un error", "", "error");
  	})
}
function cargarCodigo(){
	$.ajax({
    	url: "../controlador/DependenciaObtenerCodigo.controlador.php",
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
    	url: "../controlador/DependenciaCargarCodigo.php",
    	type: "post",
    	dataType: "json",
    	data: parametro,
    	success: function(DataJson){
      		if(DataJson.state){
     				$("#txtcodigoedit").val(DataJson.resultado.dep_codigo);
     				$("#txtnombreedit").val(DataJson.resultado.dep_nombre);
            $("#txttelefonoedit").val(DataJson.resultado.dep_telefono);
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
        
	$.ajax({
    	url: "../controlador/DependenciaEliminar.controlador.php",
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

$(document).on("keypress", "#txttelefono", function(){
    if($("#txttelefono").val().length < 6){
        return true;
    }else{
        return false;
    }
});

$(document).on("keypress", "#txttelefonoedit", function(){
    if($("#txttelefonoedit").val().length < 6){
        return true;
    }else{
        return false;
    }
});

