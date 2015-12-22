$(document).ready(function(){
	cargarVariable();
	cargarVariableEdit();
	listar();
});
$('#frmgrabar').submit(function(e){ 
    e.preventDefault();
    
  	$.ajax({
    	url: "../controlador/IndicadorRegionaGrabar.controlador.php",
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
    	url: "../controlador/IndicadorRegionaEditar.controlador.php",
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
	$("#txtvariable").val(0);
	$("#txtindicador").val("");
	$("#txtlbcantidad").val("");
	$("#txtlbanio").val("");
	$("#txtmeta2014").val("");
	$("#txtmeta2018").val("");
	$("#txtmeta2021").val("");
	$("#txtfuente").val("");
}
function editar(id){
    	var parametro={
		"codigo":id,
	}
	$.ajax({
    	url: "../controlador/IndicadorRegionalCargarCodigo.controlador.php",
    	type: "post",
    	dataType: "json",
    	data: parametro,
    	success: function(DataJson){
      	if(DataJson.state){
            $("#txtcodigo").val(DataJson.resultado.indr_codigo);
            $("#txtvariableedit").val(DataJson.resultado.indr_cod_variable);
            $("#txtindicadoredit").val(DataJson.resultado.indr_nombre);
            $("#txtlbcantidadedit").val(DataJson.resultado.indr_lb_cantidad);
            $("#txtlbanioedit").val(DataJson.resultado.indr_lb_ano);
            $("#txtmeta2014edit").val(DataJson.resultado.indr_meta_2014);
            $("#txtmeta2018edit").val(DataJson.resultado.indr_meta_2018);
            $("#txtmeta2021edit").val(DataJson.resultado.indr_meta_2021);
            $("#txtfuenteedit").val(DataJson.resultado.indr_fuente);
      	}else{                           
        		
      	}                                                           
    	}
  	})
  	.fail(function(){
    	swal("Ha ocurrido un error", "", "error");
  	});
}
function listar(){
  $("#bodyindicador").empty();
  $.ajax({
      url: "../controlador/IndicadorRegionalListar.controlador.php",
      type: "post",
      dataType: "json",
      success: function(DataJson){
          if(DataJson.state){
            for(data in DataJson.resultado){
              $("#bodyindicador").append("<tr><td>"+DataJson.resultado[data].var_nombre+"</td><td>"+DataJson.resultado[data].indr_nombre+"</td><td>"+DataJson.resultado[data].indr_lb_cantidad+"</td><td>"+DataJson.resultado[data].indr_lb_ano+"</td><td>"+DataJson.resultado[data].indr_meta_2014+"</td><td>"+DataJson.resultado[data].indr_meta_2018+"</td><td>"+DataJson.resultado[data].indr_meta_2021+"</td><td>"+DataJson.resultado[data].indr_fuente+"</td><td><a class='btn btn-warning' data-toggle='modal' data-target='#myModal2' onclick='editar(\""+DataJson.resultado[data].indr_codigo+"\")'><i class='glyphicon glyphicon-wrench'></i></a> <a class='btn btn-danger' data-toggle='modal' data-target='#myModale' onclick='eliminar(\""+DataJson.resultado[data].indr_codigo+"\")'><i class='glyphicon glyphicon-remove'></i></a></td></tr>");
            }
          }else{                           
            
          }
          $("#tableindicador").DataTable();                                                               
      }
    })
    .fail(function(){
      //swal("Ha ocurrido un error", "", "error");
    })
}
function cargarVariable(){
  $.ajax({
      url: "../controlador/VariableRegionalListar.controlador.php",
      type: "post",
      dataType: "json",
      success: function(DataJson){
          if(DataJson.state){
            for(data in DataJson.resultado){
              $("#txtvariable").append("<option value="+DataJson.resultado[data].var_codigo+">"+DataJson.resultado[data].var_nombre+"</option>");
            }
          }else{                           
            
          }                                                            
      }
    })
    .fail(function(){
      //swal("Ha ocurrido un error", "", "error");
    })
}
function cargarVariableEdit(){
  $.ajax({
      url: "../controlador/VariableRegionalListar.controlador.php",
      type: "post",
      dataType: "json",
      success: function(DataJson){
          if(DataJson.state){
            for(data in DataJson.resultado){
              $("#txtvariableedit").append("<option value="+DataJson.resultado[data].var_codigo+">"+DataJson.resultado[data].var_nombre+"</option>");
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
    	 url: "../controlador/IndicadorRegionaEliminar.controlador.php",
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