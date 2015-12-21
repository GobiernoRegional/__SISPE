$(document).ready(function(){
  listar();
	cargarEje();
	cargarEjeEditar();
  CKEDITOR.replace("txtdescripcion");
  CKEDITOR.replace("txtdescripcionedit");
  CKEDITOR.replace("txtdescripcionvista");
  

});
$('#frmgrabar').submit(function(e){ 
    e.preventDefault();
    
        if($("#txteje").val()==="0" || $("#txtnombre").val()===""|| $("#txtdescripcion").val()===""){
            swal("Complete los campos", "", "error");
            return 0;  
        }
    
    var parametro={
      "txteje":$("#txteje").val(),
      "txtnombre":$("#txtnombre").val(),
      "txtdescripcion": CKEDITOR.instances['txtdescripcion'].getData(),
    }
    $.ajax({
      url: "../controlador/PoliticaLineamientoGrabar.controlador.php",
      type: "post",
      dataType: "json",
      data:parametro ,

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
    
        if($("#txtejeedit").val()==="0" || $("#txtnombreedit").val()===""|| $("#txtdescripcionedit").val()===""){
            swal("Complete los campos", "", "error");
            return 0;  
        }
    
    var parametro={
      "txtcodigoedit":$("#txtcodigo").val(),
      "txtejeedit":$("#txtejeedit").val(),
      "txtnombreedit":$("#txtnombreedit").val(),
      "txtdescripcionedit": CKEDITOR.instances['txtdescripcionedit'].getData(),
    }
    $.ajax({
      url: "../controlador/PoliticaLineamientoEditar.controlador.php",
      type: "post",
      dataType: "json",
      data:parametro ,

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
  $("#txtnombre").val("");
  $("#txtdescripcion").val("");
}
function listar(){
  $("#bodylineamientos").empty();
  $.ajax({
      url: "../controlador/PoliticaLineamientoListar.controlador.php",
      type: "post",
      dataType: "json",
      success: function(DataJson){
          if(DataJson.state){
            for(data in DataJson.resultado){
              $("#bodylineamientos").append("<tr><td>"+DataJson.resultado[data].pli_codigo+"</td><td>"+DataJson.resultado[data].eje_nombre+"</td><td>"+DataJson.resultado[data].pli_nombre+"</td><td><a class='btn btn-success' data-toggle='modal' data-target='#myModaldetalle' onclick='detalledescripcion(\""+DataJson.resultado[data].pli_codigo+"\")'>Descripcion</a></td><td><a class='btn btn-warning' data-toggle='modal' data-target='#myModal2' onclick='editar(\""+DataJson.resultado[data].pli_codigo+"\")'><i class='glyphicon glyphicon-wrench'></i></a> <a class='btn btn-danger' data-toggle='modal' data-target='#myModale' onclick='eliminar(\""+DataJson.resultado[data].pli_codigo+"\")'><i class='glyphicon glyphicon-remove'></i></a></td></tr>");
            }
          }else{                           
            
          }
          $("#tablelineamientos").DataTable();                                                               
      }
    })
    .fail(function(){
      //swal("Ha ocurrido un error", "", "error");
    })
}

function detalledescripcion(id){
    var parametro={
    "codigo":id,
  }
  $.ajax({
      url: "../controlador/PoliticaLineamientoCargarCodigo.controlador.php",
      type: "post",
      dataType: "json",
      data: parametro,
      success: function(DataJson){
        if(DataJson.state){
          CKEDITOR.instances['txtdescripcionvista'].setData(DataJson.resultado.pli_descripcion)
        }else{                           
          
        }                                                           
      }
    })
    .fail(function(){
      swal("Ha ocurrido un error", "", "error");
    });
}
function editar(id){
  var parametro={
    "codigo":id,
  }
  $.ajax({
      url: "../controlador/PoliticaLineamientoCargarCodigo.controlador.php",
      type: "post",
      dataType: "json",
      data: parametro,
      success: function(DataJson){
        if(DataJson.state){
          $("#txtcodigo").val(DataJson.resultado.pli_codigo);
          $("#txtejeedit").val(DataJson.resultado.pli_eje_codigo);
          $("#txtnombreedit").val(DataJson.resultado.pli_nombre);
          CKEDITOR.instances['txtdescripcionedit'].setData(DataJson.resultado.pli_descripcion)

        }else{                           
          
        }                                                           
      }
    })
    .fail(function(){
      swal("Ha ocurrido un error", "", "error");
    });
}
function limpiarFormulario(){
  $("#txteje").val(0);
  $("#txtnombre").val("");
  $("#txtdescripcion").val("");
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
    	  url: "../controlador/PoliticaLineamientoEliminar.controlador.php",
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
    if($("#txtnombre").val().length < 600){
        return true;
    }else{
        return false;
    }
});

$(document).on("keypress", "#txtnombreedit", function(){
    if($("#txtnombreedit").val().length < 600){
        return true;
    }else{
        return false;
    }
});