$(document).ready(function(){
	cargarObjetivo();
	cargarObjetivoEdit();
	cargarSector();
	cargarSectorEditar();
	listar();
});
$('#frmgrabar').submit(function(e){ 
    e.preventDefault();
    
  	$.ajax({
    	url: "../controlador/VariableRegionalGrabar.controlador.php",
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
    	url: "../controlador/VariableRegionalEditar.controlador.php",
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
function camposMayus(field){
  field.value=field.value.toUpperCase();
}
function limpiarFormulario(){
	$("#txteje").val(0);
	$("#txtsector").val(0);
	$("#txtvariable").val("");
}
function editar(id){
    	var parametro={
		"codigo":id,
	}
	$.ajax({
    	url: "../controlador/VariableRegionalCargarCodigo.controlador.php",
    	type: "post",
    	dataType: "json",
    	data: parametro,
    	success: function(DataJson){
      	if(DataJson.state){
            $("#txtcodigo").val(DataJson.resultado.var_codigo);
            $("#txtobjetivoedit").val(DataJson.resultado.var_cod_objestr);
            $("#txtsectoredit").val(DataJson.resultado.var_cod_sector);
            $("#txtvariableedit").val(DataJson.resultado.var_nombre);
      	}else{                           
        		
      	}                                                           
    	}
  	})
  	.fail(function(){
    	swal("Ha ocurrido un error", "", "error");
  	});
}
function listar(){
  $("#bodyvariable").empty();
  $.ajax({
      url: "../controlador/VariableRegionalListar.controlador.php",
      type: "post",
      dataType: "json",
      success: function(DataJson){
          if(DataJson.state){
            for(data in DataJson.resultado){
              $("#bodyvariable").append("<tr><td>"+DataJson.resultado[data].var_codigo+"</td><td>"+DataJson.resultado[data].oes_nombre+"</td><td>"+DataJson.resultado[data].tse_nombre+"</td><td>"+DataJson.resultado[data].var_nombre+"</td><td><a class='btn btn-warning' data-toggle='modal' data-target='#myModal2' onclick='editar(\""+DataJson.resultado[data].var_codigo+"\")'><i class='glyphicon glyphicon-wrench'></i></a> <a class='btn btn-danger' data-toggle='modal' data-target='#myModale' onclick='eliminar(\""+DataJson.resultado[data].var_codigo+"\")'><i class='glyphicon glyphicon-remove'></i></a></td></tr>");
            }
          }else{                           
            
          }
          $("#tablevariable").DataTable();                                                               
      }
    })
    .fail(function(){
      //swal("Ha ocurrido un error", "", "error");
    })
}
function cargarSector(){
  $.ajax({
      url: "../controlador/SectorListar.controlador.php",
      type: "post",
      dataType: "json",
      success: function(DataJson){
          if(DataJson.state){
            for(data in DataJson.resultado){
              $("#txtsector").append("<option value="+DataJson.resultado[data].tse_codigo+">"+DataJson.resultado[data].tse_nombre+"</option>");
            }
          }else{                           
            
          }                                                            
      }
    })
    .fail(function(){
      //swal("Ha ocurrido un error", "", "error");
    })
}
function cargarSectorEditar(){
  $.ajax({
      url: "../controlador/SectorListar.controlador.php",
      type: "post",
      dataType: "json",
      success: function(DataJson){
          if(DataJson.state){
            for(data in DataJson.resultado){
              $("#txtsectoredit").append("<option value="+DataJson.resultado[data].tse_codigo+">"+DataJson.resultado[data].tse_nombre+"</option>");
            }
          }else{                           
            
          }                                                            
      }
    })
    .fail(function(){
      //swal("Ha ocurrido un error", "", "error");
    })
}
function cargarObjetivo(){
	$.ajax({
    	url: "../controlador/ObjetivoEstrategicoRegListar.controlador.php",
    	type: "post",
    	dataType: "json",
    	success: function(DataJson){
      		if(DataJson.state){
       			for(data in DataJson.resultado){
       				$("#txtobjetivo").append("<option value="+DataJson.resultado[data].oes_codigo+">"+DataJson.resultado[data].oes_nombre+"</option>");
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
    	url: "../controlador/ObjetivoEstrategicoRegListar.controlador.php",
    	type: "post",
    	dataType: "json",
    	success: function(DataJson){
      		if(DataJson.state){
       			for(data in DataJson.resultado){
       				$("#txtobjetivoedit").append("<option value="+DataJson.resultado[data].oes_codigo+">"+DataJson.resultado[data].oes_nombre+"</option>");
       			}
      		}else{                           
        		
      		}                                                             
    	}
  	})
  	.fail(function(){
    	//swal("Ha ocurrido un error", "", "error");
  	})
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
    	 url: "../controlador/VariableRegionalEliminar.controlador.php",
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