$(document).ready(function(){
  listar();
	cargarEje();
	cargarEjeEditar();
  CKEDITOR.replace("txtdescripcion");
  CKEDITOR.replace("txtdescripcionedit");

});
$('#frmgrabar').submit(function(e){ 
    e.preventDefault();
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
              $("#bodylineamientos").append("<tr><td>"+DataJson.resultado[data].pli_codigo+"</td><td>"+DataJson.resultado[data].eje_nombre+"</td><td>"+DataJson.resultado[data].pli_nombre+"</td><td><a class='btn btn-warning' data-toggle='modal' data-target='#myModal2' onclick='editar(\""+DataJson.resultado[data].pli_codigo+"\")'><i class='glyphicon glyphicon-wrench'></i></a> <a class='btn btn-danger' onclick='eliminar(\""+DataJson.resultado[data].pli_codigo+"\")'><i class='glyphicon glyphicon-remove'></i></a></td></tr>");
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
          //$("#txtprioridadesedit").val(DataJson.resultado.pri_nombre);
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
  var parametro={
    "codigo":id,
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
        }else{                           
          
        }                                                           
      }
    })
    .fail(function(){
      swal("Ha ocurrido un error", "", "error");
    });
}