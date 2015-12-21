$(document).ready(function(){
	listar();
});
$('#frmgrabar').submit(function(e){ 
    e.preventDefault();
    
        if($("#txtnombre").val()===""){
            swal("Complete los campos", "", "error");
            return 0;  
        }
    
  	$.ajax({
    	url: "../controlador/EjeEstrategicoGrabar.controlador.php",
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
    	url: "../controlador/EjeEstrategicoEditar.controlador.php",
    	type: "post",
    	dataType: "json",
    	data:$("#frmeditar").serialize() ,

    	success: function(DataJson){
      		if(DataJson.state){
      			swal("Editar Correcto", "", "success");
       			listar();       			
       			$('#myModal2').modal('hide');
      		}else{
      			swal("Ha ocurrido un error", "", "error");                           
        		listar();                        
        		$('#myModal2').modal('hide');
        		
      		}                                                           
    	}
  	})
  	.fail(function(){
    	swal("Ha ocurrido un error", "", "error");
  	})
});
function listar(){
	$("#bodyejeestrategico").empty();
	$.ajax({
    	url: "../controlador/EjeEstrategicoListar.php",
    	type: "post",
    	dataType: "json",
    	success: function(DataJson){
      		if(DataJson.state){
       			for(data in DataJson.resultado){
       				$("#bodyejeestrategico").append("<tr><td>"+DataJson.resultado[data].eje_codigo+"</td><td>"+DataJson.resultado[data].eje_nombre+"</td><td><a class='btn btn-warning' data-toggle='modal' data-target='#myModal2' onclick='editar(\""+DataJson.resultado[data].eje_codigo+"\")'><i class='glyphicon glyphicon-wrench'></i></a> <a class='btn btn-danger' data-toggle='modal' data-target='#myModale' onclick='eliminar(\""+DataJson.resultado[data].eje_codigo+"\")'><i class='glyphicon glyphicon-remove'></i></a></td></tr>");
       			}
      		}else{                           
        		
      		}
          $("#tablejeestrategico").DataTable();                                                               
    	}
  	})
  	.fail(function(){
    	//swal("Ha ocurrido un error", "", "error");
  	})
}

function camposMayus(field){
  field.value=field.value.toUpperCase();
}
function limpiarFormulario(){
  $("#txtnombre").val("");
}
function editar(id){
	var parametro={
		"codigo":id,
	}
	$.ajax({
    	url: "../controlador/EjeEstrategicoCargarCodigo.controlador.php",
    	type: "post",
    	dataType: "json",
    	data: parametro,
    	success: function(DataJson){
      		if(DataJson.state){
   				$("#txtcodigoedit").val(DataJson.resultado.eje_codigo);
   				$("#txtnombreedit").val(DataJson.resultado.eje_nombre);
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
    	url: "../controlador/EjeEstrategicoEliminar.controlador.php",
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

///Validaciones
$(document).on("keypress", "#txtnombre", function(){
    if($("#txtnombre").val().length < 200){
        return true;
    }else{
        return false;
    }
});

$(document).on("keypress", "#txtnombreedit", function(){
    if($("#txtnombreedit").val().length < 200){
        return true;
    }else{
        return false;
    }
});