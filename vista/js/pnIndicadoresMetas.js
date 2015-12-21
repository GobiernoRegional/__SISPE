$(document).ready(function(){
	cargarObjetivo();
	cargarObjetivoEdit();
	listar();
});
$('#frmgrabar').submit(function(e){ 
    e.preventDefault();
    
        if($("#txtobjetivo").val()==="0" || $("#txtindicador").val()===""|| $("#txtformula").val()===""|| $("#txtfuente").val()===""|| $("#txtlineabase").val()===""|| $("#txttendencia").val()===""|| $("#txtmeta").val()===""){
            swal("Complete los campos", "", "error");
            return 0;  
        }
    
  	$.ajax({
    	url: "../controlador/IndicadorNacionalGrabar.controlador.php",
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
    
    if($("#txtobjetivoedit").val()==="0" || $("#txtindicadoredit").val()===""|| $("#txtformulaedit").val()===""|| $("#txtfuenteedit").val()===""|| $("#txtlineabaseedit").val()===""|| $("#txttendenciaedit").val()===""|| $("#txtmetaedit").val()===""){
            swal("Complete los campos", "", "error");
            return 0;  
        }
    
    $.ajax({
      url: "../controlador/IndicadorNacionalEditar.controlador.php",
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
function listar(){
	$("#bodyindicadores").empty();
	$.ajax({
    	url: "../controlador/IndicadorNacionalListar.controlador.php",
    	type: "post",
    	dataType: "json",
    	success: function(DataJson){
      		if(DataJson.state){
       			for(data in DataJson.resultado){
       				$("#bodyindicadores").append("<tr><td>"+DataJson.resultado[data].indn_codigo+"</td><td>"+DataJson.resultado[data].oen_nombre+"</td><td>"+DataJson.resultado[data].indn_nombre+"</td><td>"+DataJson.resultado[data].indn_lineabase+"%</td><td>"+DataJson.resultado[data].indn_meta21+"%</td><td><a class='btn btn-warning' data-toggle='modal' data-target='#myModal2' onclick='editar(\""+DataJson.resultado[data].indn_codigo+"\")'><i class='glyphicon glyphicon-wrench'></i></a> <a class='btn btn-danger' data-toggle='modal' data-target='#myModale' onclick='eliminar(\""+DataJson.resultado[data].indn_codigo+"\")'><i class='glyphicon glyphicon-remove'></i></a></td></tr>");
       			}
      		}else{                           
        		
      		}
          $("#tableindicadores").DataTable();                                                               
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
      url: "../controlador/IndicadorNacionalCargarCodigo.controlador.php",
      type: "post",
      dataType: "json",
      data: parametro,
      success: function(DataJson){
        if(DataJson.state){
          $("#txtcodigo").val(DataJson.resultado.indn_codigo);
          $("#txtobjetivoedit").val(DataJson.resultado.indn_objetivoespecificonacional);
          $("#txtindicadoredit").val(DataJson.resultado.indn_nombre);
          $("#txtformulaedit").val(DataJson.resultado.indn_formula);
          $("#txtfuenteedit").val(DataJson.resultado.indn_fuente);
          $("#txtlineabaseedit").val(DataJson.resultado.indn_lineabase);
          $("#txttendenciaedit").val(DataJson.resultado.indn_tendencia);
          $("#txtmetaedit").val(DataJson.resultado.indn_meta21);
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
function camposMayus(field){
  field.value=field.value.toUpperCase();
}
function limpiarFormulario(){
  $("#txtobjetivo").val(0);
  $("#txtindicador").val("");
  $("#txtformula").val("");
  $("#txtfuente").val("");
  $("#txtlineabase").val("");
  $("#txtmeta").val("");
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
    	uurl: "../controlador/IndicadorNacionalEliminar.controlador.php",
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
$(document).on("keypress", "#txtindicador", function(){
    if($("#txtindicador").val().length < 200){
        return true;
    }else{
        return false;
    }
});

$(document).on("keypress", "#txtindicadoredit", function(){
    if($("#txtindicadoredit").val().length < 200){
        return true;
    }else{
        return false;
    }
});

$(document).on("keypress", "#txtformula", function(){
    if($("#txtformula").val().length < 200){
        return true;
    }else{
        return false;
    }
});

$(document).on("keypress", "#txtformulaedit", function(){
    if($("#txtformulaedit").val().length < 200){
        return true;
    }else{
        return false;
    }
});

$(document).on("keypress", "#txtfuente", function(){
    if($("#txtfuente").val().length < 200){
        return true;
    }else{
        return false;
    }
});

$(document).on("keypress", "#txtfuenteedit", function(){
    if($("#txtfuenteedit").val().length < 200){
        return true;
    }else{
        return false;
    }
});

$(document).on("keypress", "#txttendencia", function(){
    if($("#txttendencia").val().length < 100){
        return true;
    }else{
        return false;
    }
});

$(document).on("keypress", "#txttendenciaedit", function(){
    if($("#txttendenciaedit").val().length < 100){
        return true;
    }else{
        return false;
    }
});

$(document).on("keypress", "#txtlineabase", function(){
    if($("#txtlineabase").val().length < 200){
        return true;
    }else{
        return false;
    }
});

$(document).on("keypress", "#txtlineabaseedit", function(){
    if($("#txtlineabaseedit").val().length < 200){
        return true;
    }else{
        return false;
    }
});
