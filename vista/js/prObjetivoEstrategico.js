$(document).ready(function(){
	cargarEje();
	cargarEjeEditar();
	listar();
});
$('#frmgrabar').submit(function(e){ 
    e.preventDefault();
    
    if($("#txteje").val() ==="0" || $("#txtobjetivo").val() ===""  ){
        swal("Debe Completar Todos Los Campos", "", "error");  
        return 0;
    }
  	$.ajax({
    	url: "../controlador/ObjetivoEstrategicoRegGrabar.controlador.php",
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
    
    if($("#txtejeedit").val() ==="0" || $("#txtobjetivoedit").val() ===""  ){
        swal("Debe Completar Todos Los Campos", "", "error");  
        return 0;
    }
    $.ajax({
      url: "../controlador/ObjetivoEstrategicoRegEditar.controlador.php",
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
  $("#txteje").val(0);
  $("#txtobjetivo").val("");
}
function editar(id){
  var parametro={
    "codigo":id,
  }
  $.ajax({
      url: "../controlador/ObjetivoEstrategicoRegObtenerCodigo.controlador.php",
      type: "post",
      dataType: "json",
      data: parametro,
      success: function(DataJson){
        if(DataJson.state){
          $("#txtcodigo").val(DataJson.resultado.oes_codigo);
          $("#txtejeedit").val(DataJson.resultado.oes_eje_codigo);
          $("#txtobjetivoedit").val(DataJson.resultado.oes_nombre);
        }else{                           
          
        }                                                           
      }
    })
    .fail(function(){
      swal("Ha ocurrido un error", "", "error");
    });
}
function listar(){
	$("#bodyobjetivoestrategico").empty();
	$.ajax({
    	url: "../controlador/ObjetivoEstrategicoRegListar.controlador.php",
    	type: "post",
    	dataType: "json",
    	success: function(DataJson){
      		if(DataJson.state){
       			for(data in DataJson.resultado){
       				$("#bodyobjetivoestrategico").append("<tr><td>"+DataJson.resultado[data].oes_codigo+"</td><td>"+DataJson.resultado[data].eje_nombre+"</td><td>"+DataJson.resultado[data].oes_nombre+"</td><td><a class='btn btn-warning' data-toggle='modal' data-target='#myModal2' onclick='editar(\""+DataJson.resultado[data].oes_codigo+"\")'><i class='glyphicon glyphicon-wrench'></i></a> <a class='btn btn-danger' data-toggle='modal' data-target='#myModale' onclick='eliminar(\""+DataJson.resultado[data].oes_codigo+"\")'><i class='glyphicon glyphicon-remove'></i></a></td></tr>");
       			}
      		}else{                           
        		
      		}
          $("#tableobjetivoestrategico").DataTable();                                                               
    	}
  	})
  	.fail(function(){
    	//swal("Ha ocurrido un error", "", "error");
  	})
}
function eliminar(id){
  $("#txtcodigoeliminar").val(id);	
}
function cargarEje(){
	$.ajax({
    	url: "../controlador/EjeEstrategicoListar.php",
    	type: "post",
    	dataType: "json",
    	success: function(DataJson){
      		if(DataJson.state){
       			for(data in DataJson.resultado){
       				$("#txteje").append("<option value="+DataJson.resultado[data].eje_codigo+">"+DataJson.resultado[data].eje_nombre+"</option>");
       			}
      		}else{                           
        		
      		}                                                            
    	}
  	})
  	.fail(function(){
    	//swal("Ha ocurrido un error", "", "error");
  	})
}
function cargarEjeEditar(){
	$.ajax({
    	url: "../controlador/EjeEstrategicoListar.php",
    	type: "post",
    	dataType: "json",
    	success: function(DataJson){
      		if(DataJson.state){
       			for(data in DataJson.resultado){
       				$("#txtejeedit").append("<option value="+DataJson.resultado[data].eje_codigo+">"+DataJson.resultado[data].eje_nombre+"</option>");
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
    	url: "../controlador/ObjetivoEstrategicoRegEliminar.controlador.php",
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